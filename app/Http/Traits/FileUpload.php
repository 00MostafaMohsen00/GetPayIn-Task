<?php

namespace App\Http\Traits;


trait FileUpload
{
    public function uploadImage($file, $folder)
    {
        $filename = $file->store($folder, 'public');

        return  $filename;
    }

    public function removeImage($folder, $file)
    {
        $path = public_path('storage/' . $folder . '/' .  $file);
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
