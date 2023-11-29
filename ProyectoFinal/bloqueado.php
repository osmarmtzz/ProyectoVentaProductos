<?php
session_start();

$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "deportuaa";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["email"])) {
    $email = $_GET["email"];

    // Verificar si el correo existe en la base de datos
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Mostrar formulario para ingresar la respuesta de seguridad
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Bloqueado</title>
            <!-- LINKS -->
            <link rel="stylesheet" href="css/bloquedo.css">
        </head>
        <body>
        <div class="bienvenida"> Bienvenido/a a DEPORTUAA</div>
        <?php include 'nav.php'; ?> <br>
        <div>
        <video autoplay muted loop id="video-fondo">
            <source src="media/bloqueado.mp4" type="video/mp4">
            Tu navegador no soporta el tag de video.
        </video>
            <form method="post" action="bloqueado.php">
            <h2>!CUENTA BLOQUEADA!</h2>
            <h2>Ingresa la respuesta de seguridad para habilitarla</h2>
                
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <label>Respuesta de seguridad:</label><br>
                <input type="text" name="respuestaSeguridad" required><br>
                <?php
                    // Mostrar mensaje de error si la respuesta es incorrecta
                    if (isset($_GET['error']) && $_GET['error'] == 'respuestaIncorrecta') {
                        echo "<p style='color: red;'>Respuesta de seguridad incorrecta</p>";
                    }
                ?>
                <input type="submit" value="Verificar">
            </form>
            </div>
            <?php
        include 'footer.php';
    ?>
        </body>
        </html>
        <?php
    } else {
        echo "Correo no encontrado en la base de datos";
    }

    $stmt->close();
    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["respuestaSeguridad"])) {
    $email = $_POST["email"];
    $respuestaSeguridad = $_POST["respuestaSeguridad"];

    // Verificar si la respuesta de seguridad coincide
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ? AND pregunta_seguridad = ?");
    $stmt->bind_param("ss", $email, $respuestaSeguridad);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Mostrar formulario para ingresar nueva contraseña
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Bloqueado</title>
            <!-- LINKS -->
            <link rel="stylesheet" href="css/bloquedo.css">

        </head>
        <body>
            
        <div class="bienvenida"> Bienvenido/a a DEPORTUAA</div>
        <?php include 'nav.php'; ?> <br>
        <div>
        <video autoplay muted loop id="video-fondo">
            <source src="media/bloqueado.mp4" type="video/mp4">
            Tu navegador no soporta el tag de video.
        </video>
            <form method="post" action="actualizar_contrasena.php">
            <h2>!CUENTA BLOQUEADA!</h2>
            <h2>Ingresa una nueva contraseña</h2>

                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <label>Nueva Contraseña:</label><br>
                <input type="password" name="nuevaContrasena" required><br>
                <input type="submit" value="Actualizar Contraseña">
            </form>
            <?php
        include 'footer.php';
        ?>
        </body>
        </html>
        <?php
    } else {
        // Redirigir de nuevo al formulario con un parámetro de error
        header("Location: bloqueado.php?email=$email&error=respuestaIncorrecta");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
