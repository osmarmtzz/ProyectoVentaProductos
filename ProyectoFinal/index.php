<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEPORTUAA</title>
    <!-- LINKS -->
    <link rel="shortcut icon" href="img/Favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
        background-image: url(img/fondo.jpg);
        }
        .producto {
            text-align: center; /* Centra el contenido horizontalmente */
            padding: 20px; /* Añade espacio alrededor del contenido */
        }

        .ver {
            display: inline-block;
            padding: 15px 30px; /* Aumenta el espaciado interno */
            margin-top: 100%; /* Mueve el botón hacia abajo */
            background-color: orange;
            color: #fff;
            text-decoration: none;
            border-radius: 8px; /* Ajusta las esquinas redondeadas */
            font-size: 18px; /* Aumenta el tamaño del texto */
            border-color: black;
        }
        #cargarProductos {
        background-color: orange;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: block;
        margin: 20px auto;
    }

    </style>

    
</head>

<body>
    <div class="bienvenida">Bienvenido/a a DEPORTUAA</div>
    <?php include 'nav.php'; ?>
  

    <div class="pt1">
        <div class="texto">
            <h2>¿Qué es DEPORTUAA?</h2>
            <p>Es un proyecto que busca ser una herramienta para la gestión de los deportes en el colegio.</p>
            <h2>¿Por qué crear este sitio web?</h3>
            <p>La idea surgió por la falta de una plataforma donde se puedan realizar las actividades y eventos.</p>
        </div>
    </div>

 <!-- Carrusel -->
 <div id="carouselExampleCaptions" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/dep1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>DEPORTUAA</h5>
        <p>"La excelencia no es un acto, sino un hábito. Haz del entrenamiento parte de tu rutina diaria."</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/dep2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>DEPORTUAA</h5>
        <p>"La disciplina es el puente entre tus metas y tus logros. ¡Mantén el enfoque y sigue adelante!"</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/dep3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>DEPORTUAA</h5>
        <p>La diferencia entre lo imposible y lo posible reside en tu determinación. ¡Entrena sin límites!".</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!--NUESTRO PRODUCTOS -->
    <div class="pt2">
        <div class="texto">
            <h2>PRODUCTOS</h3>
            <p>Descubre nuestra amplia seleccion de productos deportivos de alta calidad,desde equipos para entrenamiento hasta accesorios esenciales, nuestra coleccion de productos tiene todo lo que necesitas para llevar tu rendimiento al siguiente nivel</p>
        </div>
    </div>

    <h2>Categorías</h2>
<div id="productosContainer" class="productos">
  
<div class="producto">
        <img src="img/fut.jpg" alt="Producto 1">
        <h3>Equipo de entrenamiento</h3>
        <p>Nuestro Kit de Entrenamiento te proporciona la versatilidad y la calidad que necesitas para alcanzar tus metas de acondicionamiento físico. </p>
        <a class="ver1" style= "color:orange"href="#" role="button">Ir a categoria</a>
    </div>

    <div class="producto">
        <img src="img/Uniforme_fut.jpg" alt="Producto 2">
        <h3>Calzado</h3>
        <p>Colección de Calzado Deportivo está diseñado para acompañarte en cada paso de tu viaje activo.</p>
        <a class="ver2" style= "color: orange"href="#" role="button">Ir a categoria</a>
        
    </div>

    <div class="producto">
        <img src="img/ashwaganda.jpg" alt="Producto 3">
        <h3>Suplementos deportivos</h3>
        <p> Descubre el poder de una nutrición inteligente diseñada para atletas comprometidos como tú.</p>
        <a class="ver3" style= color:orange heref="#" role="button">Ir a categoria</a>
    </div>

    <div class="producto">
    <a class="ver" href="productos.php" role="button">Ver más...</a>
    </div>
</div>

<button id="cargarProductos" style="margin-top: 20px;">Contenido adicional</button> <!--bton ajax!-->


<div class="card text-center">
  <div class="card-body" style=background-color:black>
    <h5 class="card-title" style = color:orange>REGISTRATE</h5>
    <p class="card-text" style= color:white>Se el primero en enterarte de nuevas colecciones y ofertas exclusivas.</p>
    <a href="login.php" class="btn btn-primary" style="background-color:gray; border-color:orangered">Correo electrónico</a>
  </div>
</div>



  <?php include 'footer.php'; ?>
  <div class="loader-wrapper">
    <div class="loader"></div>
    <p>Cargando...</p>
  </div>
</body>
</html>

<!-- SCRITPS -->
<script>
        $(document).ready(function() {
            // Asigna un evento al clic del botón
            $("#cargarProductos").click(function() {
                // Realiza una solicitud AJAX al servidor PHP
                $.ajax({
                    url: "obtener_productos.php", // Archivo PHP que manejará la solicitud
                    type: "GET", // Método HTTP (GET en este caso)
                    success: function(data) {
                        // Callback llamado si la solicitud es exitosa
                        $("#productosContainer").html(data); // Actualiza el contenido del contenedor con la respuesta del servidor
                    },
                    error: function() {
                        // Callback llamado si hay un error en la solicitud
                        alert("Error al cargar los productos");
                    }
                });
            });
        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
