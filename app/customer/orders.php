<?php
global $conn;
session_start();
include_once '../config.php';
$name = '';
if(isset($_SESSION['customer_name']) && isset($_SESSION['customer_id'])){
    $name = $_SESSION['customer_name'];
    $id = $_SESSION['customer_id'];

    $sql = "SELECT id, car, grand_total, customer, email, phone, shipping_address, payment_method, ";
    $sql .= "DATE_FORMAT(date_created,'%d-%b-%Y') as date, customer_id ";
    $sql .= "FROM orders ";
    $sql .= "WHERE customer_id = '".$id."'";

    $result =  mysqli_query($conn, $sql);

}
else{
    header('location: login_reg.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/s.css">
    <link rel="stylesheet" href="../assets/css/owl.css">

    <link rel="stylesheet" href="../assets/css/style_search.css">
    <script src="../assets/js/search.js"></script>
    <title>Online-cars</title>
</head>
<body>
<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php"><h2>Hi, <em><?php echo $name ?></em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="profile.php"> Profile
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="orders.php"> Orders
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                </ul>
            </div>
    </nav>
</header>
<div class="banner header-text">
    <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
            <div class="text-content">
                <h2 style="color:white;">Online-Cars</h2>
            </div>
        </div>
        <div class="banner-item-02">
            <div class="text-content">

            </div>
        </div>
        <div class="banner-item-03">
            <div class="text-content">
                <h4>Last Minute</h4>
                <h2>Grab last minute deals</h2>
            </div>
        </div>
    </div>
</div>
<div style="margin-bottom: 80px;"></div>
<div class="container" style="min-height:500px;">
    <h1>Orders</h1>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>
                Order Number
            </th>
            <th>
                Date
            </th>
            <th>
                Customer
            </th>
            <th>
                Car
            </th>
            <th>
                Grand Total
            </th>
            <th>
                Shipping Address
            </th>
            <th>
                Phone
            </th>
            <th>
                Email
            </th>
            <th>
                Payment Method
            </th>
        </tr>
        </thead>
        <?php
        $status_colors = array(1 => '#00ff00', 0 => '#ff0000');
        while($row = mysqli_fetch_assoc($result)){
            $order_number = $row['id'];
            $date = $row['date'];
            $customer = $row['customer'];
            $car = $row['car'];
            $address = $row['shipping_address'];
            $price = $row['grand_total'];
            $payment_method = $row['payment_method'];
            $phone = $row['phone'];
            $email = $row['email'];

            ?>
            <tr>
                <td>
                    <?php echo($order_number); ?>
                </td>
                <td>
                    <?php echo($date); ?>
                </td>
                <td>
                    <?php echo($customer); ?>
                </td>
                <td>
                    <?php echo($car); ?>
                </td>
                <td>
                    R <?php echo(number_format($price,2, ',', ' ')); ?>
                </td>
                <td>
                    <?php echo($address); ?>
                </td>
                <td >
                    <?php echo($phone); ?>
                </td>
                <td>
                    <?php echo($email); ?>
                </td>
                <td>
                    <?php echo($payment_method); ?>
                </td>
            </tr>
        <?php }?>
    </table>
</div>
<?php include('../inc/footer.php');?>
