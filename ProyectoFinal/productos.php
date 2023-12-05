<?php
session_start();
$servidor='localhost';
$cuenta='root';
$password='';
$bd='deportuaa';
 
//conexion a la base de datos
$conexion = new mysqli($servidor,$cuenta,$password,$bd);

if ($conexion->connect_errno){
     die('Error en la conexion');
}

else{
$sql = 'select * from productos';//hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
$resultado = $conexion -> query($sql); //aplicamos sentencia

if ($resultado -> num_rows){ //si la consulta genera registros
     echo '<div style="margin-left: 20px;">';
     echo '<table class="table table-hover" style="width:50%;">';
     
       echo '<tr>';
           echo '<th>id</th>';
           echo '<th>nombre</th>';
           echo '<th>descripcion</th>';
           echo '<th>existencia</th>';
           echo '<th>precio</th>';
           echo '<th>imagen</th>';
           echo '<th>categoria</th>';
           echo '<th>descuento</th>';
           echo '<th>desc2</th>';
       echo '</tr>';
       while( $fila = $resultado -> fetch_assoc()){ //recorremos los registros obtenidos de la tabla
           echo '<tr>';
               echo '<td>'. $fila['idp'] . '</td>';
               echo '<td>'. $fila['nomp'] . '</td>';
               echo '<td>'. $fila['descripcion'] . '</td>';
               echo '<td>'. $fila['existencia'] . '</td>';
               echo '<td>'. $fila['precio'] . '</td>';?>
               <td><img src="productos/<?php  echo htmlspecialchars(basename($fila['imagen'])) ;?>" height="150px" width="150px"></td>;
               <?php
               echo '<td>'. $fila['categoria'] . '</td>';
               echo '<td>'. $fila['descuento'] . '</td>';
               echo '<td>'. $fila['desc2'] . '</td>';
           echo '</tr>';
       }   
       echo '</table">';
    echo '</div>';
}
else{
    echo "no hay datos";
}

}//fin 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <!-- LINKS -->
    <link rel="shortcut icon" href="img/Favicon.png" type="image/x-icon">
    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php include 'nav.php'; ?>
<div class="pt1">
    <div class="texto">
    <a href="subirproductos.php" class="link-nav <?php echo basename($_SERVER['PHP_SELF']) == 'subirproductos.php' ? 'active' : ''; ?>">Subir Productos</a>
    <a href="editarproductos.php" class="link-nav <?php echo basename($_SERVER['PHP_SELF']) == 'editarproductos.php' ? 'active' : ''; ?>">Editar Productos</a>
    </div>
    
</div>
<?php
        include 'footer.php';
    ?>
    <div class="loader-wrapper">
    <div class="loader"></div>
    <p>Cargando...</p>
  </div>
</body>
</html>
<!-- SCRITPS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script></body>
</html>