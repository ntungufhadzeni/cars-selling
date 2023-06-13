<?php
require "../config.php";
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="orders.csv"');
$sql = "SELECT id, car_id,shipping_name,shipping_email,shipping_phone,shipping_address,payment_method,";
$sql .= "DATE_FORMAT(date_created,'%d-%b-%Y') as date ";
$sql .= "FROM orders ";

$result = mysqli_query($conn, $sql);

$fp = fopen('php://output', 'wb');
$header = array('Order ID', 'Car ID', 'Name', 'Email', 'Phone', 'Address', 'Payment Method', 'Date', 'Car Name', 'Grand Total');
fputcsv($fp, $header, ';');

while ($row = mysqli_fetch_assoc($result)) {
    $row['shipping_phone'] = "'" . $row['shipping_phone'] . "'";
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
    $row['car'] = $car;
    $row['price'] = "R". number_format($grand_total, 2, ',', ' ');
    fputcsv($fp, $row, ';');
}

fclose($fp);
?>