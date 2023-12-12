<?php
session_start();

// Generar un código captcha aleatorio
$captchaCode = substr(md5(mt_rand()), 0, 6);

// Almacenar el código captcha en la sesión
$_SESSION['captcha_code'] = $captchaCode;

// Crear una imagen para el captcha
$imageWidth = 200;
$imageHeight = 70;
$image = imagecreatetruecolor($imageWidth, $imageHeight);

// Definir colores
$backgroundColor = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);

// Rellenar el fondo con un color diferente y agregar ruido
imagefilledrectangle($image, 0, 0, $imageWidth, $imageHeight, imagecolorallocate($image, 200, 220, 240));
for ($i = 0; $i < 200; $i++) {
    imagesetpixel($image, mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255)));
}

// Establecer la fuente y el tamaño (fuente interna)
$font = 'fonts/arial.ttf'; // Reemplaza con la ruta correcta de tu fuente TrueType (.ttf)
$fontSize = 28;

// Dibujar el texto del captcha en la imagen con distorsión
for ($i = 0; $i < strlen($captchaCode); $i++) {
    $char = $captchaCode[$i];
    $x = 20 + ($i * 30);
    $y = mt_rand(30, 40);
    $angle = mt_rand(-15, 15);
    $charColor = imagecolorallocate($image, mt_rand(0, 150), mt_rand(0, 150), mt_rand(0, 150));
    imagestring($image, $fontSize, $x, $y, $char, $charColor);
    imagettftext($image, $fontSize, $angle, $x, $y, $charColor, $font, $char);
}

// Agregar líneas onduladas de fondo adicionales
for ($i = 0; $i < 10; $i++) {
    $lineColor = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
    imagearc($image, mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), mt_rand(50, 200), mt_rand(20, 70), mt_rand(0, 360), mt_rand(0, 360), $lineColor);
}

// Agregar puntos de distorsión alrededor del texto
for ($i = 0; $i < 100; $i++) {
    imagesetpixel($image, mt_rand(0, $imageWidth), mt_rand(0, $imageHeight), $textColor);
}

// Establecer el tipo de contenido de la respuesta como imagen PNG
header('Content-type: image/png');

// Mostrar la imagen del captcha
imagepng($image);

// Liberar la memoria utilizada para la imagen
imagedestroy($image);
?>
