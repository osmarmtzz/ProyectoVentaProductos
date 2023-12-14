<?php
session_start();
$servidor = 'localhost';
$cuenta = 'root';
$password = '';
$bd = 'deportuaa';

// Conexión a la base de datos
$conexion = new mysqli($servidor, $cuenta, $password, $bd);

if ($conexion->connect_errno) {
    die('Error en la conexión');
}

// Consulta SQL para obtener datos de productos
$query = "SELECT categoria, COUNT(*) as cantidad FROM productos GROUP BY categoria";
$result = $conexion->query($query);

// Almacenar los resultados en un array para usar en las gráficas
$productData = array();
while ($row = $result->fetch_assoc()) {
    $productData[] = array($row['categoria'], (int)$row['cantidad']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficas de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/d1f1082966.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/graficas.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            drawBarChart();
            drawPieChart();
        }

        function drawBarChart() {
            var data = google.visualization.arrayToDataTable([
                ['Categoría', 'Cantidad'],
                <?php
                    foreach ($productData as $product) {
                        echo "['" . $product[0] . "', " . $product[1] . "],";
                    }
                ?>
            ]);

            var options = {
                title: 'Cantidad de Productos por Categoría',
                legend: { position: 'none' },
                hAxis: { title: 'Categoría' },
                vAxis: { title: 'Cantidad' }
                
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('barChart'));
            chart.draw(data, options);
        }

        function drawPieChart() {
            var data = google.visualization.arrayToDataTable([
                ['Categoría', 'Cantidad'],
                <?php
                    foreach ($productData as $product) {
                        echo "['" . $product[0] . "', " . $product[1] . "],";
                    }
                ?>
            ]);

            var options = {
                title: 'Distribución de Productos por Categoría',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('pieChart'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <?php include 'nav.php'; ?>
    <div id="barChart" class="bar-chart-container"></div>

    <div class="card card-custom" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <h2 class="card-title">Por cantidad</h2>
        <p class="card-text">Esta gráfica representa la cantidad de productos por categoría y cantidad total</p>
        <div class="d-flex align-items-center">
            <i class="fas fa-futbol"></i>
            <span class="ms-2">Balón</span>
        </div>
        <div class="d-flex align-items-center mt-2">
            <i class="fas fa-socks"></i>
            <span class="ms-2">Calzado</span>
        </div>
    </div>
</div>


    <div id="pieChart" class="pie-chart-container"></div>
    <div class="card card-custom2" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <h2 class="card-title">Por porcentaje</h2>
        <p class="card-text">Esta gráfica representa la cantidad de productos por categoría y porcentaje total</p>
        <div class="d-flex align-items-center">
            <i class="fas fa-futbol"></i>
            <span class="ms-2">Balón</span>
        </div>
        <div class="d-flex align-items-center mt-2">
            <i class="fas fa-socks"></i>
            <span class="ms-2">Calzado</span>
        </div>
    </div>
</div>

    <?php include 'footer.php'; ?>
</body>
</html>