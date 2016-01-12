<?php
// system('pngquant --quality=90 image.png');
// This script takes an image and resizes it to the given dimensions, then saves
// that version on the filesystem so Apache can serve it directly in the future.

// It is inspired by Drupal's ImageCache module [1] and a blog post by Sumit
// Birla [2], but was written from scratch.

// It automatically doubles the dimensions if the suffix '@2x' is used, for use
// with the jQuery Retina Display plugin or retina.js [4].

// [1]: http://drupal.org/project/imagecache
// [2]: http://sumitbirla.com/2011/11/how-to-build-a-scalable-caching-resizing-image-server/
// [3]: https://github.com/mcilvena/jQuery-Retina-Display-Plugin
// [4]: http://retinajs.com/

// https://gist.github.com/davejamesmiller/3236415

chdir(dirname(__FILE__));

// $size = $_GET['size'];
$thumbWidth = $_GET['width'];
$thumbHeight = $_GET['height'];
if(empty($_GET['file']))
    $file = $_GET['path'];
else {
    $path = $_GET['path'];
    $file = $_GET['file'];
}

$fileNamePath = pathinfo($file, PATHINFO_FILENAME);
$fileNameExtension = pathinfo($file, PATHINFO_EXTENSION);

$original = $_SERVER['DOCUMENT_ROOT'] . '/img/' . (!empty($path) ? $path . '/' : '') . $file ;
$target = $_SERVER['DOCUMENT_ROOT'] . '/img/cache/' . $fileNamePath . '/' . $thumbWidth . '-' . $thumbHeight . '.' . $fileNameExtension;

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/img/cache/' . $fileNamePath)) {
  mkdir($_SERVER['DOCUMENT_ROOT'] . '/img/cache/' . $fileNamePath, 0777, true);
}

// Check the filename is safe & check file type
if (preg_match('#^[a-z0-9\.\-]+(@2x)?\.(jpg|jpeg|png)$#i', $file, $matches) && strpos($file, '..') === false) {
  $retina = $matches[1];
  $extension = $matches[2];
} else {
    print_r($_GET);
  die("Invalid filename: $file");
}

// Double the size for retina devices
if ($retina) {
  if ($thumbWidth) $thumbWidth *= 2;
  if ($thumbHeight) $thumbHeight *= 2;
  $original = str_replace('@2x', '', $original);
}

// Check the original file exists
if (!file_exists ($original)) {
  die('File doesn\'t exist');
}

// Make sure the file doesn't exist already
if (!file_exists($target)) {

  // Make sure we have enough memory
  ini_set('memory_limit', 128*1024*1024);

  // Get the current size & file type
  list($width, $height, $type) = getimagesize($original);

  if($thumbWidth > $width) {
    $thumbWidth = $width;
  }

  if($thumbHeight > $height) {
    $thumbHeight = $height;
  }

  // Load the image
  switch ($type) {
    case IMAGETYPE_GIF:
      $image = imagecreatefromgif($original);
      break;

    case IMAGETYPE_JPEG:
      $image = imagecreatefromjpeg($original);
      break;

    case IMAGETYPE_PNG:
      $image = imagecreatefrompng($original);
      break;

    default:
      die("Invalid image type (#{$type} = " . image_type_to_extension($type) . ")");
  }

    // Double the size for retina devices
    if ($retina) {
        if ($thumbWidth) $thumbWidth *= 2;
        if ($thumbHeight) $thumbHeight *= 2;
    }

  // Calculate height automatically if not given
  if ($thumbHeight === null || $thumbHeight == '0') {
    $thumbHeight = round($height * $thumbWidth / $width);
  }

  // Ratio to resize by
  $widthProportion = $thumbWidth / $width;
  $heightProportion = $thumbHeight / $height;
  $proportion = max($widthProportion, $heightProportion);

  // Area of original image that will be used
  $origWidth = floor($thumbWidth / $proportion);
  $origHeight = floor($thumbHeight / $proportion);

  // Co-ordinates of original image to use
  $x1 = floor($width - $origWidth) / 2;
  $y1 = floor($height - $origHeight) / 2;

  // Resize the image
  $thumbImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
  imagecopyresampled($thumbImage, $image, 0, 0, $x1, $y1, $thumbWidth, $thumbHeight, $origWidth, $origHeight);

  // Save the new image
  switch ($type)
  {
    case IMAGETYPE_GIF:
      imagegif($thumbImage, $target);
      break;

    case IMAGETYPE_JPEG:
      imagejpeg($thumbImage, $target, 50);
      break;

    case IMAGETYPE_PNG:
      imagepng($thumbImage, $target, 9);
      break;

    default:
      throw new LogicException;
  }

  // Make sure it's writable
  chmod($target, 0666);

  // Close the files
  imagedestroy($image);
  imagedestroy($thumbImage);
}

// Send the file header
$data = getimagesize($original);
if (!$data) {
  die("Cannot get mime type");
} else {
  header('Content-Type: ' . $data['mime']);
}

// Send the file to the browser
readfile($target);