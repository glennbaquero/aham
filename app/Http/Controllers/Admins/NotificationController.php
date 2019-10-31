<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notification;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Read Notification.
     *
     * @return \Illuminate\Http\Response
     */
    public function read($id)
    {
        Notification::find($id)->update(['read_at' => Carbon::now()]);

        return response()->json([
            'message' => 'success',
        ]);
    }

    public function getAllNotification()
    {
        $unreadNotifications = auth()->user()->notifications()->where(['type' => 'App\Notifications\ContactUsMessageNotification', 'read_at' => null])->latest()->get();
        $readNotifications = auth()->user()->notifications()->where(['type' => 'App\Notifications\ContactUsMessageNotification'])->whereNotNull('read_at')->latest()->get();
        return response()->json([
            'readNotifications' => $readNotifications,
            'unreadNotifications' => $unreadNotifications
        ]);
    }
}
