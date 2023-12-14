<?php
session_start();

if (isset($_GET['id'])) {
    $idProductoEliminar = $_GET['id'];

    // Buscar y eliminar el producto del carrito
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $key => $producto) {
            if ($producto['id'] == $idProductoEliminar) {
                unset($_SESSION['carrito'][$key]);
                break;
            }
        }
    }
}

// Redirigir de vuelta a la página del carrito
header('Location: carrito.php');
exit();
?>
