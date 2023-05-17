<?php
require "../config.php";
include_once('../fpdf/fpdf.php');

$sql = "SELECT id, car, grand_total, customer, email, phone, shipping_address, payment_method, ";
$sql .= "DATE_FORMAT(date_created,'%d-%b-%Y') as date ";
$sql .= "FROM orders ";

$result = mysqli_query($conn, $sql);

$pdf = new FPDF();

$pdf->AddPage();

$pdf->Image("../assets/images/1.png", 10, -1, 70, 40);
$pdf->SetFont('Arial', 'B', 13);

$pdf->Cell(90);

$pdf->Cell(80, 10, 'Orders List', 1, 0, 'C');

$pdf->Ln(20);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(6, 12, 'ID', 1);
$pdf->Cell(18, 12, 'Date', 1);
$pdf->Cell(35, 12, 'Customer', 1);
$pdf->Cell(18, 12, 'Phone', 1);
$pdf->Cell(50, 12, 'Email', 1);
$pdf->Cell(50, 12, 'Shipping Address', 1);
$pdf->Cell(22, 12, 'Grand Total', 1);

$pdf->Ln();

$pdf->SetFont('Arial', '', 8);
foreach ($result as $row) {
    $pdf->Cell(6, 12, $row['id'], 1);
    $pdf->Cell(18, 12, $row['date'], 1);
    $pdf->Cell(35, 12, $row['customer'], 1);
    $pdf->Cell(18, 12, $row['phone'], 1);
    $pdf->Cell(50, 12, $row['email'], 1);
    $pdf->Cell(50, 12, $row['shipping_address'], 1);
    $pdf->Cell(22, 12, "R". number_format($row['grand_total'], 2, ',', ' '), 1);

    $pdf->Ln();
}

$pdf->Output();
?>