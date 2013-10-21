<?php

include_once 'config.php';

$img_width = 1000;
$img_height = 1000;
$min_lat = 42.38;
$max_lat = 42.40;
$min_lng = -72.54;
$max_lng = -72.51;

$img =  imagecreatetruecolor( $img_width, $img_height );
imagesavealpha($img, true);
$pallette = imagecreatefromgif('pallette2.gif');
$dot = imagecreatefrompng('dot60b.png');

$bg = imagecolorallocate ( $img, 0,0,0 );
imagesetbrush($img, $dot);

if ($db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS)) {

  mysqli_select_db($db, DB_NAME);

  $result = mysqli_query($db, 'SELECT * FROM submissions');

  while ($row = mysqli_fetch_object($result)) {
    $x_pos = round(($row->lng-$min_lng)/($max_lng-$min_lng)*$img_width);
    $y_pos = $img_height-round(($row->lat-$min_lat)/($max_lat-$min_lat)*$img_height);
    imageline($img, $x_pos, $y_pos, $x_pos, $y_pos, IMG_COLOR_BRUSHED);
  };

  mysqli_close($db);

};

imagetruecolortopalette ( $img , false , 255 );
// echo imagecolorstotal($img);

// Now color the image with the pallette
imagepalettecopy($img,$pallette);

// Now make the background transparent
imagecolortransparent($img, $bg);

// Now make this image transparent
$img_final =  imagecreatetruecolor( $img_width, $img_height );
$bg2 = imagecolorallocate ( $img_final, 0,0,0 );
imagecolortransparent($img_final, $bg2);
imagefilledrectangle($img_final,0,0,$img_width, $img_height,$bg2);
imagecopymerge($img_final, $img, 0, 0, 0, 0, $img_width, $img_height, 50);

// Output image:
header( "Content-type: image/png" );
imagepng( $img );
imagedestroy( $img );
imagedestroy( $pallette );
imagedestroy( $dot );

?>