<?php

use Illuminate\Support\Facades\Storage;


/**
 * image upload
 *
 * @param object $file
 * @param string $path
 * @return void
 */
function uploadImage(?object $file, string $path): string
{
    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    Storage::putFileAs("public/$path", $file, $fileName);

    return "storage/$path/" . $fileName;
}

/**
 * image delete
 *
 * @param string $image
 * @return void
 */
function deleteImage(?string $image)
{
    $imageExists = file_exists($image);

    if ($imageExists) {
        @unlink($image);
    }
}
