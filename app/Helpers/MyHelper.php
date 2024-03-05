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

if (!function_exists('uploadImage')) {
    function uploadImage($image, $folder, $width = null, $height = null, $createThumbnail = false)
    {
        // Validate file
        validateImage($image);

        // Create directory if it doesn't exist
        $path = createDirectory($folder);

        // Check if file already exists
        $filename = $image->getClientOriginalName();
        checkIfFileExists($folder, $filename);

        // Extract metadata from the image
        $metadata = extractMetadata($image);

        // Resize and compress the image
        if ($width || $height) {
            list($tempImage, $width, $height, $originalWidth, $originalHeight) = resizeImage($image, $width, $height);

            // Compress the image
            $imageData = compressImage($tempImage, $image->getClientOriginalExtension(), $originalWidth, $originalHeight);

            // Store the file
            Storage::disk('public')->put($folder . '/' . $filename, $imageData);
        } else {
            // Store the file
            $image->storeAs('public/' . $folder, $filename);
        }

        // Create a thumbnail if requested
        if ($createThumbnail) {
            createThumbnail($image, $path, $filename, $image->getClientOriginalExtension(), $originalWidth, $originalHeight);
        }

        return [
            'filename' => $filename,
            'metadata' => $metadata,
        ];
    }
}

if (!function_exists('validateImage')) {
    function validateImage($image)
    {
        if (!$image instanceof UploadedFile || !$image->isValid()) {
            throw new \Exception('Invalid image file');
        }

        // Check file type for security
        $allowedFileTypes = ['jpg', 'png', 'jpeg', 'gif'];
        $extension = $image->getClientOriginalExtension();
        if (!in_array($extension, $allowedFileTypes)) {
            throw new \Exception('Invalid file type');
        }
    }
}

if (!function_exists('createDirectory')) {
    function createDirectory($folder)
    {
        // Create directory if it doesn't exist
        $path = storage_path('app/public/' . $folder);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}

if (!function_exists('checkIfFileExists')) {
    function checkIfFileExists($folder, $filename)
    {
        if (Storage::disk('public')->exists($folder . '/' . $filename)) {
            throw new \Exception('File already exists');
        }
    }
}

if (!function_exists('extractMetadata')) {
    function extractMetadata($image)
    {
        // Extract metadata from the image
        $metadata = exif_read_data($image);

        return $metadata;
    }
}

if (!function_exists('resizeImage')) {
    function resizeImage($image, $width, $height)
    {
        list($originalWidth, $originalHeight) = getimagesize($image);

        if (!$height) {
            $height = ($width / $originalWidth) * $originalHeight;
        } elseif (!$width) {
            $width = ($height / $originalHeight) * $originalWidth;
        }

        $tempImage = imagecreatetruecolor($width, $height);

        return [$tempImage, $width, $height, $originalWidth, $originalHeight];
    }
}

if (!function_exists('compressImage')) {
    function compressImage($tempImage, $extension, $originalWidth, $originalHeight)
    {
        // Compress the image if its size is more than 500 KB
        $maxSize = 500 * 1024; // 500 KB
        $quality = 100;
        $attempts = 0;

        do {
            ob_start();
            switch ($extension) {
                case 'jpg':
                case 'jpeg':
                    imagejpeg($tempImage, null, $quality);
                    break;
                case 'png':
                    imagepng($tempImage, null, 9 - round(9 * $quality / 100));
                    break;
                case 'gif':
                    imagegif($tempImage);
                    break;
            }
            $imageData = ob_get_contents();
            ob_end_clean();

            $size = strlen($imageData);
            $quality -= 10;
            $attempts++;
        } while ($size > $maxSize && $attempts < 5);

        if ($size > $maxSize) {
            throw new \Exception('Unable to compress the image to the required size');
        }

        return $imageData;
    }
}

if (!function_exists('createThumbnail')) {
    function createThumbnail($image, $path, $filename, $extension, $originalWidth, $originalHeight)
    {
        $thumbnailWidth = 200; // Width of the thumbnail
        $thumbnailHeight = 200; // Height of the thumbnail

        $thumbnail = imagecreatetruecolor($thumbnailWidth, $thumbnailHeight);

        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $originalImage = imagecreatefromjpeg($image);
                imagecopyresampled($thumbnail, $originalImage, 0, 0, 0, 0, $thumbnailWidth, $thumbnailHeight, $originalWidth, $originalHeight);
                imagejpeg($thumbnail, $path . '/thumbnail_' . $filename);
                break;
            case 'png':
                $originalImage = imagecreatefrompng($image);
                imagecopyresampled($thumbnail, $originalImage, 0, 0, 0, 0, $thumbnailWidth, $thumbnailHeight, $originalWidth, $originalHeight);
                imagepng($thumbnail, $path . '/thumbnail_' . $filename);
                break;
            case 'gif':
                $originalImage = imagecreatefromgif($image);
                imagecopyresampled($thumbnail, $originalImage, 0, 0, 0, 0, $thumbnailWidth, $thumbnailHeight, $originalWidth, $originalHeight);
                imagegif($thumbnail, $path . '/thumbnail_' . $filename);
                break;
        }

        imagedestroy($thumbnail);
    }
}




// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

// class BrandController extends Controller
// {
//     public function store(Request $request)
//     {
//         $this->validate($request, [
//             'image' => 'required|image',
//             // ... other validation rules
//         ]);

//         try {
//             $result = uploadImage($request->file('image'), 'brand', null, null, true);
//             $filename = $result['filename'];
//             $metadata = $result['metadata'];

//             // Store the filename and metadata in the database
//             // ...

//             return redirect()->back()->with('success', 'Image uploaded successfully');
//         } catch (\Exception $e) {
//             return redirect()->back()->with('error', $e->getMessage());
//         }
//     }

//     public function update(Request $request, $id)
//     {
//         $this->validate($request, [
//             'image' => 'image',
//             // ... other validation rules
//         ]);

//         try {
//             // Fetch the brand from the database
//             $brand = Brand::findOrFail($id);

//             if ($request->hasFile('image')) {
//                 // Delete the old image file
//                 Storage::disk('public')->delete('brand/' . $brand->image);

//                 // Upload the new image
//                 $result = uploadImage($request->file('image'), 'brand', null, null, true);
//                 $filename = $result['filename'];
//                 $metadata = $result['metadata'];

//                 // Update the filename and metadata in the database
//                 $brand->image = $filename;
//                 $brand->metadata = $metadata; // Assuming the 'metadata' column exists in your 'brands' table
//                 $brand->save();
//             }

//             // ... update other fields

//             return redirect()->back()->with('success', 'Brand updated successfully');
//         } catch (\Exception $e) {
//             return redirect()->back()->with('error', $e->getMessage());
//         }
//     }
// }
