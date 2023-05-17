<?php
require "../config.php";
include_once('../fpdf/fpdf.php');

$sql = "SELECT id, first_name, surname, phone, email, address, status FROM customer";
$result = mysqli_query($conn, $sql);

$pdf = new FPDF();

$pdf->AddPage();

$pdf->Image("../assets/images/1.png", 10, -1, 70, 40);
$pdf->SetFont('Arial', 'B', 13);

$pdf->Cell(90);

$pdf->Cell(80, 10, 'Customer List', 1, 0, 'C');

$pdf->Ln(20);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(6, 12, 'ID', 1);
$pdf->Cell(25, 12, 'First Name', 1);
$pdf->Cell(25, 12, 'Last Name', 1);
$pdf->Cell(22, 12, 'Phone', 1);
$pdf->Cell(50, 12, 'Email', 1);
$pdf->Cell(55, 12, 'Address', 1);
$pdf->Cell(13, 12, 'Status', 1);


$pdf->Ln();

$pdf->SetFont('Arial', '', 8);
foreach ($result as $row) {
    $pdf->Cell(6, 12, $row['id'], 1);
    $pdf->Cell(25, 12, $row['first_name'], 1);
    $pdf->Cell(25, 12, $row['surname'], 1);
    $pdf->Cell(22, 12, $row['phone'], 1);
    $pdf->Cell(50, 12, $row['email'], 1);
    $pdf->Cell(55, 12, $row['address'], 1);
    $pdf->Cell(13, 12, $row['status'], 1);
    $pdf->Ln();
}

$pdf->Output();
?>