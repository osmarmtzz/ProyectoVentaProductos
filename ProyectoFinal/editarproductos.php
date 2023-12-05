<?php
session_start();
$servidor='localhost';
$cuenta='root';
$password='';
$bd='deportuaa';

$_SESSION['id'] = '';
$_SESSION['nom'] = '';
$_SESSION['descrip'] = '';
$_SESSION['existe'] = '';
$_SESSION['preci'] = '';
$_SESSION['image'] = '';
$_SESSION['catego'] = '';
$_SESSION['descuent'] = '';
$_SESSION['descuent2'] = '';
 
//conexion a la base de datos
$conexion = new mysqli($servidor,$cuenta,$password,$bd);

if ($conexion->connect_errno){
     die('Error en la conexion');
}

else{
     //conexion exitosa

     /*revisar si traemos datos a insertar en la bd  dependiendo
     de que el boton de enviar del formulario se le dio clic*/

     if(isset($_POST['submit'])){
        $modificar = $_POST['modificar'];
        $_SESSION['modificar2'] = $modificar;
        $sql2 = "SELECT * FROM usuarios WHERE id='$modificar'";
        $resultado = $conexion -> query($sql2);
        while($fila = $resultado -> fetch_assoc()){
            $_SESSION['id'] = $fila['id'];
            $_SESSION['nom'] = $fila['nombre'];
            $_SESSION['descrip'] = $fila['descri'];
            $_SESSION['existen'] = $fila['existen'];
            $_SESSION['preci'] = $fila['prec'];
            $_SESSION['image'] = $fila['imag'];
            $_SESSION['catego'] = $fila['categ'];
            $_SESSION['descuent'] = $fila['descuen'];
            $_SESSION['descuent2'] = $fila['descuen2'];
        }
        if(isset($_POST['mod'])){
            $mod1 = $_POST['idp2'];
            $mod2 = $_POST['nomp2'];
            $mod3 = $_POST['descripcion2'];
            $mod4 = $_POST['existencia2'];
            $mod5 = $_POST['precio2'];
            $mod6 = $_POST['imagen2'];
            $mod7 = $_POST['categoria2'];
            $mod8 = $_POST['descuento2'];
            $mod9 = $_POST['desc22'];
            $modificar = $_SESSION['modificar2'];
    
            $ne = "UPDATE productos SET idp='$mod1', nomp='$mod2', descripcion='$mod3', existencia='$mod4', precio='$mod5', 
            imagen='$mod6', categoria='$mod7', descuento='$mod8', desc2='$mod9' WHERE id='$modificar'";
            $fin = $conexion -> query($ne);
        }
     
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
         //continuamos con la consulta de datos a la tabla usuarios
         //vemos datos en un tabla de html
         $sql = 'select * from productos';//hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
         $resultado = $conexion -> query($sql); //aplicamos sentencia
         
         if ($resultado -> num_rows){ //si la consulta genera registros
         ?>
 
                
          <div class="izqAlta">      
           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>  
            
           <legend>Modificar Producto</legend>
                <br>
                <select   class="custom-select" name='modificar' >
                
                <?php
                $salida='<table>';
                while( $fila = $resultado -> fetch_assoc() ){ //recorremos los registros obtenidos de la tabla
                    echo '<option value="'.$fila["idp"].'">'.$fila["nomp"].'</option>';
                    //proceso de concatenacion de datos
                    $salida.= '<tr>';
                    $salida.= '<td>'. $fila['idp'] . '</td>';
                    $salida.= '<td>'. $fila['nomp'] . '</td>';
                    $salida.= '<td>'. $fila['descripcion'] . '</td>';
                    $salida.= '<td>'. $fila['existencia'] . '</td>';
                    $salida.= '<td>'. $fila['precio'] . '</td>';
                    $salida.= '<td>'. $fila['imagen'] . '</td>';
                    $salida.= '<td>'. $fila['categoria'] . '</td>';
                    $salida.= '<td>'. $fila['descuento'] . '</td>';
                    $salida.= '<td>'. $fila['desc2'] . '</td>';
                    $salida.= '</tr>';
                    }//fin while   
                    $salida.= '</table>';
                ?>
                </select>
                <br><br>
                <button type="submit" value="submit" name="submit">Modificar</button>               
            </form>
            </div> 
         <?php
        
         }
         else{
             echo "no hay datos";
         }
        
?>
        </div>
            <div class="izquierdaBaja">
                 <?php echo $salida ?>
            </div>
        </div>
        <div class="derecha">
        
            <form class="estiloformulario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post'>
            <ul class="wrapper">
                <li class="form-row">
                <label for="idp">ID</label>
                <input type="text" name="idp2" id="id" value="<?php echo $_SESSION["id"]; ?>" >
                </li>
                <li class="form-row">
                <label for="nomp">NOMBRE</label>
                <input type="text" id="nomp" name="nombre2" value="<?php echo $_SESSION["nom"]; ?>">
                </li>
                <li class="form-row">
                <label for="descripcion">DESCRIPCION</label>
                <input type="textarea" id="descripcion" name="descripcion2" value="<?php echo $_SESSION["descrip"]; ?>">
                </li>
                <li class="form-row">
                <label for="existencia">EXISTENCIA</label>
                <input type="number" id="existencia" name="existencia2" value="<?php echo $_SESSION['existe']; ?>">
                </li>
                <li class="form-row">
                <label for="precio">PRECIO</label>
                <input type="number" id="precio" name="precio2" value="<?php echo $_SESSION['preci']; ?>">
                </li>
                <li class="form-row">
                <label for="imagen">IMAGEN</label>
                <input type="file" id="imagen" name="imagen2" value="<?php echo $_SESSION['image']; ?>">
                </li>
                <li class="form-row">
                <label for="categoria">CATEGORIA</label>
                <select name="categoria" id="categoria">
                    <option value="<?php echo $_SESSION['catego']; ?>">Balón</option>
                    <option value="<?php echo $_SESSION['catego']; ?>">Calzado</option>
                </select>
                </li>
                <li class="form-row">
                <label for="descuento">DESCUENTO</label>
                <input type="text" id="descuento" name="descuento2" value="<?php echo $_SESSION['descuent']; ?>">
                </li>
                <li class="form-row">
                <label for="desc2">DESCUENTO</label>
                <input type="number" id="desc2" name="desc22" value="<?php echo $_SESSION['descuent2']; ?>">
                </li>
                <li class="form-row">
                <button type="submit" name="mod">Modificar</button>
                </li>
            </ul>
            </form>       
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>

</body>
</html>