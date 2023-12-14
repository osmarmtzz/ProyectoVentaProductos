<?php
// Simulación de contenido adicional obtenido de una base de datos o fuente de datos

// Código del reproductor de video (puedes ajustar la ruta del video según tu estructura de archivos)
$videoCode = "
    <div style='text-align: center; border: 1px solid #ccc; padding: 20px;'>
        <h2>Contenido Adicional</h2>
        <video width='70%' height='400' controls>
            <source src='media/video/video1.mp4' type='video/mp4'>
        </video>
    </div>
";

// Otra información adicional
$informacionAdicional = "
    <div class='producto'>
        <h3>Dato Interesante</h3>
        <p>Un dato interesante sobre el deporte es el efecto positivo que tiene la actividad física en el cerebro y la salud mental. La práctica regular de ejercicio ha demostrado tener beneficios significativos en la función cognitiva y el bienestar emocional..</p>
        
    </div>
    <div class='producto'>
        <h3>Consejos de Entrenamiento</h3>
        <p>Para un entrenamiento efectivo, establece metas claras y realistas...</p>
        <p>Toma mucha agua</p>
        
    </div>
";

// Devuelve el contenido adicional generado
echo $videoCode . $informacionAdicional;
?>
