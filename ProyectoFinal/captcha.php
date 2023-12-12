<?php
session_start();

// Generar un código captcha aleatorio
$captchaCode = substr(md5(mt_rand()), 0, 6);

// Almacenar el código captcha en la sesión
$_SESSION['captcha_code'] = $captchaCode;

// Crear una imagen para el captcha
$image = imagecreate(120, 40);

// Definir colores
$backgroundColor = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);

// Dibujar el texto del captcha en la imagen
imagestring($image, 5, 20, 12, $captchaCode, $textColor);

// Establecer el tipo de contenido de la respuesta como imagen PNG
header('Content-type: image/png');

// Mostrar la imagen del captcha
imagepng($image);

// Liberar la memoria utilizada para la imagen
imagedestroy($image);
?>
