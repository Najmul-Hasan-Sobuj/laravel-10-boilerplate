<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    private $logPath;

    public function __construct()
    {
        $this->logPath = storage_path('logs');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logs = collect(File::files($this->logPath))->map(function ($item) {
            return [
                'name' => $item->getFilename(),
                'last_modified' => Carbon::createFromTimestamp($item->getMTime())->diffForHumans(),
                'size' => $item->getSize(),
                'date' => Carbon::createFromTimestamp($item->getMTime())->toDateTimeString()
            ];
        });

        return view('admin.pages.logs.index', ['logs' => $logs]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $content = File::get($this->logPath . '/' . $id);

        return view('admin.pages.logs.show', compact('content'));
    }

    public function download($id)
    {
        return response()->download($this->logPath . '/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $name)
    {
        File::delete($this->logPath . '/' . $name);

        return redirect()->back()->with('success', 'Log file deleted successfully');
    }
}
