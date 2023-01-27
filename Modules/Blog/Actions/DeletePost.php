<?php

namespace Modules\Blog\Actions;

class DeletePost
{
    public static function delete($post)
    {
        $image = file_exists($post->image);

        if ($image) {
            deleteImage($post->image);
        }

        return $post->delete();
    }
}
