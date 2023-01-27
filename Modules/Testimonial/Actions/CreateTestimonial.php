<?php

namespace Modules\Testimonial\Actions;

use App\Actions\File\FileUpload;
use Modules\Testimonial\Entities\Testimonial;

class CreateTestimonial
{
    public static function create($request)
    {
        $testimonial = Testimonial::create($request->all());

        $image = $request->image;
        if ($image) {
            $url = uploadImage($image, 'testimonial');
            $testimonial->update(['image' => $url]);
        }

        return $testimonial;
    }
}
