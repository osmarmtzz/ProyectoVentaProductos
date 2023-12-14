<?php
session_start();

if(isset($_GET['pais'])){
    $ps = $_GET['pais'];
}

if (isset($_GET['id']) && isset($_GET['nombre']) && isset($_GET['precio'])) {
    $idProducto = $_GET['id'];
    $nombreProducto = $_GET['nombre'];
    $precioProducto = $_GET['precio'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    $conexion = mysqli_connect('localhost', 'root', '', 'deportuaa');
    if (!$conexion) {
        die('Error de conexión: ' . mysqli_connect_error());
    }

    $sql = "SELECT existencia FROM productos WHERE idp = '$idProducto'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
        $existencia = $fila['existencia'];

        if ($existencia > 0) {
            $index = array_search($idProducto, array_column($_SESSION['carrito'], 'id'));

            if ($index !== false) {
                $nuevaCantidad = $_SESSION['carrito'][$index]['cantidad'] + 1;

                if ($nuevaCantidad > $existencia) {
                    $_SESSION['mensaje_alerta'] = "No hay suficientes existencias para el producto seleccionado.";
                } else {
                    $_SESSION['carrito'][$index]['cantidad'] = $nuevaCantidad;
                }
            } else {
                $producto = array(
                    'id' => $idProducto,
                    'nombre' => $nombreProducto,
                    'precio' => $precioProducto,
                    'cantidad' => 1
                );

                $_SESSION['carrito'][] = $producto;
            }
        } else {
            $_SESSION['mensaje_alerta'] = "No hay suficientes existencias para el producto seleccionado.";
        }
    } else {
        echo 'Error en la consulta: ' . mysqli_error($conexion);
    }

    mysqli_close($conexion);

    header("Location: carrito.php");
    exit();
}

function calcularPrecioTotal()
{
    $total = 0;

    foreach ($_SESSION['carrito'] as $producto) {
        $total += $producto['precio'] * $producto['cantidad'];
    }
    $ps = $_POST['pais'];
    $cp = $_POST['cupon'];
    if ($ps == "mexico") {
        $envio = 0;
        $impuesto = $subtotal * 0.01;
    } elseif ($ps == "eua") {
        $envio = 500;
        $impuesto = $subtotal * 0.029;
    } elseif ($ps == "canada") {
        $envio = 700;
        $impuesto = $subtotal * 0.05;
    } else {
        $envio = 0;
        $impuesto = $subtotal * 0;
    }
    $tot = $subtotal + $envio + $impuesto;
    if ($cp == "vqfgkm") {
        $tot2 = $tot * 0.3;
        $total = $tot * 0.7;
    } elseif ($cp == "gafgad") {
        $tot2 = $tot * 0.2;
        $total = $tot * 0.8;
    } elseif ($cp == "gjhsfgr") {
        $tot2 = $tot * 0.15;
        $total = $tot * 0.85;
    } else {
        $tot2 = $tot * 0;
        $total = $tot * 1;
    }

    $_SESSION['ticket'] = array(
        'subtotal' => $subtotal,
        'envio' => $envio,
        'impuesto' => $impuesto,
        'cupon' => $tot2,
        'total' => $total,
        'productos' => $_SESSION['carrito']
    );
    session_write_close();

    header("Location: mostrar_ticket.php");
    exit();

    return $total;
}

if (isset($_GET['eliminar']) && isset($_GET['id'])) {
    $idEliminar = $_GET['id'];
    $indexEliminar = array_search($idEliminar, array_column($_SESSION['carrito'], 'id'));

    if ($indexEliminar !== false) {
        $_SESSION['carrito'][$indexEliminar]['cantidad']--;

        if ($_SESSION['carrito'][$indexEliminar]['cantidad'] == 0) {
            unset($_SESSION['carrito'][$indexEliminar]);
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        }
    }
}

