<?php

namespace Modules\Testimonial\Actions;

class DeleteTestimonial
{
    public static function delete($testimonial)
    {
        $testimonialImage = file_exists($testimonial->image);

        if ($testimonialImage) {
            deleteImage($testimonial->image);
        }

        return $testimonial->delete();
    }
}
