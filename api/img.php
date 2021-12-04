<?php 
header("Content-Type: image/jpeg");
include __DIR__ .'/../functions/function.php';
$url = $_GET['url'];
$url  = decrypt($url);
//echo $url;

$url = html_entity_decode($url);

$url = str_replace(' ', '%20', $url);

// echo $url;
$cx = file_get_contents($url);
// print_r($cx);
$image = imagecreatefromstring($cx);
// echo $image;
$imagex = imagesx($image);
$imagey = imagesy($image);

$pixelate_y=0;
$pixelate_x=0;
$height=$imagey;
$width=$imagex;
for($y = 0;$y < $height;$y += $pixelate_y+1)
{
    for($x = 0;$x < $width;$x += $pixelate_x+1)
    {
    // get the color for current pixel
    $rgb = imagecolorsforindex($image, imagecolorat($image, $x, $y));

    // get the closest color from palette
    $color = imagecolorclosest($image, $rgb['red'], $rgb['green'], $rgb['blue']);

    imagefilledrectangle($image, $x, $y, $x+$pixelate_x, $y+$pixelate_y, $color);   
    }
}
for ($x=1; $x<=50; $x++)
{
 imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
}

$imgW = imagecreatefrompng('../img/logooverlay.png');

// (C) POSITION CALCULATIONS
// (C1) SOURCE & WATERMARK DIMENSIONS
$widthS = imagesx($image);
$heightS = imagesY($image);
$widthW = imagesx($imgW);
$heightW = imagesY($imgW);

// (C2) CENTER POSITION
$posX = CEIL(($widthS - $widthW) / 2);
$posY = CEIL(($heightS - $heightW) / 2);
if ($posX < 0 || $posY < 0) { exit("Watermark image is too large"); } // OPTIONAL ERROR HANDLE

imagecopy(
  $image, $imgW, // COPY WATERMARK ONTO SOURCE IMAGE
  $posX, $posY, // PLACE WATERMARK AT TOP LEFT CORNER
  0, 0, $widthW, $heightW // COPY FULL WATERMARK IMAGE WITHOUT CLIPPING
);



function imagelinethick($image, $x1, $y1, $x2, $y2, $color, $thick = 1)
{
    /* this way it works well only for orthogonal lines
    imagesetthickness($image, $thick);
    return imageline($image, $x1, $y1, $x2, $y2, $color);
    */
    if ($thick == 1) {
        return imageline($image, $x1, $y1, $x2, $y2, $color);
    }
$t = $thick / 2 - 0.5;
if ($x1 == $x2 || $y1 == $y2) {
    return imagefilledrectangle($image, round(min($x1, $x2) - $t), round(min($y1, $y2) - $t), round(max($x1, $x2) + $t), round(max($y1, $y2) + $t), $color);
}
$k = ($y2 - $y1) / ($x2 - $x1); //y = kx + q
$a = $t / sqrt(1 + pow($k, 2));
$points = array(
    round($x1 - (1+$k)*$a), round($y1 + (1-$k)*$a),
    round($x1 - (1-$k)*$a), round($y1 - (1+$k)*$a),
    round($x2 + (1+$k)*$a), round($y2 - (1-$k)*$a),
    round($x2 + (1-$k)*$a), round($y2 + (1+$k)*$a),
);
imagefilledpolygon($image, $points, 4, $color);


return imagepolygon($image, $points, 4, $color);
}

imageJPEG($image, NULL, 75);

?>