if (isset($_POST['realizar_pago'])) {
    $subtotal = 0;
    foreach ($_SESSION['carrito'] as $producto) {
        $subtotal += $producto['precio'] * $producto['cantidad'];
    }
    /*$ps = $_POST['pais'];
    $cp = $_POST['cupon'];
    if ($ps == "mexico") {
        $envio = 0;
        $impuesto = $subtotal * 0.01;
    } elseif ($ps == "eua") {
        $envio = 500;
        $impuesto = $subtotal * 0.029;
    } elseif ($ps == "canada") {
        $envio = 700;
        $impuesto = $subtotal * 0.05;
    } else {
        $envio = 0;
        $impuesto = $subtotal * 0;
    }
    $tot = $subtotal + $envio + $impuesto;
    if ($cp == "vqfgkm") {
        $tot2 = $tot * 0.3;
        $total = $tot * 0.7;
    } elseif ($cp == "gafgad") {
        $tot2 = $tot * 0.2;
        $total = $tot * 0.8;
    } elseif ($cp == "gjhsfgr") {
        $tot2 = $tot * 0.15;
        $total = $tot * 0.85;
    } else {
        $tot2 = $tot * 0;
        $total = $tot * 1;
    }

    $_SESSION['ticket'] = array(
        'subtotal' => $subtotal,
        'envio' => $envio,
        'impuesto' => $impuesto,
        'cupon' => $tot2,
        'total' => $total,
        'productos' => $_SESSION['carrito']
    );

    session_write_close();

    header("Location: mostrar_ticket.php");
    exit();*/
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="shortcut icon" href="img/Favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/carrito.css">
    <link rel="stylesheet" href="css/formularios.css">
    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Agregar un estilo CSS para la tabla -->
    <style>
        body {
            background-color: #f8f9fa;
            color: #495057;
        }

        .pt1 {
            padding-top: 20px;
        }

        .container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
            color: #007bff;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        form {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        input[type="submit"], .btn-secondary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover, .btn-secondary:hover {
            background-color: #0056b3;
        }

        .empty-cart {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #6c757d;
        }

        /* Estilos Bootstrap */
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div style="background-color: #333;">
        <div class="pt1">
            <div style="margin-top: 100px;">
                <div class="container texto">
                    <h1>Carrito de Compras</h1>
                    <?php
                    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                        echo '<table class="table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Nombre</th>';
                        echo '<th>Precio</th>';
                        echo '<th>Cantidad</th>';
                        echo '<th>Acciones</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        foreach ($_SESSION['carrito'] as $producto) {
                            echo '<tr>';
                            echo '<td>' . $producto['id'] . '</td>';
                            echo '<td>' . $producto['nombre'] . '</td>';
                            echo '<td>$' . $producto['precio'] . '</td>';
                            echo '<td>' . $producto['cantidad'] . '</td>';
                            echo '<td><a href="carrito.php?eliminar=1&id=' . $producto['id'] . '" class="btn btn-danger">Eliminar</a></td>';
                            echo '</tr>';
                        }?>
                        <tr>
                            <td colspan="5">
                                <label for="cupon">Cupón:</label>
                                <input type="text" id="cupon" name="cupon" class="form-control">
                                <button type="submit" class="btn btn-primary">Canjear</button>
                            </td>
                        </tr>
                        <?php
                        echo '</tbody>';
                        echo '</table>';

                        echo '<table class="table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Precio Total Sin Impuestos </th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        echo '<tr>';
                        echo '<td>$' . calcularPrecioTotal() . '</td>';
                        echo '</tr>';
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo '<p class="empty-cart">El carrito está vacío.</p>';
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['mensaje_alerta'])) {
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['mensaje_alerta'] . '</div>';
                        unset($_SESSION['mensaje_alerta']); // Clear the alert message to avoid displaying it on subsequent page loads
                    }
                    ?>
                    <form action="" method="post">
                        <button type="submit"  class="btn btn-primary"><a href="pagar1.php"  style="color: #dee2e6;     text-decoration: none;" class="link-nav">Elegir método de pago</a></button>
                        <input type="submit" name="realizar_pago" value="Realizar Pago" class="btn btn-primary">
                        <a href="productos.php" class="btn btn-secondary">Volver a la tienda</a>
                    </form>
                </div>
            </div>
        </div><br><br><br><br><br>
        <?php include 'footer.php'; ?>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
