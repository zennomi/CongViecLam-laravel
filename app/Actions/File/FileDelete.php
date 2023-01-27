<?php

namespace App\Actions\File;

class FileDelete
{
    public static function delete($image){
        @unlink($image);
    }
}
