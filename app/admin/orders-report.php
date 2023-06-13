<?php
require "../config.php";
include_once('../fpdf/fpdf.php');

$sql = "SELECT id, car_id,shipping_name,shipping_email,shipping_phone,shipping_address,payment_method,";
$sql .= "DATE_FORMAT(date_created,'%d-%b-%Y') as date ";
$sql .= "FROM orders ";

$result = mysqli_query($conn, $sql);

$pdf = new FPDF(orientation:"L");

$pdf->AddPage();

$pdf->Image("../assets/images/1.png", 10, -1, 70, 40);
$pdf->SetFont('Arial', 'B', 13);

$pdf->Cell(90);

$pdf->Cell(80, 10, 'Orders List', 1, 0, 'C');

$pdf->Ln(20);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(11, 12, 'ID', 1);
$pdf->Cell(18, 12, 'Date', 1);
$pdf->Cell(35, 12, 'Customer', 1);
$pdf->Cell(45, 12, 'Car', 1);
$pdf->Cell(18, 12, 'Phone', 1);
$pdf->Cell(60, 12, 'Email', 1);
$pdf->Cell(60, 12, 'Shipping Address', 1);
$pdf->Cell(22, 12, 'Grand Total', 1);

$pdf->Ln();

$pdf->SetFont('Arial', '', 8);
foreach ($result as $row) {
    $car_id = $row['car_id'];
    $sqlCar = "SELECT CONCAT(maker, ' ', model) AS item, price, currency FROM car WHERE id='" . $car_id . "'";
    $resultCar = mysqli_query($conn, $sqlCar);
    $rowCar = mysqli_fetch_assoc($resultCar);
    $price = $rowCar['price'];
    $car = $rowCar['item'];

    if ($rowCar['currency'] != 'R') {
        $shipping = 'R10 000,00';
        $grand_total = 10000 + (int) $price * 18.09;
    } else {
        $shipping = 'R0,00';
        $grand_total = (int) $price;
    }
    $pdf->Cell(11, 12, $row['id'], 1);
    $pdf->Cell(18, 12, $row['date'], 1);
    $pdf->Cell(35, 12, $row['shipping_name'], 1);
    $pdf->Cell(45, 12, $car, 1);
    $pdf->Cell(18, 12, $row['shipping_phone'], 1);
    $pdf->Cell(60, 12, $row['shipping_email'], 1);
    $pdf->Cell(60, 12, $row['shipping_address'], 1);
    $pdf->Cell(22, 12, "R". number_format($grand_total, 2, ',', ' '), 1);

    $pdf->Ln();
}

$pdf->Output();
?>