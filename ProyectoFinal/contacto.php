<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $mensaje = $_POST["mensaje"];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'deportuaa@gmail.com';
        $mail->Password = 'pajf bxgv pzpf obav'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('deportuaa@gmail.com','DEPORTUAA' );
        $mail->addAddress($email,$nombre); 
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto desde DEPORTUAA';
        $mail->Body = "Hola $nombre,<br><br>Hemos recibido tu mensaje:<br><br>$mensaje<br><br>Pronto estaremos en contacto contigo!";

        $mail->send();
        echo 'Mensaje enviado correctamente';
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contacto</title>
<link rel="stylesheet" type="text/css" href="css/contacto.css">
</head>
<body>
<div class="bienvenida"> Bienvenido/a a DEPORTUAA</div>
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
				<form>
					<h2>Mandar Mensaje</h2>
					<div class="inputBox">
						<input type="text" name="" required="required">
						<span>Nombre Completo</span>
					</div>
					<div class="inputBox">
						<input type="text" name="" required="required">
						<span>Email</span>
					</div>
					<div class="inputBox">
						<textarea required="required"></textarea>
						<span>Escribe tu mensaje..</span>
					</div>
					<div class="inputBox">
						<input type="submit" value="Enviar">
					</div>
				</form>
			</div>
		</div>
	</section>
    <?php
        include 'footer.php';
    ?>

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
