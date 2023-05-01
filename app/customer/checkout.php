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

if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
   if(preg_match("/^[A-Za-z0-9'’\-\s,.]{2,50}/", $address)){
        if(preg_match("/^0[1-9]\d{8}$/", $phone)){
            if(preg_match("/^[A-Za-z\s\-']{2,50}$/", $name)) {
                $sql = "INSERT INTO orders (car,customer,email,phone,shipping_address,payment_method,grand_total,customer_id)";
                $sql .= " VALUES('$car','$name','$email','$phone','$address','$pmode','$grand_total', '$customer_id')";
                mysqli_query($conn, $sql);

                if($pmode == "Bank Deposit"){
                    $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="text-success">Your car will be shipped as soon as receive the funds.</h4>
								<h4 class="bg-danger text-light rounded p-2">Car Purchased : ' . $car . '</h4>
								<h4>Your name : ' . $name . '</h4>
								<h4>Your email : ' . $email . '</h4>
								<h4>Your phone : ' . $phone . '</h4>
								<h4>Total Amount paid : ' . number_format($grand_total,2, ',', ' ') . '</h4>
								<h4>Payment mode : ' . $pmode . '</h4>
						  </div>';
                }
                else{
                    $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="text-success">Your car will be shipped to the address your provided.</h4>
								<h4 class="bg-danger text-light rounded p-2">Car Purchased : ' . $car . '</h4>
								<h4>Your name : ' . $name . '</h4>
								<h4>Your email : ' . $email . '</h4>
								<h4>Your phone : ' . $phone . '</h4>
								<h4>Total Amount paid : ' . number_format($grand_total,2, ',', ' ') . '</h4>
								<h4>Payment mode : ' . $pmode . '</h4>
						  </div>';
                }
            }
            else{
                $data .= '<h4 class="display-4 mt-2 text-danger">There was an issue placing order. Names are invalid</h4>';
            }
        }
        else{
            $data .= '<h4 class="display-4 mt-2 text-danger">There was an issue placing order. Phone is invalid</h4>';
        }
    }
   else{
       $data .= '<h4 class="display-4 mt-2 text-danger">There was an issue placing order. Address is invalid</h4>';
   }

}
else{
    $data .= '<h4 class="display-4 mt-2 text-danger">There was an issue placing order. Email is invalid</h4>';
}

echo $data;
}

