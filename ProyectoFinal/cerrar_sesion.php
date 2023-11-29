<?php
session_start();
session_destroy(); // Destruye todas las variables de sesión

// Redirige a la página de inicio o a donde desees después de cerrar sesión
header("Location: index.php");
exit();
?>
