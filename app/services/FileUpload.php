<?php

namespace App\Services;

class FileUpload
{
    /**
     * Upload the given file to the specified directory.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @return string
     */
    public function upload($file, $directory)
    {
        // Ensure the directory exists
        $path = public_path($directory);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);  // Create directory if it doesn't exist
        }

        // Get original filename and move the file to the target directory
        $filename = time() . '_' . $file->getClientOriginalName();  // Avoid name conflicts
        $file->move($path, $filename);

        return "$directory/$filename";  // Return the relative path for storage
    }
}
