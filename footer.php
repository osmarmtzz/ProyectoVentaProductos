<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Sitio Web</title>
    <style>
    


        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            text-align: center;
            bottom: 0;
            width: 100%;
        }

        .footer p {
            margin: 0;
        }

        .footer a {
            color: #adb5bd;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .social-icons {
            margin-top: 5px;
        }

        .social-icons a {
            margin: 0 8px;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }

        .social-icons a:hover {
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="footer">
        <p>&copy; 2023 Tu Sitio Web | <a href="#" target="_blank">Privacidad</a> | <a href="#" target="_blank">Términos</a></p>

        <div class="social-icons">
            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a>
        </div>
        <p>Esta página web fue creada con fines escolares y no posee ninguna funcionalidad. Se desaconseja cualquier intento de compra, ya que no se ofrece ningún producto o servicio en venta.</p>


        <?php
        include 'ultima_modificacion.php';
        $ultima_modificacion = obtenerUltimaModificacion();
        echo "Última modificación: $ultima_modificacion";
        ?>
    </div>

    <script src="https://kit.fontawesome.com/c8e2afe6ad.js" crossorigin="anonymous"></script>
</body>

</html>

