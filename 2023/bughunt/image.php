<?php
// Define the paths
$imagePath = 'img' . $_SERVER['REQUEST_URI'];
$defaultImagePath = '404bug.png';

// Check if the requested image exists
if (!file_exists($imagePath)) {
    // Serve the default image
    header('Content-Type: image/png');
    readfile($defaultImagePath);
} else {
    // Serve the requested image
    header('Content-Type: image/png');
    readfile($imagePath);
}
?>
