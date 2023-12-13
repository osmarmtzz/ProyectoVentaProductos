<?php
session_start();

// Verificar si se recibieron parámetros en la URL
if (isset($_GET['id']) && isset($_GET['nombre']) && isset($_GET['precio'])) {
    $idProducto = $_GET['id'];
    $nombreProducto = $_GET['nombre'];
    $precioProducto = $_GET['precio'];

    // Inicializar el carrito si aún no existe en la sesión
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    // Agregar el producto al carrito
    $producto = array(
        'id' => $idProducto,
        'nombre' => $nombreProducto,
        'precio' => $precioProducto
    );

    $_SESSION['carrito'][] = $producto;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <!-- LINKS -->
    <link rel="shortcut icon" href="img/Favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/index.css">
    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Agregar un estilo CSS para la tabla -->
    <style>
        table {
            width: 50%;
            margin: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="pt1">
        <div class="texto">
            <h1>Compra</h1>
            <?php
            // Mostrar el contenido del carrito
            if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $producto) {
                    echo '<tr>';
                    echo '<td>' . $producto['id'] . '</td><br>';
                    echo '<td>' . $producto['nombre'] . '</td><br>';
                    echo '<td>$' . $producto['precio'] . '</td><br>';
                }
                echo '</table>';
                echo '<button type="submit"><a href="pagar1.php?id='. $fila['idp'] .'&nombre='. $fila['nomp'] .'&precio='. $fila['precio'] .'" class="link-nav">Pagar</a></button>';
            } else {
                echo '<p>El carrito está vacío.</p>';
            }
            ?>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
<!-- SCRITPS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>