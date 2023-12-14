<?php
function obtenerUltimaModificacion() {
    $archivos = ['index.php','nosotros.php', 'productos.php','contacto.php','ayuda.php', 'login.php', 'bloqueado.php']; // Lista de archivos relevantes

    $ultima_modificacion = 0;

    foreach ($archivos as $archivo) {
        $ruta_archivo = __DIR__ . '/' . $archivo; // Ruta completa al archivo

        if (file_exists($ruta_archivo)) {
            $timestamp = filemtime($ruta_archivo);

            if ($timestamp > $ultima_modificacion) {
                $ultima_modificacion = $timestamp;
            }
        }
    }

    date_default_timezone_set('America/Mexico_City'); // Establecer la zona horaria a México

    return date("Y-m-d H:i:s", $ultima_modificacion); // Utilizar la hora del sistema en formato México con 24 horas
}
?>
