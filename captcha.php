<?php

include __DIR__ . '/bootstrap.php';

create_image();

function create_image()
{
    $md5_hash = md5(rand(0, 999));
    $captcha = strtoupper(substr($md5_hash, 15, 6));
    $_SESSION['captcha'] = $captcha;

    $width = 200;
    $height = 50;

    $image = ImageCreate($width, $height);

    $black = imagecolorallocate($image, 0, 0, 0);
    $white = imagecolorallocate($image, 255, 255, 255);

    imagefill($image, 0, 0, $black);

    $font = "./fonts/font.ttf";

    $heightValue = rand(20, 25);
    $horizontalValue = rand(-5, 10);
    $xPos = rand(1, 80);

    $textColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));

    imagettftext($image, $heightValue, $horizontalValue, $xPos, 40, $textColor, $font, $captcha);

    header("Content-Type: image/jpeg");

    imagejpeg($image);

    imagedestroy($image);
}


function random_color_part()
{
    return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
}

function random_color()
{
    return random_color_part() . random_color_part() . random_color_part();
}
