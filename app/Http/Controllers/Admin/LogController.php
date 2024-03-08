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
                'id' => md5($item->getFilename()), // Unique identifier
                'name' => $item->getFilename(),
                'last_modified' => Carbon::createFromTimestamp($item->getMTime())->diffForHumans(),
                'size' => number_format($item->getSize() / 1024, 2) . ' KB',
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
        return view('admin.pages.logs.show', ['content' => File::get($this->logPath . '/' . $id)]);
    }

    public function download($id)
    {
        return response()->download($this->logPath . '/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $files = File::files($this->logPath);
        foreach ($files as $file) {
            if (md5($file->getFilename()) == $id) {
                // Delete the file
                File::delete($file->getPathname());
                break;
            }
        }
    }
}
