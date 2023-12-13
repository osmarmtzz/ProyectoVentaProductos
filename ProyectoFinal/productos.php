<?php
session_start();
$servidor = 'localhost';
$cuenta = 'root';
$password = '';
$bd = 'deportuaa';

$conexion = new mysqli($servidor, $cuenta, $password, $bd);
$iter = 0;

if ($conexion->connect_errno) {
    die('Error en la conexión');
}

$sql_categorias = 'SELECT DISTINCT categoria FROM productos';
$resultado_categorias = $conexion->query($sql_categorias);

$categoria_seleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : '';

$sql = "SELECT * FROM productos";
if (!empty($categoria_seleccionada)) {
    $sql .= " WHERE categoria = '$categoria_seleccionada'";
}

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="shortcut icon" href="img/Favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/productos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        img.producto-imagen {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }

        img.producto-imagen:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="pt1">
        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="categoria">Seleccionar Categoría:</label>
            <select name="categoria" id="categoria">
                <option value="" <?php echo empty($categoria_seleccionada) ? 'selected' : ''; ?>>Todas las Categorías</option>
                <?php
                while ($row_categoria = $resultado_categorias->fetch_assoc()) {
                    $categoria_actual = $row_categoria['categoria'];
                    echo "<option value=\"$categoria_actual\" " . ($categoria_actual == $categoria_seleccionada ? 'selected' : '') . ">$categoria_actual</option>";
                }
                ?>
            </select>
            <button type="submit">Filtrar</button>
        </form>
    </div>

    <div class="loader-wrapper">
        <div class="loader"></div>
        <p>Cargando...</p>
    </div>

    <?php
    if ($resultado->num_rows) {
        echo '<div style="margin-left: 20px;">';
        echo '<table class="table" style="width:50%;">';

        while ($fila = $resultado->fetch_assoc()) {
            echo '<td>';
            echo '<table class="produ">';
            echo '<tr>' . $fila['idp'] . '<br></tr>';
            echo '<tr>' . $fila['nomp'] . '<br></tr>';
            echo '<tr><img src="productos/' . htmlspecialchars(basename($fila['imagen'])) . '" height="150px" width="150px"><br></tr>';
            echo '<tr> $' . $fila['precio'] . '<br></tr>';

            if (isset($_SESSION["user_cuenta"])) {
                echo '<a href="carrito.php?id=' . $fila['idp'] . '&nombre=' . $fila['nomp'] . '&precio=' . $fila['precio'] . '" class="link-nav"><img src="img/carrito.png" height="50px" width="50px"></a>';
            } else {
                echo '<button onclick="mostrarAlerta()"><img src="img/carrito.png" height="50px" width="50px"></button>';
            }

            $iter = $iter + 1;
            echo '</table>';
            echo '</td>';
        }
        echo '</table">';
        echo '</div>';
    } else {
        echo "No hay datos";
    }
    ?>

    <script>
        function mostrarAlerta() {
            alert("Debes iniciar sesión antes de agregar productos al carrito.");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
