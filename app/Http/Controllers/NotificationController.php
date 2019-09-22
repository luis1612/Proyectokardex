<?php

namespace sisKardex\Http\Controllers;

use Illuminate\Http\Request;
use sisKardex\Notification;
use Illuminate\Notifications\DatabaseNotification;
class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() { 
    	$unreadNotifications=auth()->user()->unreadNotifications;
    	$readNotifications=auth()->user()->readNotifications;
    	return view('notifications.index',compact('readNotifications','unreadNotifications'));
    }
    public function read($id) { 
    	DatabaseNotification::find($id)->markAsRead();
    	return back()->with('mensaje','Notification marcada como leida!!');

    }
     public function destroy($id) { 
    	DatabaseNotification::find($id)->delete();
    	return back()->with('mensaje','Notification Eliminada!!');

    }
}
