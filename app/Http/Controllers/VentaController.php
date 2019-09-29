<?php

namespace sisKardex\Http\Controllers;

use Illuminate\Http\Request;
use sisKardex\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisKardex\Http\Requests\VentaFormRequest;
use sisKardex\Venta; //modelo Venta
use sisKardex\DetalleVenta;//modelo DetalleVenta
use sisKardex\User; //modelo User
use sisKardex\Articulo; //modelo Artiulo
use DB;
use sisKardex\Notifications\VentaSent;
use sisKardex\Notifications\ArticuloSent;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
{
    public function __construct()
   {
         $this->middleware('auth');
   }
   //Todos estos metodos estan asociados con nuestras rutas resources
   public function index(Request $request)
   {
   		if($request)
   		{
   			$query=trim($request -> get('searchText'));
              $ventas=DB::table('venta as v')
              ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
              ->join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
              ->join('articulo as a','dv.idarticulo','=',"a.idarticulo")
              ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.num_comprobante','a.codigo','v.estado', DB::raw('v.estado , COUNT(*) as totalp'))
              ->orwhere ('a.codigo','LIKE','%'.$query.'%')
              ->orderBy('v.idventa','desc')
              ->paginate(10);
   			return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query]);
   		}

   }


   public function create()
   {
   		//Obtenemos los Clientes
   		$personas=DB::table('persona')->where('tipo_persona','=','Cliente')->get();
   		//Obtenemos los artículos
   		$articulos = DB::table('articulo as art')
            ->join('detalle_ingreso as di', 'art.idarticulo', '=', 'di.idarticulo')
            ->select(DB::raw('CONCAT(" ", art.codigo ," ", art.contenido," " ,art.nombre, art.bodega, art.stock) AS articulo'), 'art.idarticulo', 'art.stock',DB::raw('art.estado ,COUNT(*) as totalp')) // ->select(DB::raw('CONCAT("REF #", art.nombre, " -- Bodega ", art.bodega, "-- ", art.stock) AS articulo'), 'art.idarticulo', 'art.stock',DB::raw('art.estado ,COUNT(*) as totalp'))
            ->where('art.estado', '=', 'Activo')
            ->where('art.stock', '>', '0')
            ->groupBy('articulo', 'art.idarticulo', 'art.stock','art.estado')
            ->get();
   		return view("ventas.venta.create",["personas"=>$personas,"articulos"=>$articulos]);
   }



   public function store(VentaFormRequest $request)
   {
   		try{
   			DB::beginTransaction();
   			 $venta = new Venta();
                $venta -> idcliente = $request -> get('idcliente');
                $venta -> tipo_comprobante = $request -> get('tipo_comprobante');
                $venta -> num_comprobante = $request -> get('num_comprobante');
                $venta -> totalp = $request -> get('totalp');
                $mytime = Carbon::now('America/Bogota');
                $venta -> fecha_hora = $mytime -> toDateTimeString(); //lo convierto en un formato de fecha y hora
                $venta -> estado = 'A';
                $venta -> save();

                $idarticulo = $request -> get('idarticulo'); // array con los idarticulos
                $cantidad = $request -> get('cantidad');
                $cont = 0;

                while($cont < count($idarticulo))
                {

                    $detalle = new DetalleVenta();
                    $detalle -> idventa = $venta -> idventa; // al crearse el objeto, se le asiga un id que aqui utilizo
                    $detalle -> idarticulo = $idarticulo[$cont]; // envia info de la posicion correspondiente
                    $detalle -> cantidad = $cantidad[$cont];
                    $detalle -> save();
                    $articulo = Articulo::findOrFail($idarticulo[$cont]);
                    $cantidad_articulo=$articulo->stock;
                    if ($cantidad_articulo<=40) {
                      $art = new Articulo();
                      $art->idarticulo=$articulo->idarticulo;
                      $art->nombre=$articulo->nombre;
                      $art->stock=$articulo->stock;
                      $art->codigo=$articulo->codigo;
                      $art->descripcion=$articulo->descripcion;

                      $user=DB::table('users')->get();
                      for($i=0;$i<count($user);$i++){
                      $iduser=$user[$i]->id;
                      $users_id=User::find($iduser);
                      $art->name=$users_id->name;
                      $users_id->notify(new ArticuloSent($art));
                      }
                    }
                    
                    $cont=$cont+1;
                }

              $user=DB::table('users')->get();
              for($i=0;$i<count($user);$i++){
              $iduser=$user[$i]->id;
              $users_id=User::find($iduser);
              $venta->name=$users_id->name;
              $users_id->notify(new VentaSent($venta));
              }

              

            DB::commit();
        } catch(Exception $e)
        {
            DB::rollback();
        }

   		return \Redirect::to('ventas\venta');
   }
   public function show($id)
   {
   		$venta=DB::table('venta as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
            ->join('articulo as a','dv.idarticulo','=',"a.idarticulo")
            ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.num_comprobante','a.codigo','v.estado','v.totalp')
            ->where('v.idventa', '=', $id)
            ->first();

        $detalles=DB::table('detalle_venta as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->select(DB::raw('CONCAT("REF #",a.codigo, " -- ", a.contenido," -- " , a.nombre, " --  Bodega ", a.bodega) AS articulo'),'d.cantidad')
            ->where('d.idventa', '=', $id)
            ->get();

   		return view("ventas.venta.show",["venta"=>$venta,"detalles"=>$detalles]);
   }
   
   public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta -> estado = 'C';
        $venta -> update();

        return \Redirect::to('ventas/venta');
    }
}
