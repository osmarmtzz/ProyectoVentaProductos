<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Sitio Web</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="footer">
    <p>&copy; 2023 Tu Sitio Web | <a href="#">Política de privacidad</a> | <a href="#">Términos de servicio</a></p>
    <?php
        include 'ultima_modificacion.php';
        $ultima_modificacion = obtenerUltimaModificacion();
        echo "Última modificación: $ultima_modificacion";
?>

</div>

</body>
</html>
