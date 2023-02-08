<?php require_once __DIR__ . '/vendor/autoload.php'; ?>
<?php

use Fpdf\Fpdf;

$pdf = new Fpdf();

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 50);

$pdf->Cell(40, 10, 'Ahoj svete Ahoj');

$pdf->Output();

?>