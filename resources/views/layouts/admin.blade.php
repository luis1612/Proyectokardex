<?php 
$unreadNotifications=auth()->user()->unreadNotifications;
$readNotifications=auth()->user()->readNotifications;
 ?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema Kardex</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/tableexport.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/magnifier.css')}}">
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">

    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

    <script src="cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript" charset="utf-8" async defer></script>
    <script src="tableToExcel.js"></script>
    <script src="FileSaver.js"></script>
    <script src="tableexport.js"></script>
    <script src="bootstrap-checkbox.js" defer></script>
    @stack('styles')
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="{{url('ventas/venta')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b></b>KDX</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Sistema Kardex</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown notifications-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> Notificaciones
                    <i class="fa fa-bell-o"></i>
                    @if($count=Auth::user()->unreadNotifications->count())
                    <span style="font-size: 0.8em;" class="label label-warning">{{ $count }}</span>
                    @endif
                  </a>
                  <ul class="dropdown-menu"  style="width: 450px;">
                    <li class="header">Usted Tiene {{ $count }} Notificacion(es)</li>
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu" style="max-height: 400px">
                        <h5 class="text-center text-muted">No Leídas (Nuevas)</h5>
                        @foreach($unreadNotifications as $unreadNotification)
                        @if($unreadNotification->type=="sisKardex\Notifications\IngresoSent")
                        <li>
                          <a class="font-w600 push-5-t" data-toggle="tooltip" title="Ver Detalle.." href="{{ $unreadNotification->data['link'] }}"><i class="fa fa-archive text-aqua"></i> {{ $unreadNotification->data['user'] }} - {{ $unreadNotification->data['text'] }}
                            <div class="text-muted push-5-t">
                              <em>Notificado {{ \Carbon\Carbon::parse($unreadNotification->created_at)->diffForHumans() }}</em>
                            </div>
                          </a>
                        </li>
                        @else @if($unreadNotification->type=="sisKardex\Notifications\VentaSent")
                          <li>
                            <a class="font-w600 push-5-t" data-toggle="tooltip" title="Ver Detalle.." href="{{ $unreadNotification->data['link'] }}"><i class="fa fa-check-square-o text-success"></i> {{ $unreadNotification->data['user'] }} - {{ $unreadNotification->data['text'] }}
                              <div class="text-muted push-5-t">
                                <em>Notificado {{ \Carbon\Carbon::parse($unreadNotification->created_at)->diffForHumans() }}</em>
                              </div>
                            </a>
                          </li>
                        @else
                        <li>
                          <a class="font-w600 push-5-t" data-toggle="tooltip" title="Ver Ariculo.." href="{{ $unreadNotification->data['link'] }}"><i class="fa fa fa-warning text-yellow"></i> {{ $unreadNotification->data['user'] }} - {{ $unreadNotification->data['text'] }}
                            <div>
                                <h5>{{ $unreadNotification->data['stock'] }}</h5>
                            </div>
                            <div class="text-muted push-5-t">
                              <em>Notificado {{ \Carbon\Carbon::parse($unreadNotification->created_at)->diffForHumans() }}</em>
                            </div>
                          </a>
                        </li>
                        @endif
                        @endif
                        @endforeach

                        <h5 class="text-center text-muted">Leídas (Anteriores)</h5>
                        @foreach($readNotifications as $readNotification)
                        @if($readNotification->type=="sisKardex\Notifications\IngresoSent")
                        <li>
                          <a class="font-w600 push-5-t" data-toggle="tooltip" title="Ver Detalle.." href="{{ $readNotification->data['link'] }}"><i class="fa fa-archive text-aqua"></i> {{ $readNotification->data['user'] }} - {{ $readNotification->data['text'] }}
                            <div class="text-muted push-5-t">
                              <em>Notificado {{ \Carbon\Carbon::parse($readNotification->created_at)->diffForHumans() }}</em>
                            </div>
                          </a>
                        </li>
                        @else @if($readNotification->type=="sisKardex\Notifications\VentaSent")
                          <li>
                            <a class="font-w600 push-5-t" data-toggle="tooltip" title="Ver Detalle.." href="{{ $readNotification->data['link'] }}"><i class="fa fa-cart-plus text-success"></i> {{ $readNotification->data['user'] }} - {{ $readNotification->data['text'] }}
                              <div class="text-muted push-5-t">
                                <em>Notificado {{ \Carbon\Carbon::parse($readNotification->created_at)->diffForHumans() }}</em>
                              </div>
                            </a>
                          </li>
                        @else
                        <li>
                          <a class="font-w600 push-5-t" data-toggle="tooltip" title="Ver Ariculo.." href="{{ $readNotification->data['link'] }}"><i class="fa fa fa-warning text-yellow"></i> {{ $readNotification->data['user'] }} - {{ $readNotification->data['text'] }}
                            <div>
                                <h5>{{ $readNotification->data['stock'] }}</h5>
                            </div>
                            <div class="text-muted push-5-t">
                              <em>Notificado {{ \Carbon\Carbon::parse($readNotification->created_at)->diffForHumans() }}</em>
                            </div>
                          </a>
                        </li>
                        @endif
                        @endif
                        @endforeach
                      </ul>
                    </li>
                    <li class="footer"><a href="{{ route('notifications.index') }}"><strong class="text-light-blue">Ver y Administar todas las Notificaciones</strong></a></li>
                  </ul>
                </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                   @if(Auth::user()->tipo_usuario == 'administrador')
                      <img src="{{asset('imagenes/avatar.png')}}" class="user-image" alt="User Image">
                    @else(Auth::user()->tipo_usuario == 'consultor' Or  Auth::user()->tipo_usuario == 'asesor') 
                      <img src="{{asset('imagenes/avatar_default.png')}}" class="user-image" alt="User Image">
                    @endif
                    <!--<img src="{{asset('imagenes/avatar.png')}}" class="user-image" alt="User Image">-->
                  <small class="bg-olive">Conectado</small>
                  <i class=""></i>{{Auth::user()->name}}<b></b>
                  <i class=""></i>{{Auth::user()->tipo_usuario}}<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                 <!-- The user image in the menu -->
                  <li class="user-header">
                    @if(Auth::user()->tipo_usuario == 'administrador')
                      <img src="{{asset('imagenes/avatar.png')}}" class="img-circle" alt="User Image">
                    @else(Auth::user()->tipo_usuario == 'consultor' Or  Auth::user()->tipo_usuario == 'asesor') 
                      <img src="{{asset('imagenes/avatar_default.png')}}" class="img-circle" alt="User Image">
                    @endif
                      <p>
                          <i class=""></i>{{Auth::user()->name}}<b class=" "></b>
                          <br>
                          <b>Tipo de Usuario: </b><i class=""></i>{{Auth::user()->tipo_usuario}}<b></b>
                          <small>Control de abastecimientos e inventario</small> <br>
                      </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                        <a href="{{ url('/home') }}"><i class="fa fa-btn fa-sign-in"></i>  Inicio</a>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('/logout') }}"><i class="fa fa-unlock-alt"></i>  Cerrar Sesión</a>

                    </div>
                </li>
                </ul>
              </li>
              <li>
                  <a href="#" data-toggle="control-sidebar" class="bg-teal"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
              <div class="user-panel">

                    <div class="pull-left image">
                        @if(Auth::user()->tipo_usuario == 'administrador')
                          <img src="{{asset('imagenes/avatar.png')}}" class="img-circle" alt="User Image">
                        @else(Auth::user()->tipo_usuario == 'consultor' Or  Auth::user()->tipo_usuario == 'asesor') 
                          <img src="{{asset('imagenes/avatar_default.png')}}" class="img-circle" alt="User Image">
                    @endif
                    </div>
                    <div class="pull-left info">
                        <p>{{Auth::user()->name}}</p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success"></i> Conectado </a>
                    </div>
                </div>

                <!-- search form 
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>  -->


          <!-- sidebar menu: : style can be found in sidebar.less -->
           
          <ul class="sidebar-menu">
            <li class="header"></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-building"></i>
                <span>Almacenes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">   
                <li><a href="{{url('almacen/articulo')}}"><i class="fa fa-tags" aria-hidden="true"></i> Artículos</a></li>
                <li><a href="{{url('almacen/categoria')}}"><i class="fa fa-cubes" aria-hidden="true"></i> Categorías</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-truck" aria-hidden="true"></i>
                <span>Entradas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                
                <li><a href="{{url('compras/ingreso')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Ingresos</a></li>
                <li><a href="{{url('compras/proveedor')}}"><i class="fa fa-clone"></i> Proveedores</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i  class="fa fa-calendar-check-o"></i>
                <span>Salidas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('ventas/venta')}}"><i class="fa fa-check-square-o"></i> Salidas</a></li>
                @if(Auth::user()->tipo_usuario == 'administrador' Or  Auth::user()->tipo_usuario == 'consultor')
                <li><a href="{{url('ventas/cliente')}}"><i class="fa fa-users"></i> Asesor(a) </a></li>
                @endif 
              </ul>
            </li>     
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop" aria-hidden="true"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @if(Auth::user()->tipo_usuario == 'administrador')
                <li><a href="{{url('seguridad/usuario')}}"><i class="fa fa-folder"></i> Usuarios</a>
                @endif
                </li>
              </ul>
            </li>
             @if(Auth::user()->tipo_usuario == 'administrador' Or  Auth::user()->tipo_usuario == 'consultor')
            <li>
              <a href="{{url('inventario')}}">
                <i class="fa fa-book"></i> <span>Inventario</span>
              </a>
            </li> 
              @endif
             <li>
              <a href="{{url('ayuda')}}">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="{{url('acercade')}}">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">KARDEX</small>
              </a>
            </li> 
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>



       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema Kardex Central Grupo Ferretero</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                              <!--Contenido-->
                              @yield('contenido')
                              <!--Fin Contenido-->
                           </div>
                        </div>
                        
                      </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; <script>
                var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                var f=new Date();
                document.write(f.getFullYear());
                </script> 
          <a href="https://github.com/luis1612" target="_blank"><i class="fa fa-github" aria-hidden="true"></i> Luis Ibarguen</a>.
        </strong> Todos los derechos reservados.
      </footer>


         <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-bars"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane active" id="control-sidebar-home-tab">
                    <h5>Inicio</h5>
                    <h3 class="control-sidebar-heading">Números Telefonicos</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:;">
                              <i class="menu-icon fa fa-phone-square bg-red"></i>
                              <div class="menu-info">
                                  <h4 class="control-sidebar-subheading">Números Telefonicos Almacenes - Bodegas</h4>

                                  <p>
                                    <script>
                                      var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                      var f=new Date();
                                      document.write(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
                                    </script>
                                   </p>
                              </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu --> 
                    <h5 class="">PROCE: 2144721 -- 2124721 </h5>
                    <h5 class="">SUCU:  2121390 -- 2131390 </h5>
                    <h5 class="">FERRE: 2146447 -- 2130429 </h5>
                    <h5 class="">REMO:  2141957 </h5>
                    <h5 class="">DECOR: 2138744 </h5>
                    <h5 class="">KARDEX CENTRAL: 2144113 </h5>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:;">
                                <h4 class="control-sidebar-subheading">
                                    CALCULADORA
                                    <span class="pull-right-container">
                      <span class="label label-success pull-right"></span>
                    </span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-success" style="width: 100%"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->
                    <title>CALCULADORA</title>
                     <style type="text/css">
                      #calculadora {background: gray; border: 0;}
                      #calculadora td {padding: 4px;}
                      .cajita_valor {background-color: #acff38; color: #467702; border: 1px solid #454545; width: 130px; height: 26px; font-family: Arial, Helvetica; font-size: 20px; line-height: 26  px; text-align: right; }
                      .boton {width: 24px; border: 1px solid #000; font-family: Arial; font-size: 12px; cursor: hand; background-color: #454545;}  
                      .boton_largo { width: 62px; border: 1px solid #000;  font-family: Arial; font-size: 12px; cursor: hand; background-color: #fff;}
                      .funcion {font-weight: bold; color: #b00;}
                    </style>
                    <script>
                            //Declaracion de variables
                          var num1 = 0;
                          var num2 = 0;
                          var opera;

                        //Función que coloca el número presionado
                        function darNumero(numero){
                            if(num1==0 && num1 !== '0.'){
                                num1 = numero;
                            }else{
                                num1 += numero;
                            }
                            refrescar();
                        }

                        //Función que coloca la coma al presionar dicho botón
                        function darComa(){
                            if(num1 == 0) {
                                num1 = '0.';
                            } else if(num1.indexOf('.') == -1) {
                                num1 += '.';
                            }
                            refrescar();
                        }

                        //Función que coloca la C al presionar dicho botón
                        function darC(){
                            num1 = 0;
                            num2 = 0;
                            refrescar();
                        }


                        //Esta función realiza las distintas operaciones aritméticas en función del botón pulsado
                        function operar(valor){
                            if (num1 == 0){
                                num1 = parseFloat(document.getElementById("valor_numero").value);
                            }
                            num2 = parseFloat(num1);
                            num1= 0;
                            opera = valor;
                        }

                        //Función para pulsar igual
                            /*
                          suma = 1
                          resta = 2
                          multiplicacion = 3
                          division = 4
                          potencia = 5
                        */

                        function esIgual(){
                            num1 = parseFloat(num1);
                            switch (opera){
                                case 1:
                                    num1 += num2;
                                break;
                                case 2:
                                    num1 = num2 - num1;
                                break;
                                case 3:
                                    num1 *= num2;
                                break;
                                case 4:
                                    num1 = num2 / num1;
                                break;
                                case 5:
                                    num1 = Math.pow(num2, num1);
                                break;
                            }
                            refrescar();
                            num2 = parseFloat(num1);
                            num1 = 0;
                        }

                        function refrescar(){
                            document.getElementById("valor_numero").value = num1;
                        }
                    </script>
                  </head>
                  <body>
                      <table id="calculadora">
                          <tr>
                              <td colspan="4">
                                  <input type="text" id="valor_numero" maxlength="20" value="0" class="cajita_valor" readonly="true">
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2">
                                  <input type="Button" id="potencia" value="exp" class="boton_largo funcion" onclick="operar(5)">
                              </td>
                              <td>
                                  <input type="Button" id="Dividir" value="/" class="boton funcion" onclick="operar(4)">
                              </td>
                              <td>
                                  <input type="Button" id="Multiplicar" value="x" class="boton funcion" onclick="operar(3)">
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  <input type="Button" id="7" value="7" class="boton" onclick="darNumero('7')">
                              </td>
                              <td>
                                  <input type="Button" id="8" value="8" class="boton" onclick="darNumero('8')">
                              </td>
                              <td>
                                  <input type="Button" id="9" value="9" class="boton" onclick="darNumero('9')">
                              </td>
                              <td>
                                  <input type="Button" id="Restar" value="-" class="boton funcion">
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  <input type="Button" id="4" value="4" class="boton" onclick="darNumero('4')">
                              </td>
                              <td>
                                  <input type="Button" id="5" value="5" class="boton" onclick="darNumero('5')">
                              </td>
                              <td>
                                  <input type="Button" id="6" value="6" class="boton" onclick="darNumero('6')">
                              </td>
                          <td>
                            <input type="Button" id="Sumar" value="+" class="boton funcion" onclick="operar(1)">
                          </td>
                          </tr>
                          <tr>
                              <td>
                                  <input type="Button" id="1" value="1" class="boton" onclick="darNumero('1')">
                              </td>
                              <td>
                                  <input type="Button" id="2" value="2" class="boton" onclick="darNumero('2')">
                              </td>
                              <td>
                                  <input type="Button" id="3" value="3" class="boton" onclick="darNumero('3')">
                              </td>
                              <td>
                                  <input type="Button" id="igual" value="=" class="boton funcion" onclick="esIgual()">
                              </td>
                          </tr>
                          <tr>
                              <td colspan="2">
                                  <input type="Button" id="0" value="0" class="boton_largo" onclick="darNumero('0')">
                              </td>
                        <td>
                                  <input type="Button" id="," value="," class="boton" onclick="darComa()">
                              </td>
                            <td>
                          <input type="Button" id="C" value="C" class="boton funcion" onclick="darC()">
                            </td>
                          </tr>
                      </table>
                </div>
                <!-- /.tab-pane -->
                <!-- Stats tab content -->
                <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                <!-- /.tab-pane -->
                <!-- Settings tab content -->
                <div class="tab-pane" id="control-sidebar-settings-tab">
                  <h3 class="control-sidebar-heading">TABLA DE PESOS</h3>
                    <h5 class="control-sidebar-heading">Los pesos son aproximados</h5>

                    <div class="tab-pane" id="control-sidebar-settings-tab">
                    <table>
                        <tr>
                          <th>Formato </th>
                          <th>/ Peso:caja</th>
                        </tr>
                        <tr>
                          <td>13 X 43 </td>
                          <td>14.3 kg</td>
                        </tr>
                         <tr>
                          <td>19.5X88</td>
                          <td>22.97 kg</td>
                        </tr>
                        <tr>
                          <td>20 X 20 </td>
                          <td>24,7 kg</td>
                        </tr>
                        <tr>
                          <td>20 X 30 </td>
                          <td>18,8 kg</td>
                        </tr>
                        <tr>
                          <td>20 X 60 </td>
                          <td>22.19 kg</td>
                        </tr>
                        <tr>
                          <td>20 X 90 </td>
                          <td>22,4 kg</td>
                        </tr>
                        <tr>
                          <td>25 X 25 </td>
                          <td>26 kg</td>
                        </tr>
                        <tr>
                          <td>25 X 35 </td>
                          <td>17,1 kg</td>
                        </tr>
                        <tr>
                          <td>25 X 41</td>
                          <td>23,2 kg</td>
                        </tr>
                        <tr>
                          <td>25 X 43</td>
                          <td>17,1 kg</td>
                        </tr>
                        <tr>
                          <td>25.4X50</td>
                          <td>30 kg</td>
                        </tr>
                        <tr>
                          <td>28 X 57</td>
                          <td>23,5 kg</td>
                        </tr>
                        <tr>
                          <td>23.9X42</td>
                          <td>45,1 kg</td>
                        </tr>
                        <tr>
                          <td>30 X 45 </td>
                          <td>19,9 kg</td>
                        </tr>
                        <tr>
                          <td>30 X 60</td>
                          <td>16,9 kg</td>
                        </tr>
                        <tr>
                          <td>30 X 75 </td>
                          <td>25,1 kg </td>
                        </tr>
                        <tr>
                          <td>30 X 90 </td>
                          <td>24.6 kg</td>
                        </tr>
                        <tr>
                          <td>33 X 33</td>
                          <td>23,2 kg</td>
                        </tr>
                        <tr>
                          <td>41 X 90</td>
                          <td>23,4 kg</td>
                        </tr>
                        <tr>
                          <td>42 X 42</td>
                          <td>23,2 Kg</td>
                        </tr>
                        <tr>
                          <td>45 X 45</td>
                          <td>30,2 kg</td>
                        </tr>
                        <tr>
                          <td>50 X 50</td>
                          <td>25 kg</td>
                        </tr>
                         <tr>
                          <td>51 X 51</td>
                          <td>28,5 kg</td>
                        </tr>
                        <tr>
                          <td>55 X 55</td>
                          <td>27,7 kg</td>
                        </tr>
                        <tr>
                          <td>56 X 56 </td>
                          <td>31,7 kg</td>
                        </tr>
                        <tr>
                          <td>57 X 57  </td>
                          <td>30,3 kg</td>
                        </tr>
                        <tr>
                          <td>60 X 60</td>
                          <td>32,94 kg </td>
                        </tr>
                    </table>
                </div>
                <!-- /.tab-pane -->
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
      
    <!-- jQuery 2.1.4 -->
    <!--<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>-->
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    @stack('scripts')
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('js/jquery.datatables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/vfs_fonts.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/buttons.print.min.js')}}"></script>
    <script src="{{asset('js/tableexport.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/tableToExcel.js')}}"></script> <!-- Exportar Excel -->
    <script src="{{asset('js/app.min.js')}}"></script>

    <script>
        $(document).ready(function() {
              responsive: true
        $('#testTable').DataTable( {/*
                    lengthMenu: [
                        [ 10, 25, 50, -1 ],
                        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                    ],
                    buttons: [
                        'pageLength'
                    ],*/
                  "search": {
                      "smart": true
                  },
                  "lengthMenu": [ [10, 25, 50,100, -1], [10, 25, 50,100, " Todos "] ],
                  dom: "B&gt;'col-sm-4'f&gt;",//'Bfrtip',
                  buttons: [
                      'copy', 'csv', 'excel', 'pdf', 'print',
                  ],
                    "search": true,
                    "smart": true ,
                  "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                          "sFirst":    "Primero",
                          "sLast":     "Último",
                          "sNext":     "Siguiente",
                          "sPrevious": "Anterior"
                        },
                        "oAria": {
                          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                      }
              } );
          } );
    </script>
    <script>
        $(document).ready(function() {
              responsive: true
        $('#ttTable').DataTable( {
                  "search": {
                      "smart": true
                  },
                  "lengthMenu": [ [10, 25, 50,100, -1], [10, 25, 50,100, " Todos "] ],
                  dom: "B&gt;'col-sm-4'f&gt;",//'Bfrtip',
                  buttons: [
                      'copy', 'csv', 'excel', 'pdf', 'print'
                  ],
                  "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                          "sFirst":    "Primero",
                          "sLast":     "Último",
                          "sNext":     "Siguiente",
                          "sPrevious": "Anterior"
                        },
                        "oAria": {
                          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                      },
              } );
          } );
    </script>

  </body>
</html>
