<?php
session_start();

$servidor = 'localhost';
$cuenta = 'root';
$password = '';
$bd = 'deportuaa';

$_SESSION['id'] = '';
$_SESSION['nom'] = '';
$_SESSION['descrip'] = '';
$_SESSION['existen'] = '';
$_SESSION['preci'] = '';
$_SESSION['image'] = '';
$_SESSION['catego'] = '';
$_SESSION['descuent'] = '';
$_SESSION['descuent2'] = '';

$conexion = new mysqli($servidor, $cuenta, $password, $bd);

if ($conexion->connect_errno) {
    die('Error en la conexion');
} else {
    if (isset($_POST['submit'])) {
        $modificar = $_POST['modificar'];
        $_SESSION['modificar2'] = $modificar;
        $sql2 = "SELECT * FROM productos WHERE idp='$modificar'";
        $resultado = $conexion->query($sql2);
        while ($fila = $resultado->fetch_assoc()) {
            $_SESSION['id'] = $fila['idp'];
            $_SESSION['nom'] = $fila['nomp'];
            $_SESSION['descrip'] = $fila['descripcion'];
            $_SESSION['existen'] = $fila['existencia'];
            $_SESSION['preci'] = $fila['precio'];
            $_SESSION['image'] = $fila['imagen'];
            $_SESSION['catego'] = $fila['categoria'];
            $_SESSION['descuent'] = $fila['descuento'];
            $_SESSION['descuent2'] = $fila['desc2'];
        }
    }

    if (isset($_POST['mod'])) {
        $mod1 = $_POST['idp2'];
        $mod2 = $_POST['nombre2'];
        $mod3 = $_POST['descripcion2'];
        $mod4 = $_POST['existencia2'];
        $mod5 = $_POST['precio2'];
        $mod7 = $_POST['categoria'];
        $mod8 = $_POST['descuento2'];
        $mod9 = $_POST['desc22'];
        $modificar = $_SESSION['modificar2'];

        // Lógica para manejar la actualización de la imagen del producto
        $imagenNueva = $_FILES['imagenNueva']['name'];
        $rutaImagen = 'ruta/donde/guardar/imagenes/' . $imagenNueva; // Establece la ruta de destino de la nueva imagen

        if (!empty($imagenNueva)) {
            move_uploaded_file($_FILES['imagenNueva']['tmp_name'], $rutaImagen);
        } else {
            $rutaImagen = $_SESSION['image']; // Conserva la imagen actual si no se selecciona una nueva
        }

        $ne = "UPDATE productos SET idp='$mod1', nomp='$mod2', descripcion='$mod3', existencia='$mod4', precio='$mod5', 
            imagen='$rutaImagen', categoria='$mod7', descuento='$mod8', desc2='$mod9' WHERE idp='$modificar'";
        $fin = $conexion->query($ne);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/nosotros.css">
    <?php include 'nav.php'; ?>
</head>
<body>
<div class="contenedor1">
    <div class="contenedor2">
        <div class="izquierdaAlta">
            <?php
            $sql = 'select * from productos';
            $resultado = $conexion->query($sql);
            if ($resultado->num_rows) {
            ?>
                <div class="izqAlta">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method='post'>
                        <legend>Modificar Producto</legend>
                        <br>
                        <select class="custom-select" name='modificar'>
                            <?php
                            $salida = '<table>';
                            while ($fila = $resultado->fetch_assoc()) {
                                echo '<option value="' . $fila["idp"] . '">' . $fila["nomp"] . '</option>';
                                $salida .= '<tr>';
                                $salida .= '<td>' . $fila['idp'] . '</td>';
                                $salida .= '<td>' . $fila['nomp'] . '</td>';
                                $salida .= '<td>' . $fila['descripcion'] . '</td>';
                                $salida .= '<td>' . $fila['existencia'] . '</td>';
                                $salida .= '<td>' . $fila['precio'] . '</td>';
                                $salida .= '<td>' . $fila['imagen'] . '</td>';
                                $salida .= '<td>' . $fila['categoria'] . '</td>';
                                $salida .= '<td>' . $fila['descuento'] . '</td>';
                                $salida .= '<td>' . $fila['desc2'] . '</td>';
                                $salida .= '</tr>';
                            }
                            $salida .= '</table>';
                            ?>
                        </select>
                        <br><br>
                        <button type="submit" value="submit" name="submit">Modificar</button>
                    </form>
                </div>
            <?php
            } else {
                echo "No hay datos";
            }
            ?>
        </div>
        <div class="izquierdaBaja">
            <?php echo $salida ?>
        </div>
    </div>
    <div class="derecha">
        <form class="estiloformulario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method='post' enctype="multipart/form-data">
            <ul class="wrapper">
                <li class="form-row">
                    <label for="idp2">ID</label>
                    <input type="text" name="idp2" id="idp2" value="<?php echo $_SESSION["id"]; ?>">
                </li>
                <li class="form-row">
                    <label for="nombre2">NOMBRE</label>
                    <input type="text" id="nombre2" name="nombre2" value="<?php echo $_SESSION["nom"]; ?>">
                </li>
                <li class="form-row">
                    <label for="descripcion2">DESCRIPCIÓN</label>
                    <input type="text" id="descripcion2" name="descripcion2" value="<?php echo $_SESSION["descrip"]; ?>">
                </li>
                <li class="form-row">
                    <label for="existencia2">EXISTENCIA</label>
                    <input type="text" id="existencia2" name="existencia2" value="<?php echo $_SESSION["existen"]; ?>">
                </li>
                <li class="form-row">
                    <label for="precio2">PRECIO</label>
                    <input type="text" id="precio2" name="precio2" value="<?php echo $_SESSION["preci"]; ?>">
                </li>
                <li class="form-row">
                    <label for="imagen2">IMAGEN</label>
                    <input type="file" id="imagen2" name="imagenNueva">
                </li>
                <li class="form-row">
                    <label for="categoria">CATEGORÍA</label>
                    <input type="text" id="categoria" name="categoria" value="<?php echo $_SESSION["catego"]; ?>">
                </li>
                <li class="form-row">
                    <label for="descuento2">DESCUENTO</label>
                    <input type="text" id="descuento2" name="descuento2" value="<?php echo $_SESSION["descuent"]; ?>">
                </li>
                <li class="form-row">
                    <label for="desc22">DESCUENTO 2</label>
                    <input type="text" id="desc22" name="desc22" value="<?php echo $_SESSION["descuent2"]; ?>">
                </li>
                <li class="form-row">
                    <button type="submit" name="mod">Modificar</button>
                </li>
            </ul>
        </form>
    </div>
</div>
</body>
</html>
