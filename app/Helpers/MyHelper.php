use Illuminate\Support\Facades\Storage;
<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

// if (!function_exists('myHelper')) { // example of a helper function
//     function myHelper($param)
//     {
//         return $param * 2;
//     }
// }

if (!function_exists('sanitizeFileName')) {
    function sanitizeFileName($filename)
    {
        return preg_replace('/[^A-Za-z0-9_\-\.]/', '', $filename);
    }
}

if (!function_exists('preventOverwrite')) {
    function preventOverwrite($uploadPath, $filename)
    {
        $fileExists = Storage::exists($uploadPath . '/' . $filename);
        $counter = 1;
        while ($fileExists) {
            $filename = pathinfo($filename, PATHINFO_FILENAME) . '_' . $counter . '.' . pathinfo($filename, PATHINFO_EXTENSION);
            $fileExists = Storage::exists($uploadPath . '/' . $filename);
            $counter++;
        }
        return $filename;
    }
}

if (!function_exists('extractMetadata')) {
    function extractMetadata(UploadedFile $file)
    {
        if ($file->getMimeType() == 'image/jpeg' || $file->getMimeType() == 'image/tiff') {
            $metadata = exif_read_data($file->getRealPath());
            return $metadata;
        }
        return [];
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage(UploadedFile $file, $folder = 'default')
    {
        if (!$file->isValid()) {
            throw new \Exception('Invalid file');
        }

        $extension = $file->getClientOriginalExtension();
        $filename = sanitizeFileName(uniqid() . '.' . $extension);

        // Check the file type and set the upload folder
        if (in_array($file->getMimeType(), ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])) {
            $folder = 'files';
        }

        $uploadPath = 'public/' . $folder;

        if (!Storage::exists($uploadPath) && !Storage::makeDirectory($uploadPath, 0777, true)) {
            throw new \Exception('Could not create directory: ' . $uploadPath);
        }

        $filename = preventOverwrite($uploadPath, $filename);
        $file->storeAs($uploadPath, $filename);

        $metadata = extractMetadata($file);

        $filePath = Storage::url($folder . '/' . $filename);

        return ['filePath' => $filePath, 'metadata' => $metadata];
    }
}
