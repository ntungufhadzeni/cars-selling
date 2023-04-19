<?php
session_start();
$name = '';
if(isset($_SESSION['admin_name'])){
    $name = $_SESSION['admin_name'];
    $id = $_SESSION['admin_id'];
}
else{
    header('location: login_reg.php');
}
?>
<?php
global $con;
include_once '../config.php';

$sql = "SELECT car.car_make as make, car.car_model as model, car.car_price as price, ";
$sql .= "customer.customer_address as address, company.company_name as company_name, ";
$sql .= "orders.payment_status as payment_status, orders.delivery_status as delivery_status, ";
$sql .= "DATE_FORMAT(orders.date_added,'%d-%b-%Y') as date, orders.id as order_number ";
$sql .= "FROM orders ";
$sql .= "JOIN car ON car.car_id = orders.car_id ";
$sql .= "JOIN customer ON customer.customer_id = orders.customer_id ";
$sql .= "JOIN company ON car.company_id = company.company_id ";

$result =  mysqli_query($con, $sql);

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
            <a class="navbar-brand" href="index.php"><h2><em><?php echo $name ?></em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="all_customers.php"> Customers
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="all_companies.php"> Companies
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="orders.php"> Orders
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="all_company_admin.php"> Company Admin
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
                <!-- <h4>Online-Cars</h4> -->
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
                Company
            </th>
            <th>
                Car Model
            </th>
            <th>
                Price
            </th>
            <th>
                Shipping Address
            </th>
            <th>
                Payment Status
            </th>
            <th>
                Delivery Status
            </th>
            <th>
                Action
            </th>
        </tr>
        </thead>
        <?php
        $status_colors = array(1 => '#00ff00', 0 => '#ff0000');
        while($row = mysqli_fetch_assoc($result)){
            $order_number = $row['order_number'];
            $date = $row['date'];
            $company = $row['company_name'];
            $c_model = $row['make']." ".$row['model'];
            $address = $row['address'];
            $price = $row['price'];
            $p_status = 'Not paid';
            $p_code = $row['payment_status'];
            $d_code = $row['delivery_status'];
            $d_status = 'Not delivered';
            if($p_code == 1){
                $p_status = "Paid";
            }
            if($d_code == 1){
                $d_status = 'Delivered';
            }

            ?>
            <tr>
                <td>
                    <?php echo($order_number); ?>
                </td>
                <td>
                    <?php echo($date); ?>
                </td>
                <td>
                    <?php echo($company); ?>
                </td>
                <td>
                    <?php echo($c_model); ?>
                </td>
                <td>
                    $<?php echo($price); ?>
                </td>
                <td>
                    $<?php echo($address); ?>
                </td>
                <td style="background-color: <?php echo $status_colors[$p_code]?>;">
                    $<?php echo($p_status); ?>
                </td>
                <td style="background-color: <?php echo $status_colors[$d_code]?>;" >
                    $<?php echo($d_status); ?>
                </td>
                <td>
                </td>
            </tr>
        <?php }?>
    </table>
</div>
<?php include('inc/footer.php');?>