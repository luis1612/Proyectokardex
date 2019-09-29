@extends ('layouts.admin')
@section ('contenido')
 <div class="shiftnav-content-wrap"><!-- Content Wrapper. Contains page content  class="content-wrapper" class="shiftnav-content-wrap" -->
        <section class="content-header"><!-- Content Header (Page header) -->
            <h1>Sobre el autor</h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Sobre el autor</li>
            </ol>
        </section>
        <section class="content"><!-- Main content -->
            <div class="row"><!-- Small boxes (Stat box) -->
                <div class="col-md-6 col-md-offset-3">
                    <h1>Acerca del autor</h1>

                    <h2>SisKardex V1.0 PRO - <small>Sistema Kardex Central Grupo Ferretero</small></h2>
                    <p>SisKardex V1.0 PRO es un sistema web desarrollado con PHP, MySQL , Bootstrap Y Laravel como framework de desarrollo.</p>

                    <h1 style="text-align: center;">SisKardex V1.0 PRO</h1>
                    <h3>Descripción</h3>
                    <p>cubre una serie de requerimientos básicos para llevar el control del inventario de una empresa o negocio. Esta es  una solución sencilla para que los propietarios de pequeñas y medianas empresas gestionen sus existencias de manera sistemática.</p>

                    <strong>características</strong>

                    <ul>
                        <li>Gestión de inventario</li>
                        <li>Agregue productos al inventario y desactivación de productos de inventario</li>
                        <li>Agregar imágenes a productos</li>
                        <li>Historial de inventario</li>
                        <li>Búsqueda de Producto</li>
                        <li>Gestión por categorías</li>
                        <li>Administrar usuarios</li>
                        <li>Sistema de inicio de sesión integrado</li>
                        <li>Generación de Informes de Inventario en Excel, Csv, Pdf, ademas copiar e imprimir pantalla</li>
                        <li>Generación de Notificaciones al ingresar, salir y agotar existencia de un producto.</li>
                        <li>Plantilla receptiva que usa Bootstrap</li>
                        <li>Busqueda rapido de todos los modulos</li>
                        <li>Historial de todos lo movimientos del sistema</li>
                    </ul>

                    <h3>Modulos</h3>
                    <p>Defino a grandes rasgos los modulos generales del sistema</p>
                    <ul>
                    <li><b>Dashboard</b>: Muestra salidas, entradas y productos recientes en el sistema.</li>
                    <li><b>Administración de Fabricantes</b>: módulo de categoria permite al usuario buscar, agregar, editar y eliminar categoria para que posteriormente los productos pueda ser agrupados por categoria al cual pertenecen.</li>
                    <li><b>Administración de Productos</b>: El módulo de productos permite al usuario buscar, agregar, editar, activar y desactivar productos para que posteriormente puedan ser agregados al inventario mediante una entrada..</li>
                    <li><b>Administración de Proveedores</b>:El módulo de proveedores permite al usuario buscar, agregar, editar y eliminar proveedores para que posteriormente puedan ser vinculados a una entrada.</li>
                    <li><b>Administración de Asesor (es)</b>: El módulo de asesores permite al usuario buscar, agregar, editar y eliminar asesores para que posteriormente puedan ser vinculados a una salida.</li>
                    <li><b>Módulo de Reportes</b>: Éste módulo permite la generación de reportes, tanto de entradas, salidas y articulos .</li>
                    <li><b>Módulo de Ayuda</b>: Es una guia de administracion del sistema, de los datos de la empresa, permitiendo a los usuarios ralizar un crud dependiedo del modulo de acceso, entre otros.</li>
                    <li><b>Administración de acceso</b>: Permite listar, agregar editar y eliminar los grupos de usuarios y los usuarios..</li>
                    <br>
                    <li> <b> Y mucho mucho más </b> </li>
                    </ul>
                    <br><br>

                    <h1 style="text-align: center;"><a href="https://github.com/luis1612" target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a></h1>
                </div>
            </div><!-- /.row -->
        </section>
    </div><!-- /.content -->
@endsection


