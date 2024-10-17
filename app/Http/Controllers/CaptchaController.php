<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function generate_captcha()
    {
        $randomnr = rand(100000, 999999);
        session(['randomnr2' => md5($randomnr)]);

        $im = imagecreatetruecolor(150, 48);

        $white = imagecolorallocate($im, 255, 255, 255);
        $grey = imagecolorallocate($im, 150, 150, 150);
        $black = imagecolorallocate($im, 0, 0, 0);

        imagefilledrectangle($im, 0, 0, 200, 35, $black);

        // path to font - this is just an example you can use any font you like:
        $font = public_path('captcha-font/tahoma.ttf');

        imagettftext($im, 25, 0, 22, 30, $grey, $font, $randomnr);
        imagettftext($im, 25, 0, 15, 32, $white, $font, $randomnr);

        // prevent caching on client side:
        header("Expires: Wed, 1 Jan 1997 00:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        header ("Content-type: image/gif");
        imagegif($im);
        imagedestroy($im);
    }

    public function refreshCaptcha()
    {
        $randomnr = rand(100000, 999999);
        session(['randomnr2' => md5($randomnr)]);

        $im = imagecreatetruecolor(150, 48);

        $white = imagecolorallocate($im, 255, 255, 255);
        $grey = imagecolorallocate($im, 150, 150, 150);
        $black = imagecolorallocate($im, 0, 0, 0);

        imagefilledrectangle($im, 0, 0, 200, 35, $black);

        // path to font - this is just an example you can use any font you like:
        $font = public_path('captcha-font/tahoma.ttf');

        imagettftext($im, 25, 0, 22, 30, $grey, $font, $randomnr);
        imagettftext($im, 25, 0, 15, 32, $white, $font, $randomnr);

        ob_start();
        imagegif($im);
        $imageData = ob_get_contents();
        ob_end_clean();
        imagedestroy($im);

        $base64 = 'data:image/gif;base64,' . base64_encode($imageData);

        return response()->json(['captcha' => $base64]);
    }
}
