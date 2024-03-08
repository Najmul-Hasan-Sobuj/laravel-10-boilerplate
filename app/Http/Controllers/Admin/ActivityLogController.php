<?php

namespace App\Http\Controllers\Admin;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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

    public function destroy(ActivityLog $activity_log): RedirectResponse
    {
        $activity_log->delete();

        return redirect()->route('admin.activity_logs.index')->with('success', 'Activity log deleted successfully');
    }
}
