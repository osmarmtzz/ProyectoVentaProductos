<?php
ob_start();
session_start();
$servidor = 'localhost';
$cuenta = 'root';
$password = '';
$bd = 'deportuaa';

// conexión a la base de datos
$conexion = new mysqli($servidor, $cuenta, $password, $bd);
$iter = 0;
$iter2 = 0;

if ($conexion->connect_errno) {
    die('Error en la conexión');
}

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="shortcut icon" href="img/Favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/productos.css">
    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php include 'nav.php'; ?>
<div class="pt1">
    <div class="texto">
    <a href="subirproductos.php" class="link-nav <?php echo basename($_SERVER['PHP_SELF']) == 'subirproductos.php' ? 'active' : ''; ?>">Subir Productos</a>
    <a href="editarproductos.php" class="link-nav <?php echo basename($_SERVER['PHP_SELF']) == 'editarproductos.php' ? 'active' : ''; ?>">Editar Productos</a>
    <a href="cupones.php" class="link-nav <?php echo basename($_SERVER['PHP_SELF']) == 'cupones.php' ? 'active' : ''; ?>">Generar codigos</a>
    </div>
    
</div>
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

    body {
        background-image: url(img/fondo.jpg);
    }

    .container {
        background-color: black; /* Fondo negro para el contenedor principal */
        color: black; /* Texto en color blanco */
        border: 5px solid gold; /* Borde dorado */
        padding: 20px; /* Espaciado interno para el contenido */
    }

    .product-card {
        /* Estilos para cada tarjeta de producto */
        margin: 10px;
        padding: 10px;
        background-color: white; /* Fondo negro para las tarjetas de producto */
        color: black; /* Texto en color blanco */
        border: 2px solid gold; /* Borde dorado */
    }

    .product-card p {
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; /* Cambia la fuente del texto dentro de las tarjetas */
    }

    .filters {
        /* Estilos para la sección de filtros */
        background-color: black; /* Fondo negro para la sección de filtros */
        color: white; /* Texto en color blanco */
        border: 2px solid gold; /* Borde dorado */
        padding: 10px; /* Espaciado interno para los elementos dentro de la sección de filtros */
        margin-bottom: 20px; /* Agrega espacio en la parte inferior */
    }
    label {
            color: gold;
            margin-right: 10px;
        }

        input[type="number"] {
            background-color: black;
            color: gold;
            border: 1px solid gold;
            padding: 8px;
            border-radius: 5px;
            margin-right: 10px;
        }

        button {
            background-color: gold;
            color: black;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: darkgoldenrod;
        }

    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="container">
        <div class="filters">
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
                <label for="precio_min">Precio Mínimo:</label>
                <input type="number" name="precio_min" id="precio_min" value="<?php echo isset($_GET['precio_min']) ? $_GET['precio_min'] : ''; ?>" placeholder="Precio mínimo">
                <label for="precio_max">Precio Máximo:</label>
                <input type="number" name="precio_max" id="precio_max" value="<?php echo isset($_GET['precio_max']) ? $_GET['precio_max'] : ''; ?>" placeholder="Precio máximo">
                <button type="submit">Filtrar</button>
            </form>
        </div>

        <div class="loader-wrapper">
            <div class="loader"></div>
            <p>Cargando...</p>
        </div>

        <div class="product-container">
            <?php
            if ($resultado->num_rows) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<div class="product-card">';
                    echo '<p>' . $fila['idp'] . '<br></p>';
                    echo '<p>' . $fila['nomp'] . '<br></p>';
                    echo '<img src="productos/' . htmlspecialchars(basename($fila['imagen'])) . '" height="150px" width="150px"><br>';

                    if (isset($_SESSION["user_cuenta"])) {
                        echo '<a href="carrito.php?id=' . $fila['idp'] . '&nombre=' . $fila['nomp'] . '&precio=' . $fila['precio'] . '" class="link-nav"><img src="img/carrito.png" height="50px" width="50px"></a>';
                    } else {
                        echo '<button onclick="mostrarAlerta()"><img src="img/carrito.png" height="50px" width="50px"></button>';
                    }

                    if ($fila['descuento'] > 0) {
                        $precioOriginal = $fila['precio'];
                        $descuento = $fila['descuento'];
                        $precioConDescuento = $precioOriginal - ($precioOriginal * ($descuento / 100));
                        echo '<p><del>$' . $precioOriginal . '</del> $' . $precioConDescuento . '<br></p>';
                    } else {
                        echo '<p>$' . $fila['precio'] . '<br></p>';
                    }

                    echo '</div>';
                }
            } else {
                echo "No hay datos";
            }
            ?>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>

    <script>
        function mostrarAlerta() {
            alert("Debes iniciar sesión antes de agregar productos al carrito.");
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
ob_end_flush();
?>