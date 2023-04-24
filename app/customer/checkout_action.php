<?php
session_start();
global $conn;
require('../config.php');
if(isset($_POST['action']) == 'order') {
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$car = $_POST['products'];
$grand_total = (int) $_POST['grand_total'];
$address = $_POST['address'];
$pmode = $_POST['pmode'];
$customer_id = $_POST['customer_id'];

$data = '';

$sql = "INSERT INTO orders (car,customer,email,phone,shipping_address,payment_method,grand_total,customer_id)";
$sql .= " VALUES('$car','$name','$email','$phone','$address','$pmode','$grand_total', '$customer_id')";
mysqli_query($conn, $sql);

$data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="bg-danger text-light rounded p-2">Car Purchased : ' . $car . '</h4>
								<h4>Your name : ' . $name . '</h4>
								<h4>Your email : ' . $email . '</h4>
								<h4>Your phone : ' . $phone . '</h4>
								<h4>Total Amount paid : ' . number_format($grand_total,2, ',', ' ') . '</h4>
								<h4>Payment mode : ' . $pmode . '</h4>
						  </div>';
echo $data;
}

