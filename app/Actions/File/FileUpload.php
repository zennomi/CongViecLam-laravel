<?php

namespace App\Actions\File;

use Illuminate\Support\Facades\Storage;

class FileUpload
{
    public static function upload($file, $path)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs("public/$path", $file, $fileName);

        return "storage/$path/" . $fileName;
    }

    public static function uploadPrivateFile($file, $path)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs("/$path", $file, $fileName);
        return "$path/" . $fileName;
    }
}
