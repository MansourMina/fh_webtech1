<?php function resizeImage($info, $filename)
{
    // Resize the image by half
    $percent = 0.5;
    list($width, $height) = getimagesize($info);
    $new_width = $width * $percent;
    $new_height = $height * $percent;
    $image_p = imagecreatetruecolor($new_width, $new_height);
    $contentType = mime_content_type($info);
    if ($contentType === "image/jpeg") {
        $image = imagecreatefromjpeg($info);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    }
    imagejpeg($image_p, $filename, 100);
    return $filename;
}
