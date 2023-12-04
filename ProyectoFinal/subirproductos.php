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
     //conexion exitosa

     /*revisar si traemos datos a insertar en la bd  dependiendo
     de que el boton de enviar del formulario se le dio clic*/

     if(isset($_POST['submit'])&& !empty($_POST['id'])){
            //obtenemos datos del formulario
            $idp = $_POST['idp'];
            $nomp =$_POST['nomp'];
            $descripcion =$_POST['descripcion'];
            $existencia =$_POST['existencia'];
            $conexion =$_POST['conexion'];
            $precio =$_POST['precio'];
            $imagen =$_POST['imagen'];
            $categoria =$_POST['categoria'];
            $descuento =$_POST['descuento'];
            $desc2 =$_POST['desc2'];

            
            //hacemos cadena con la sentencia mysql para insertar datos
            $sql = "INSERT INTO productos (idp, nomp, descripcion, existencia, precio, imagen, categoria, descuento, desc2) VALUES('$idp','$nomp','$descripcion','$existencia',
            '$precio','$imagen','$categoria','$descuento','$desc2')";
            $conexion->query($sql);  //aplicamos sentencia que inserta datos en la tabla usuarios de la base de datos
            if ($conexion->affected_rows >= 1){ //revisamos que se inserto un registro
                echo '<script> alert("Producto Registrado") </script>';
            }//fin
         
          //continaumos con la consulta de datos a la tabla usuarios
     //vemos datos en un tabla de html
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
                    echo '<td>'. $fila['precio'] . '</td>';
                    echo '<td>'. $fila['imagen'] . '</td>';
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
<div class="container">
        <div class="row">
            <div class="col-4">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>
                    <h2>Registro de Usuarios</h2>
                    <div class="form-group">
                        <label for="idp">ID</label>
                        <input type="text" name="idp" class="form-control" id="idp" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="nomp">Nombre</label>
                        <input type="text" class="form-control" name="nomp" id="nomp" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="textarea" id="descripcion" name="descripcion" class="form-control" placeholder=" ">
                    </div>
                    <div class="form-group">
                        <label for="existencia">Existencia</label>
                        <input name="existencia" type="number" class="form-control" id="existencia" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input name="precio" type="number" class="form-control" id="precio" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input name="imagen" type="file" class="form-control" id="imagen">
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select name="categoria" id="categoria">
                            <option value="balon">Balón</option>
                            <option value="calzado">Calzado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descuento">Descuento</label>
                        <input name="descuento" type="radio" class="form-control" value="descuento">Sí
                        <input name="descuento" type="radio" class="form-control" value="descuento">No
                    </div>
                    <div class="form-group">
                        <label for="desc2">Descuento</label>
                        <input name="desc2" type="number" class="form-control" id="desc2" placeholder="">
                    </div>
                    <button class="btn btn-success" type="submit" name="submit">Subir</button>
                </form>
            </div> <!-- fin col -->
        </div> <!-- fin row -->
    </div> <!-- fin container -->
    <br><br>
    <?php
    include 'footer.php';
    ?>

</body>
</html>
