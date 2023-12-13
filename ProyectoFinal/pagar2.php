<?php
session_start();

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $codigo_postal = $_POST['codigo_postal'];
    $pais = $_POST['pais'];
    $telefono = $_POST['telefono'];

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
    <link rel="stylesheet" href="css/formularios.css">
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
        body {
            background-color: black;
            color: gold;
            font-family: 'Arial', sans-serif;
        }

        .pt1 {
            margin: 50px;
        }

        h1, h2 {
            color: gold;
        }

        form {
            background-color: black;
            padding: 20px;
            border: 2px solid gold;
            border-radius: 10px;
            margin-top: 20px;
        }

        label {
            color: gold;
            margin-top: 10px;
        }

        input {
            background-color: black;
            color: gold;
            border: 1px solid gold;
            border-radius: 5px;
            padding: 8px;
            margin-bottom: 10px;
            width: 100%;
        }

        button {
            background-color: gold;
            color: black;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        button:hover {
            background-color: darkgoldenrod;
        }
        select#pais {
            background-color: black;
            color: gold;
            border: 1px solid gold;
            padding: 8px;
            border-radius: 5px;
        }

        select#pais option {
            background-color: black;
            color: gold;
        }

    </style>
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="pt1">
        <div class="texto">
        <h2>Ingresa los datos para realizar el envío</h2>
    <form action="carrito.php" method="post">
        <label for="nombre">Nombre completo:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="direccion">Dirección de envío:</label>
        <input type="text" id="direccion" name="direccion" required><br><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" required><br><br>

        <label for="codigo_postal">Código postal:</label>
        <input type="number" id="codigo_postal" name="codigo_postal" required><br><br>

        <label for="pais">País:</label>
        <select name="pais" id="pais">
            <option value="mexico">México</option>
            <option value="eua">Estados Unidos</option>
            <option value="canada">Canada</option>
        </select><br><br>
        <label for="telefono">Telefono:</label>
        <input type="number" id="telefono" name="telefono" required><br><br>

        <button type="submit"><a href="carrito.php" class="link-nav">Continuar</a></button>
    </form>
            
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