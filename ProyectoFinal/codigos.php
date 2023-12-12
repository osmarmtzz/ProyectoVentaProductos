<body>
    

<?php
 
require 'nav.php';

?>
<div style="margin:100px;">
<?php
     
 
    $codigo = $_POST["codigo"];
    $descuen = $_POST["descuen"];
     
    $file = fopen("codigos.txt","a+");
     
    fwrite($file, $codigo." ".$descuen."\r\n");
    
    fclose($file);
    echo "<br> Codigo generado <br>";   
     
    echo "<br><a href='cupones.php'>regresar</a>";

?>
</div>
</body>