<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class BreadcrumbServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    // public function register()
    // {
    //     $breadcrumbs = collect(request()->segments())->map(function ($segment, $key) {
    //         return [
    //             'url' => '/' . implode('/', array_slice(request()->segments(), 0, $key + 1)),
    //             'name' => ucfirst($segment),
    //         ];
    //     })->toArray();

    //     View::share('breadcrumbs', $breadcrumbs);
    // }

    public function register()
    {
        $breadcrumbs = collect(request()->segments())->map(function ($segment, $key) {
            // Initialize the name variable
            $name = null;

            // Define the directory where your models are located
            $modelsDirectory = app_path('Models');

            // Scan the directory for subdirectories (e.g., 'Admin', 'HR', 'Sales')
            $directories = File::directories($modelsDirectory);

            // Initialize an empty namespace variable
            $namespace = null;

            foreach ($directories as $directory) {
                // Get the name of the subdirectory (e.g., 'Admin', 'HR', 'Sales')
                $directoryName = basename($directory);

                // Check if the current segment matches any subdirectory name
                if (strtolower($segment) === strtolower($directoryName)) {
                    // Generate the namespace for the subdirectory's models
                    $namespace = 'App\Models\\' . $directoryName;
                    View::share('namespace', $namespace);
                    // Find the model instance using the segment value as the ID
                    $modelInstance = $namespace::find($segment);

                    // If a model instance is found, retrieve its name attribute
                    $name = $modelInstance ? $modelInstance->name : ucfirst($segment);

                    break;
                }
            }

            // If no matching namespace is found, fall back to using the segment value itself as the name
            $name = $name ?: ucfirst($segment);

            return [
                'url' => '/' . implode('/', array_slice(request()->segments(), 0, $key + 1)),
                'name' => $name,
            ];
        })->toArray();
        View::share('breadcrumbs', $breadcrumbs);
    }



    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
