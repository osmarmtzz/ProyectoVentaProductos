<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/cargando.css">
    <script src="js/cargando.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@700&display=swap" rel="stylesheet">
</head>

<body>
    
    <header>

        <nav>
            <a href="index.php" class="link-nav"><img src="img/Logo.png" alt="Descripción de la imagen"></a>
            <a href="index.php" class="link-nav <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">INICIO</a>
            <a href="nosotros.php" class="link-nav <?php echo basename($_SERVER['PHP_SELF']) == 'nosotros.php' ? 'active' : ''; ?>">ACERCA DE</a>
            <a href="productos.php" class="link-nav <?php echo basename($_SERVER['PHP_SELF']) == 'productos.php' ? 'active' : ''; ?>">PRODUCTOS</a>
            <a href="contacto.php" class="link-nav <?php echo basename($_SERVER['PHP_SELF']) == 'contacto.php' ? 'active' : ''; ?>">CONTACTO</a>
            <a href="ayuda.php" class="link-nav <?php echo basename($_SERVER['PHP_SELF']) == 'ayuda.php' ? 'active' : ''; ?>">AYUDA</a>

            <?php
            if (isset($_SESSION["user_cuenta"])) {
                echo '<a href="carrito.php" class="link-nav"><i class="fa-solid fa-cart-shopping fa-xl"></i></a>';
            }
            ?>
            <a href="<?php echo isset($_SESSION["user_cuenta"]) ? 'cerrar_sesion.php' : 'login.php'; ?>"
                class="link-nav">
                <?php echo isset($_SESSION["user_cuenta"]) ? 'Cerrar Sesión' : 'INICIAR SESIÓN'; ?>
            </a>

            <?php
            if (isset($_SESSION["user_cuenta"])) {
                $saludo = obtenerSaludo();
                echo '<span class="saludo">' . $saludo . ', ' . $_SESSION["user_cuenta"] . '</span>';
            }
            ?>
        </nav>

    </header>

    <script src="https://kit.fontawesome.com/c8e2afe6ad.js" crossorigin="anonymous"></script>

</body>

</html>

<?php
function obtenerSaludo() {
    date_default_timezone_set('America/Mexico_City');
    $hora = date('G');

    if ($hora >= 5 && $hora < 12) {
        return "Buenos días";
    } elseif ($hora >= 12 && $hora < 18) {
        return "Buenas tardes";
    } else {
        return "Buenas noches";
    }
}
?>
