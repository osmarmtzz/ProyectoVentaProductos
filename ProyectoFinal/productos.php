<?php
session_start();
$servidor = 'localhost';
$cuenta = 'root';
$password = '';
$bd = 'deportuaa';

// conexión a la base de datos
$conexion = new mysqli($servidor, $cuenta, $password, $bd);
$iter = 0;

if ($conexion->connect_errno) {
    die('Error en la conexión');
}

// Verificar si el usuario está logueado solo cuando hace clic en el enlace del carrito
if (isset($_GET['id'])) {
    // Si no está logueado, mostrar mensaje y redirigir a la página de login
    if (!isset($_SESSION['usuario'])) {
        echo "Debes iniciar sesión para agregar productos al carrito.";
        header('Location: login.php'); // Cambia 'login.php' al nombre de tu página de login
        exit();
    }

    // Usuario logueado, proceder con la lógica para agregar productos al carrito

    // Resto del código para agregar productos al carrito
    // Por ejemplo, podrías agregar el producto al carrito almacenado en la sesión
    $productoId = $_GET['id'];
    $productoNombre = $_GET['nombre'];
    $productoPrecio = $_GET['precio'];

    // Aquí podrías tener una estructura de datos que represente el carrito en la sesión
    // Puedes ajustar esto según tus necesidades
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    // Agregar el producto al carrito
    $_SESSION['carrito'][] = array(
        'id' => $productoId,
        'nombre' => $productoNombre,
        'precio' => $productoPrecio
    );

    // Puedes redirigir a otra página después de agregar el producto al carrito
    header('Location: carrito.php'); // Ajusta el nombre según la página de carrito
    exit();
}

// Obtener categorías disponibles (ajusta la consulta según tu estructura de base de datos)
$sql_categorias = 'SELECT DISTINCT categoria FROM productos';
$resultado_categorias = $conexion->query($sql_categorias);

$categoria_seleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$precio_min = isset($_GET['precio_min']) && is_numeric($_GET['precio_min']) ? $_GET['precio_min'] : null;
$precio_max = isset($_GET['precio_max']) && is_numeric($_GET['precio_max']) ? $_GET['precio_max'] : null;

// Construir la consulta SQL con los filtros
$sql = "SELECT * FROM productos";

if ($categoria_seleccionada !== '' && $categoria_seleccionada !== 'Todas las Categorías') {
    $sql .= " WHERE categoria = '$categoria_seleccionada'";
}

if ($precio_min !== null && $precio_max !== null) {
    $precio_min = (float) $precio_min;
    $precio_max = (float) $precio_max;
    $sql .= " AND precio BETWEEN $precio_min AND $precio_max";
} elseif ($precio_min !== null) {
    $precio_min = (float) $precio_min;
    $sql .= " AND precio >= $precio_min";
} elseif ($precio_max !== null) {
    $precio_max = (float) $precio_max;
    $sql .= " AND precio <= $precio_max";
}

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadatos y enlaces de estilo -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <!-- LINKS -->
    <link rel="shortcut icon" href="img/Favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/productos.css"> <!-- Enlaza directamente a productos.css -->
    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <style>
        img.producto-imagen {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }

        /* Efecto de sombra y cambio de opacidad al pasar el ratón sobre la imagen */
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
                <option value="" <?php echo empty($categoria_seleccionada) ? 'selected' : ''; ?>>Todas las Categorías
                </option>
                <?php
                while ($row_categoria = $resultado_categorias->fetch_assoc()) {
                    $categoria_actual = $row_categoria['categoria'];
                    echo "<option value=\"$categoria_actual\" " . ($categoria_actual == $categoria_seleccionada ? 'selected' : '') . ">$categoria_actual</option>";
                }
                ?>
            </select>
            <label for="precio_min">Precio Mínimo:</label>
            <input type="number" name="precio_min" id="precio_min"
                value="<?php echo isset($_GET['precio_min']) ? $_GET['precio_min'] : ''; ?>" placeholder="Precio mínimo">
            <label for="precio_max">Precio Máximo:</label>
            <input type="number" name="precio_max" id="precio_max"
                value="<?php echo isset($_GET['precio_max']) ? $_GET['precio_max'] : ''; ?>" placeholder="Precio máximo">
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

            // Verificar si hay un descuento aplicado
            if ($fila['descuento'] > 0) {
                $precioOriginal = $fila['precio'];
                $descuento = $fila['descuento'];
                $precioConDescuento = $precioOriginal - ($precioOriginal * ($descuento / 100));

                // Mostrar el precio con descuento y tachar el precio original
                echo '<tr><del>$' . $precioOriginal . '</del> $' . $precioConDescuento . '<br></tr>';
            } else {
                // Si no hay descuento, mostrar solo el precio original
                echo '<tr>$' . $fila['precio'] . '<br></tr>';
            }

            // Enlace al carrito
            echo '<a href="carrito.php?id=' . $fila['idp'] . '&nombre=' . $fila['nomp'] . '&precio=' . $fila['precio'] . '" class="link-nav"><img src="img/carrito.png" height="50px" width="50px"></a>';
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

    <!-- Scripts y enlaces de JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
