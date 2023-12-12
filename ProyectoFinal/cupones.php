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
            <a href="carrito.php"  class="link-nav"><i class="fa-solid fa-cart-shopping fa-xl"></i></a>
            <a href="ayuda.php" class="link-nav <?php echo basename($_SERVER['PHP_SELF']) == 'ayuda.php' ? 'active' : ''; ?>">AYUDA</a>

            <a href="login.php" class="link-nav">INICIAR SESIÓN</a>

        </nav>
        
    </header>
    
    <script src="https://kit.fontawesome.com/c8e2afe6ad.js" crossorigin="anonymous"></script>

<h1>Generar Codigo</h1>
<div style="margin:100px;">
<form action="codigos.php" method="post" class="formulario">
<?php $codigo = randomtext(6);?>
    <p>
        Codigo: <input name="codigo" type="text" value="<?php echo $codigo ?>"><br>
    </p>
    <p>
        Descuento: <input name="descuen" type="number" value="" >
    </p>
    <p>
        <input class="boton" type="submit" value="Generar Codigo"></span>
    </p>
</form>
</div>
    
</body>
<?php
function randomtext($length){
    $key="";
    $pattern = "1234567890qwertyuiopasdfghjklzxcvbnm";
    for($i=0;$i<$length;$i++){
        $key .= $pattern[rand(0,35)];
    }
    return $key;
    }
    
    ?>
</html>



