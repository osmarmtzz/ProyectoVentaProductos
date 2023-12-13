<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = utf8_decode($_POST["nombre"]);
    $email = $_POST["email"];
    $mensaje = utf8_decode($_POST["mensaje"]);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'deportuaa@gmail.com';
        $mail->Password = 'pajf bxgv pzpf obav';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('deportuaa@gmail.com', 'DEPORTUAA');
        $mail->addAddress($email, $nombre);
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto desde DEPORTUAA';
		$mail->Body = "
		<div style='font-family: 'Arial', sans-serif; max-width: 600px; margin: 20px auto;'>
			<div style='background-color: #333; color: #ffd700; padding: 20px; border-radius: 8px; text-align: center;'>
				<h2 style='color: #ffd700;'>Mensaje de contacto</h2>
			</div>
			<div style='background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>
				<p style='color: #555; text-align: justify;'>Estimado/a ,</p>
				<p style='color: #555; text-align: justify;'>Hemos recibido tu mensaje:</p>
				<p style='color: #555; text-align: justify;'>$</p>
				<p style='color: #555; text-align: justify;'>Pronto estaremos en contacto contigo.</p>
				<p style='color: #555; text-align: justify;'>Gracias,</p>
				<p style='color: #555; text-align: justify;'>Equipo DEPORTUAA</p>
			</div>
		</div>
	";
        $mail->send();
        $response = array("status" => "success", "message" => "Mensaje enviado correctamente");
        echo json_encode($response);
        exit;
    } catch (Exception $e) {
        $response = array("status" => "error", "message" => "Error al enviar el mensaje: {$mail->ErrorInfo}");
        echo json_encode($response);
        exit;
    }
}
?>