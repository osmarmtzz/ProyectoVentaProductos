<?php
session_start();
$servidor = 'localhost';
$cuenta = 'root';
$password = '';
$bd = 'deportuaa';

// conexión a la base de datos
$conexion = new mysqli($servidor, $cuenta, $password, $bd);

if ($conexion->connect_errno) {
    die('Error en la conexión');
} else {
    // Manejar la baja de productos
    if (isset($_POST["baja_producto"]) && isset($_POST["id_productos_baja"])) {
        $productos_baja = $_POST["id_productos_baja"];

        // Verificar si se seleccionaron productos
        if (count($productos_baja) > 0) {
            foreach ($productos_baja as $id_producto_baja) {
                // Realizar la consulta para obtener los datos del producto
                $sql = "SELECT * FROM productos WHERE idp = '$id_producto_baja'";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    // Mostrar los detalles del producto, incluida la imagen
                    $row = $result->fetch_assoc();
                    echo "<div class='mensaje-baja'>";
                    echo "<p>ID: " . $row["idp"] . "</p>";
                    echo "<p>Nombre: " . $row["nomp"] . "</p>";
                    echo "<p>Descripción: " . $row["descripcion"] . "</p>";
                    echo '<img src="' . $row["imagen"] . '" alt="Imagen del producto">';
                    // Confirmar la baja del producto
                    echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
                    echo "<input type='hidden' name='id_producto_confirmar' value='$id_producto_baja'>";
                    echo "<input type='submit' value='Confirmar Baja'>";
                    echo "</form>";
                    echo "</div>";
                } else {
                    echo "<div class='mensaje-error'>No se encontró el producto con el ID proporcionado: $id_producto_baja</div>";
                }
            }
        } else {
            echo "<div class='mensaje-error'>Debes seleccionar al menos un producto para dar de baja.</div>";
        }
    }

    // Manejar la confirmación de baja
    elseif (isset($_POST["id_producto_confirmar"])) {
        $id_producto = $_POST["id_producto_confirmar"];

        // Realizar la consulta para eliminar el producto
        $sql = "DELETE FROM productos WHERE idp = '$id_producto'";
        if ($conexion->query($sql) === TRUE) {
            echo "<div class='mensaje'>Producto dado de baja exitosamente.</div>";
        } else {
            echo "<div class='mensaje-error'>Error al dar de baja el producto: " . $conexion->error . "</div>";
        }
    }

    // Mostrar la lista de productos para dar de baja
    $sql = 'SELECT idp, nomp FROM productos';
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<h2>Lista de Productos para Dar de Baja</h2>";
        echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
        echo "<div class='checkbox-list'>";
        while ($row = $resultado->fetch_assoc()) {
            echo "<label><input type='checkbox' name='id_productos_baja[]' value='" . $row["idp"] . "'>" . $row["nomp"] . "</label><br>";
        }
        echo "</div>";
        echo "<button class='btn btn-danger' type='submit' name='baja_producto'>Dar de Baja</button>";
        echo "</form>";
    } else {
        echo "<div class='mensaje'>No hay productos disponibles para dar de baja.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dar de Baja Productos</title>
    <link rel="stylesheet" href="css/subir.css">
    <style>
        /* Estilos para mensajes de baja */
        .mensaje-baja {
            border: 1px solid #ffcc00; /* Dorado */
            padding: 10px;
            margin-bottom: 20px;
            background-color: #ffd700; /* Dorado */
            color: #333; /* Negro */
        }

        /* Estilos para mensajes de error */
        .mensaje-error {
            color: #d9534f; /* Rojo oscuro (para resaltar el error) */
            margin-bottom: 20px;
        }

        /* Estilos para mensajes generales */
        .mensaje {
            color: #ffd700; /* Dorado */
            margin-bottom: 20px;
        }
    </style>

    <?php include 'nav.php'; ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- Otras secciones del código, si las hay -->

            <!-- Sección para dar de baja productos -->
            <div class="col-12"> <!-- Cambiado a col-12 para ocupar toda la anchura -->
                <!-- No se requiere formulario aquí, ya está en PHP -->
            </div>
        </div>
    </div>
    <br><br>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
