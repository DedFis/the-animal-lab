<?php
/**
 * Built assets aren't currently routeable via vercel-php
 * Manually route assets to be found
 */
if ($_GET['type'] === 'css') {
    header("Content-type: text/css; charset: UTF-8");
    echo require __DIR__ . '/../public/css/' . basename($_GET['file']);
} else if ($_GET['type'] === 'js') {
    header('Content-Type: application/javascript; charset: UTF-8');
    echo require __DIR__ . '/../public/js/' . basename($_GET['file']);
} else if ($_GET['type'] === 'images') {
    $file = basename($_GET['file']);
    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    $mimeTypes = [
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'webp' => 'image/webp',
    ];

    if (array_key_exists($extension, $mimeTypes)) {
        header('Content-Type: ' . $mimeTypes[$extension]);
    } else {
        // Handle unsupported types
        header('Content-Type: application/octet-stream');
    }

    echo require __DIR__ , '/../public/images' . $file;
}