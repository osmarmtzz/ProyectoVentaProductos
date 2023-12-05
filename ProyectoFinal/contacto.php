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
				<p style='color: #555; text-align: justify;'>Estimado/a $nombre,</p>
				<p style='color: #555; text-align: justify;'>Hemos recibido tu mensaje:</p>
				<p style='color: #555; text-align: justify;'>$mensaje</p>
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" type="text/css" href="css/contacto.css">
</head>
<body>
    <div class="bienvenida">Bienvenido/a a DEPORTUAA</div>
    <?php include 'nav.php'; ?>
    <section class="contact">
        <div class="content">
            <h2>Contactanos </h2>
            <p>Estamos disponibles para ayudarte en cualquier momento. Si tienes preguntas o necesitas asistencia, no dudes en contactarnos. Tu satisfacción es nuestra prioridad. ¡Estamos aquí para ti!</p>
        </div>
        <div class="container">
            <div class="contactInfo">
                <div class="box">
                    <div class="icon"><ion-icon name="location-outline"></ion-icon></div>
                    <div class="text">
                        <h3>Direccion</h3>
                        <p>Av. Universidad # 940,<br>Ciudad Universitaria, C.P. 20100,<br>Aguascalientes, Ags. México</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><ion-icon name="call-outline"></ion-icon></div>
                    <div class="text">
                        <h3>Telefono</h3>
                        <p>449 605 7675</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><ion-icon name="mail-outline"></ion-icon></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>deportuaa@gmail.com</p>
                    </div>
                </div>
                <h2 class="txt"> Conectate con nosotros</h2>
                <ul class="sci">
                    <li><a href="#"><ion-icon name="logo-facebook"></ion-icon></a></li>
                    <li><a href="#"><ion-icon name="logo-twitter"></ion-icon></a></li>
                    <li><a href="#"><ion-icon name="logo-linkedin"></ion-icon></a></li>
                    <li><a href="#"><ion-icon name="logo-instagram"></ion-icon></a></li>
                </ul>
            </div>

            <div class="contactForm">
                <form id="contactForm" method="post">
                    <h2>Mandar Mensaje</h2>
                    <div class="inputBox">
                        <input type="text" name="nombre" required="required">
                        <span>Nombre Completo</span>
                    </div>
                    <div class="inputBox">
                        <input type="email" name="email" required="required">
                        <span>Email</span>
                    </div>
                    <div class="inputBox">
                        <textarea name="mensaje" required="required"></textarea>
                        <span>Escribe tu mensaje..</span>
                    </div>
                    <div class="inputBox">
                        <input type="submit" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('contactForm');

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    form.reset();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al enviar el formulario.');
                });
            });
        });
    </script>
</body>
</html>
