<?php

namespace App\Http\Controllers\Admin;

use App\Models\ActivityLog;
use App\Http\Controllers\Controller;

class ActivityLogController extends Controller
{
    public function index()
    {
        return view('admin.pages.activity_logs.index', ['activityLogs' => ActivityLog::all()]);
    }

    public function show(ActivityLog $activityLog)
    {
        return view('admin.pages.activity_logs.show', compact('activityLog'));
    }

    public function destroy(ActivityLog $activity_log)
    {
        $activity_log->delete();
    }
}
