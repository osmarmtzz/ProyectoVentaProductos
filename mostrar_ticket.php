<?php
require('fpdf186/fpdf.php');
session_start();

class PDF extends FPDF
{
    // Función para crear el encabezado del PDF
// Función para crear el encabezado del PDF
    function Header()
    {
        $this->Image('img/Logo.png', 10, 10, 40); // Ajusta las coordenadas y el tamaño según tus necesidades
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(80);
        $this->SetFillColor(255, 255, 255); // Establecer el color de fondo del siguiente Cell
        $this->Cell(30, 10, 'Ticket de Pago', 0, 0, 'C', true); // Usar true para activar el fondo
        $this->Ln(20);
    }


    // Función para crear el pie de página del PDF
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Obtener y mostrar los detalles del ticket desde la sesión
if (isset($_SESSION['ticket'])) {
    $ticket = $_SESSION['ticket'];

    // Crear instancia de la clase PDF
    $pdf = new PDF();
    $pdf->AddPage();

    // Mostrar lista de productos en el ticket
    if (!empty($ticket['productos'])) {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(100, 10, 'Productos', 1, 0, 'L');
        $pdf->Cell(0, 10, 'Precio', 1, 1, 'R');

        foreach ($ticket['productos'] as $producto) {
            $pdf->Cell(100, 10, $producto['nombre'], 1, 0, 'L');
            $pdf->Cell(0, 10, '$' . number_format($producto['precio'], 2), 1, 1, 'R');
        }

        $pdf->Ln(10); // Espacio entre productos y totales
    }

    // Agregar detalles del ticket al PDF
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(100, 10, 'Subtotal:', 1, 0, 'L');
    $pdf->Cell(0, 10, '$' . number_format($ticket['subtotal'], 2), 1, 1, 'R');

    $pdf->Cell(100, 10, 'Envio:', 1, 0, 'L');
    $pdf->Cell(0, 10, '$' . number_format($ticket['envio'], 2), 1, 1, 'R');

    $pdf->Cell(100, 10, 'Impuesto:', 1, 0, 'L');
    $pdf->Cell(0, 10, '$' . number_format($ticket['impuesto'], 2), 1, 1, 'R');

    $pdf->Cell(100, 10, 'Descuento Cupón:', 1, 0, 'L');
    $pdf->Cell(0, 10, '$' . number_format($ticket['cupon'], 2), 1, 1, 'R');

    $pdf->Cell(100, 10, 'Total a Pagar:', 1, 0, 'L');
    $pdf->Cell(0, 10, '$' . number_format($ticket['total'], 2), 1, 1, 'R');

    // Agregar sección para el pago en OXXO (simulado)
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Pagar en OXXO', 0, 1, 'C');
    
    $pdf->Image('img/codigoBarras.png', 62, $pdf->GetY() + 8, 80); // Ajusta las coordenadas y el tamaño según tus necesidades
    
    // Generar número aleatorio de 12 dígitos (simulado) debajo del código de barras
    $codigoAleatorio = mt_rand(100000000000, 999999999999);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, $codigoAleatorio, 0, 1, 'C');

    // Generar el PDF
    $pdf->Output();
} else {
    echo '<p>No hay detalles de ticket disponibles.</p>';
}
?>