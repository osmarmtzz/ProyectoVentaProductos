<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <!-- LINKS -->
    <link rel="shortcut icon" href="img/Favicon.png" type="image/x-icon">
    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="bienvenida"> Bienvenido/a a DEPORTUAA</div>
<?php include 'nav.php'; ?>
<div class="pt1">
    <div class="texto">
    <a href="subirproductos.php" class="link-nav <?php echo basename($_SERVER['PHP_SELF']) == 'subirproductos.php' ? 'active' : ''; ?>">Subir Productos</a>
    </div>
    
</div>
<?php
        include 'footer.php';
    ?>
</body>
</html>
<!-- SCRITPS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script></body>
</html>