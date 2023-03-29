<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\URL;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveImage($image, $path = 'public')
    {
       /* if(!$image)
        {
            return null;
        }

        $filename = time().'.png';

        \Storage::disk($path)->put($filename, base64_decode($image));
        return URL::to('/').'/storage/'.$path.'/'.$filename; */


        if(image != null) {

            $image_name = $this->image->getClientOriginalName();
            $this->image->storeAs('public/img/nfc/profile', $image_name);
        }
        else {
            $image_name = 'default.jpg';
        }



    }
}
