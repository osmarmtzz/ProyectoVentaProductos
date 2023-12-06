<?php
session_start();

generarCaptcha();

function verificarCredenciales($email, $password) {
    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "deportuaa";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, password, cuenta FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId, $hashedPassword, $userCuenta);

    if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
        $_SESSION["user_cuenta"] = $userCuenta;
        $_SESSION["user_id"] = $userId;
        $_SESSION["intentos"] = 0;
        $stmt->close();
        $conn->close();
        return true;
    } else {
        $stmt->close();
        $conn->close();
        return false;
    }
}

function registrarCuenta($nombre, $email, $preguntaSeguridad, $password, $cuenta) {
    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "deportuaa";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, pregunta_seguridad, password, cuenta) VALUES (?, ?, ?, ?, ?)");
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("sssss", $nombre, $email, $preguntaSeguridad, $hashedPassword, $cuenta);

    if ($stmt->execute()) {
    } else {
        echo "Error al registrar. Inténtalo de nuevo.";
    }

    $stmt->close();
    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["registro"])) {
    $nombre = $_POST["nombre"];
    $email_registro = $_POST["email"];
    $preguntaSeguridad = $_POST["seguridad"];
    $password_registro = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $cuenta = $_POST["cuenta"];

    if (empty($nombre) || empty($email_registro) || empty($preguntaSeguridad) || empty($password_registro) || empty($confirmPassword) || empty($cuenta)) {
        echo "Todos los campos son obligatorios";
    } elseif ($password_registro != $confirmPassword) {
        echo '<script>document.getElementById("error-message").innerHTML = "Las contraseñas no coinciden";</script>';
    } else {
        registrarCuenta($nombre, $email_registro, $preguntaSeguridad, $password_registro, $cuenta);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["registro"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $captchaIngresado = $_POST["captcha"];

   
    if (verificarCaptcha($captchaIngresado)) {
        error_log("Mensaje de registro: Este es un mensaje informativo.");

       
        if (verificarCredenciales($email, $password)) {
            
            $_SESSION["intentos"] = 0;
            
            header("Location: index.php");
            exit();
        } else {
            
            $intentos = isset($_SESSION["intentos"]) ? $_SESSION["intentos"] + 1 : 1;
            $_SESSION["intentos"] = $intentos;

            if ($intentos >= 3) {
                header("Location: bloqueado.php?email=" . urlencode($email));
                exit();
            } else {
              
            }
        }
    }
}


function obtenerInformacionUsuario($email) {
    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "deportuaa";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, nombre FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId, $userName);

    $userInfo = array();

    if ($stmt->fetch()) {
        $userInfo["id"] = $userId;
        $userInfo["nombre"] = $userName;
    }

    $stmt->close();
    $conn->close();

    return $userInfo;
}

function generarCaptcha() {
    $opcionesCaptcha = ["PNRHtR.png", "smwm.jpg", "ReCAptchA.jpeg", "qGphJD.jpg"];
    $imagenCaptcha = $opcionesCaptcha[array_rand($opcionesCaptcha)];
    $_SESSION['captcha'] = $imagenCaptcha;
}

function verificarCaptcha($captchaIngresado) {
    if (isset($_SESSION['captcha'])) {
        $nombreCaptcha = pathinfo($_SESSION['captcha'], PATHINFO_FILENAME);
        if ($captchaIngresado === $nombreCaptcha) {
            return true;
        }
    }

    return false;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar|Registrar</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
    <link rel="stylesheet" href="css/login.css">
    <style>
        .error-container {
            position: relative;
            text-align: center;
            margin-top: 20px;
        }

        .error-container p {
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="bienvenida"> Bienvenido/a a DEPORTUAA</div>
    <?php include 'nav.php'; ?>

    <div class="contenedor-padre">
        <video autoplay muted loop id="video-fondo">
            <source src="media/Login.mp4" type="video/mp4">
            Tu navegador no soporta el tag de video.
        </video>
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form method="post" action="#" onsubmit="return validarContraseñas()">
                    <h1>Crear Cuenta </h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>o usa tu email para registrarte</span>
                    <input type="text" name="nombre" placeholder="Nombre"  required />
                    <input type="text" name="cuenta" placeholder="Cuenta"  required />
                    <input type="email" name="email" placeholder="Email"  required />
                    <input type="text" name="seguridad" placeholder="Pregunta de Seguridad: Deporte Favorito" required />
                    <input type="password" name="password" id="password" placeholder="Contraseña" required />
                    <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Repetir Contraseña" required />
                    <div class="error-container">
                        <p id="error-message" style="color: red;"></p>
                    </div>
                    <button type="submit" name="registro">Registrar</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="#" method="post" class="sign-in-form">
                    <h1>Inicia Sesión</h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>o usa tu cuenta</span>
                    <input type="email" name="email" placeholder="Email" />
                    <input type="password" name="password" placeholder="Contraseña" />
                    <a href="#">Olvidaste tu contraseña?</a>
                    <div class="error-container">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["registro"])) {
                            echo "<p>Registro exitoso. Ahora puedes iniciar sesión.</p>";
                        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["intentos"])) {
                            echo "<p>Credenciales incorrectas. Intentos restantes: " . (3 - $_SESSION["intentos"]) . "</p>";
                        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && !verificarCaptcha($_POST["captcha"])) {
                            echo "<p id='captcha-error-message' style='color: red;'>Error en el captcha. Por favor, inténtalo de nuevo.</p>";
                        }
                        ?>
                    </div>
                    <input type="text" name="captcha" id="captcha" placeholder="Ingresa el CAPTCHA" required />
                    <img src="img/<?php echo $_SESSION['captcha']; ?>" alt="Captcha" />
                    <span>Código: <?php echo pathinfo($_SESSION['captcha'], PATHINFO_FILENAME); ?></span>
                    <button type="submit">Iniciar Sesión</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Bienvenido de nuevo!</h1>
                        <p>Para mantenerse conectado con nosotros, regístrese con su información personal</p>
                        <button class="ghost" id="signIn">Iniciar Sesión </button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hola, Amigo!</h1>
                        <p>Introduce tus datos personales y comienza tu viaje con nosotros.</p>
                        <button class="ghost" id="signUp">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/login.js"></script>
    <script>
        function validarContraseñas() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                document.getElementById("error-message").innerHTML = "Las contraseñas no coinciden";
                return false;
            }

            return true;
        }
    </script>
    <?php
    include 'footer.php';
    ?>
   <div class="loader-wrapper">
    <div class="loader"></div>
    <p>Cargando...</p>
  </div>
</body>

</html>