@extends ('layouts.admin')
@section ('contenido')
<div class="block-header">
    <h3 class="block-title"><strong>Listado de Notificaciones : </strong></h3>
</div><br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
            <!-- Message List -->
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <div class="block-title text-normal">
                        <strong class="h3">No Leídas</strong> <span class="font-w400"></span>
                    </div>
                </div>
                <div class="block-content">
                    <div class="pull-r-l">
                        <table class="js-table-checkable table table-hover table-vcenter">
                            <tbody>
                                @foreach($unreadNotifications as $unreadNotification)
                                    @if($unreadNotification->type=="sisKardex\Notifications\ArticuloSent")
                                    <tr>
                                        <td class="font-w400 text-primary"><strong>{{ $unreadNotification->data['user'] }}</strong></td>
                                        <td>
                                            <a class="font-w600 push-5-t text-danger" data-toggle="tooltip" title="Ver Articulos.." href="{{ $unreadNotification->data['link'] }}">{{ $unreadNotification->data['text'] }}</a>
                                            <div>
                                                <h5>{{ $unreadNotification->data['stock'] }}</h5>
                                            </div>
                                            <div class="text-muted push-5-t">
                                                <em>Notificado {{ \Carbon\Carbon::parse($unreadNotification->created_at)->diffForHumans() }}</em>
                                            </div>
                                        </td>
                                        <td class="text-muted">
                                            <form method="POST" action="{{ route('notifications.read',$unreadNotification->id) }}">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}                                         
                                                <button class="btn btn-primary btn-xs" data-toggle="tooltip" title="Marcar como leído.."><i class="fa fa-folder-open"></i></button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="font-w400 text-primary"><strong>{{ $unreadNotification->data['user'] }}</strong></td>
                                        <td>
                                            <a class="font-w600 push-5-t" data-toggle="tooltip" title="Ver Detalle.." href="{{ $unreadNotification->data['link'] }}">{{ $unreadNotification->data['text'] }}</a>
                                            <div class="text-muted push-5-t">
                                                <em>Notificado {{ \Carbon\Carbon::parse($unreadNotification->created_at)->diffForHumans() }}</em>
                                            </div>
                                        </td>
                                        <td class="text-muted">
                                            <form method="POST" action="{{ route('notifications.read',$unreadNotification->id) }}">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}                                         
                                                <button class="btn btn-primary btn-xs" data-toggle="tooltip" title="Marcar como leído.."><i class="fa fa-folder-open"></i></button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END Messages -->
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <div class="block-title text-normal">
                        <strong class="h3">Leídas</strong> <span class="font-w400"></span>
                    </div>
                </div>
                <div class="block-content">
                    <div class="pull-r-l">
                        <table class="js-table-checkable table table-hover table-vcenter">
                            <tbody>
                                @foreach($readNotifications as $readNotification)
                                    @if($readNotification->type=="sisKardex\Notifications\ArticuloSent")
                                    <tr>
                                        <td class="font-w400">{{ $readNotification->data['user'] }}</td>
                                        <td>
                                            <a class="font-w600 push-5-t" data-toggle="tooltip" title="Ver Articulos.." href="{{ $readNotification->data['link'] }}">{{ $readNotification->data['text'] }}</a>
                                            <div>
                                                <h5>{{ $readNotification->data['stock'] }}</h5>
                                            </div>
                                            <div class="text-muted push-5-t">
                                            <em>Leído {{ \Carbon\Carbon::parse($readNotification->read_at)->diffForHumans() }}</em>  
                                            </div>
                                        </td>
                                        <td class="text-muted">
                                            <form method="POST" action="{{ route('notifications.destroy',$readNotification->id) }}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Eliminar Notificacion.."><i class="fa fa-trash"></i></button>
                                            </form> 
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="font-w400">{{ $readNotification->data['user'] }}</td>
                                        <td>
                                            <a class="font-w600 push-5-t" data-toggle="tooltip" title="Ver Detalle.." href="{{ $readNotification->data['link'] }}">{{ $readNotification->data['text'] }}</a>
                                            <div class="text-muted push-5-t">
                                            <em>Leído {{ \Carbon\Carbon::parse($readNotification->read_at)->diffForHumans() }}</em>  
                                            </div>
                                        </td>
                                        <td class="text-muted">
                                            <form method="POST" action="{{ route('notifications.destroy',$readNotification->id) }}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Eliminar Notificacion.."><i class="fa fa-trash"></i></button>
                                            </form> 
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END Messages -->
                </div>
            </div>
            <!-- END Message List -->
        </div>
    </div>
</div>
@endsection
