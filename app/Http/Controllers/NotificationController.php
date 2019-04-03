<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Notifications\NewReplyNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\HasDatabaseNotifications;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }
    public function index()
    {

        return [
            /********des routes deja prétablies dans laravel****/
            'read'=>  NotificationResource::collection(auth()->user()->readNotifications) ,
            'unread'=> NotificationResource::collection(auth()->user()->unreadNotifications),
        ];
    }


    public function markAsRead(Request $request)
    {
        auth()->user()->notifications->where('id',$request->id)->markAsRead();
    }
}
