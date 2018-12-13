<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

use App\ActivityLog;
use App\User;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = ActivityLog::get();

        $admins = json_encode(ActivityLog::getAuthModels($logs));
        $events = json_encode(ActivityLog::getModelEvents($logs));
        $models = json_encode(ActivityLog::getModels($logs));

        return view('admin.activity-logs.index', [
            'admins' => $admins,
            'events' => $events,
            'models' => $models,
        ]);
    }
}
