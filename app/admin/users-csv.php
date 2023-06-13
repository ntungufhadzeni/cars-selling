<?php
require "../config.php";
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="customers.csv"');
$sql = "SELECT id, first_name, surname, phone, email, address, status FROM customer";
$result = mysqli_query($conn, $sql);

$fp = fopen('php://output', 'wb');
$header = array('ID', 'First Name', 'Surname', 'Phone', 'Email', 'Address', 'Status');
fputcsv($fp, $header, ';');

while ($row = mysqli_fetch_assoc($result)) {
    // Enclose phone value in double quotes
    $row['phone'] = "'" . $row['phone'] . "'";
    fputcsv($fp, $row, ';');
}

fclose($fp);
?>