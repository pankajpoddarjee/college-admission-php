<?php
session_start();

// Generate a random string for the CAPTCHA
$captchaText = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);

// Store the CAPTCHA text in a session variable
$_SESSION['captcha'] = $captchaText;

// Create an image
$width = 120;
$height = 40;
$image = imagecreatetruecolor($width, $height);

// Set colors
$bgColor = imagecolorallocate($image, 255, 255, 255); // White background
$textColor = imagecolorallocate($image, 0, 0, 0); // Black text
$lineColor = imagecolorallocate($image, 64, 64, 64); // Gray lines

// Fill the background
imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);

// Add random lines to make the CAPTCHA more difficult for bots
for ($i = 0; $i < 5; $i++) {
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
}

// Add the CAPTCHA text to the image
$fontSize = 20; // Font size
$font = dirname(__FILE__) . '/bootstrap/font/arial.ttf'; // Path to a TrueType font file

// Check if the font file exists
if (file_exists($font)) {
    imagettftext($image, $fontSize, 0, 10, 30, $textColor, $font, $captchaText);
} else {
    // Use imagestring if the font file is not available
    imagestring($image, 5, 20, 10, $captchaText, $textColor);
}

// Output the image as a PNG
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
