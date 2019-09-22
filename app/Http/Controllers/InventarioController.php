<?php

namespace sisKardex\Http\Controllers;

use Illuminate\Http\Request;
use sisKardex\Http\Requests;
use sisKardex\Articulo;
use sisKardex\Categoria;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisKardex\Http\Requests\ArticuloFormRequest;
use sisKardex\DetalleVenta;
use sisKardex\DetalleIngreso;
use sisKardex\Ingreso;
use Maatwebsite\Excel\Facades\Excel;


use DB;

class InventarioController extends Controller
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
   			//Filtro de Busquedas obtenidas desde el formulario
   			$query=trim($request->get('searchText'));
   			//Obtenemos los datos de la tabla donde le agregamos los parametros de busqueda
   			$articulos =DB::table('articulo as a')
				->join('categoria as c', 'a.idcategoria','=','c.idcategoria')
				-> select( 'a.idarticulo','a.nombre', 'a.codigo', 'a.contenido', 'a.bodega', 'a.stock', 'c.nombre as categoria', 'a.descripcion')
            -> where('a.nombre','LIKE','%'.$query.'%')
            -> orwhere('a.codigo','LIKE','%'.$query.'%')
            -> orwhere('a.contenido','LIKE','%'.$query.'%')
            -> orwhere('a.stock','LIKE','%'.$query.'%')
            -> orwhere('a.bodega','LIKE','%'.$query.'%')
	   		->orderBy('idarticulo')
	   		->paginate(1000);

   			//    Vista(Carpeta/Controlador/Pagina, Parametros que se le envia a la vista)
   			return view('inventario.index',["articulos"=>$articulos,"searchText"=>$query]);
   		}
   }
   public function store(ArticuloFormRequest $request)
   {
   	//Creando y guardando un nuevo registros en a tabla Articulo
   	//Los valores dentro del get('x') son los objetos que se encuentran en el formulario HTML
		$articulo = new Articulo;
      $articulo -> codigo = $request -> get('codigo');
      $articulo -> contenido = $request -> get('contenido');
      $articulo -> bodega = $request -> get('bodega');
      $articulo -> nombre = $request -> get('nombre');
      $articulo -> stock  = $request -> get('stock');
      $articulo -> descripcion = $request -> get('descripcion');
     
		$articulo->save();
		//return Redirect::to('almacen/categoria');
      return \Redirect::to('inventario');
   }
   public function show($id) //id de la categoria que quiero mostrar
   {
   		return view('inventario.show',["articulo"=>Articulo::findOrFail($id)]);
   }
   
     
}
