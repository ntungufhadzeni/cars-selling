<?php
global $con;
include_once '../config.php';
session_start();
$name = '';
$vid=$_GET['id'];
$sql="select c.car_make as make, c.car_model as model, c.car_price as price, c.car_color as color, c.car_image as image, ";
$sql .= "c.car_year as year, c.car_transmission as transmission, c.car_engine_capacity as engine_capacity,";
$sql .= "c.car_fuel as fuel, c.car_status as status, co.company_name as company_name, co.company_currency as currency  ";
$sql .= "from car c ";
$sql .= "join company co on co.company_id = c.company_id ";
$sql .= "where c.car_id=".$vid;
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$photo = $row['image'];
$seller = $row['company_name'];
$make = $row['make'];
$model = $row['model'];
$car_name = $make." ".$model;
$price = $row['currency'].''.$row['price'];
$color = $row['color'];
$year = $row['year'];
$transmission = $row['transmission'];
$engine_capacity = $row['engine_capacity'];
$status = $row['status'];
$fuel = $row['fuel'];
$stock_status = 'Available';
if($status != 1) {
    $stock_status = 'Sold Out';
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
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
    <link rel="stylesheet" href="../assets/css/style_search.css">
    <script src="../assets/js/search.js"></script>
    <title>Online-cars</title>
</head>
<body>
<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <h2>Online-<em>Cars</em></h2>
            </a>
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
                    <?php
                    if(isset($_SESSION['customer_name'])){
                    echo ('<li class="nav-item ">
                        <a class="nav-link" href="#"> Profile
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="orders.php"> Orders
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>');}
                    ?>
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
<div class="container" style="background-color:#CCF;">
    <h1 class="ptext " style="color:#333333;margin-top:90px; "><b>Details</b>
    </h1>
    <!-- Display image work-->
    <div>
        <div class="row">
            <div class=" col-md-2"> </div>
            <div class=" col-md-10">
                <img id="large-image" src='<?php echo('../assets/images/cars/'.$photo);?>' class="img-thumbnail" height="480" width="640" >
            </div>
        </div>

    </div>
    <!-- Display image work end-->
    <div class="row" style="margin-top:30px;">
        <div class=" col-xs-offset-1 col-md-11">

            <label id="car-name" for="car-name" > <?php echo($car_name);?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
    </div>
    <div  class="row" style="margin-bottom:20px;">
        <div  class="col-xs-offset-1 col-md-4 ">
            <hr>
            <label id="seller" for="seller" >Seller</label>
            <label class="pull-right" id="seller"><?php echo($seller);?></label>
            <hr>
            <label id="maker" for="maker" >Maker</label>
            <label class="pull-right" id="maker" ><?php echo($make);?></label>
            <hr>
            <label id="model" for="model" >Model</label>
            <label class="pull-right" id="model" ><?php echo($model);?></label>
            <hr>
            <label id="color" for="color" >Color</label>
            <label class="pull-right" id="color"><?php echo($color);?></label>
            <hr>
            <label id="stockstatus" for="stockstatus" >Stock Status</label>
            <label class="pull-right" id="stockstatus"><?php echo($stock_status);?></label>
            <hr>
        </div>
        <div class=" col-md-1 "> </div>
        <div  class="col-md-4">
            <hr>
            <label id="yearmonth" for="yearmonth" >Year/Month</label>
            <label class="pull-right" id="yearmonth" for="yearmonth" ><?php echo($year);?></label>
            <hr>
            <label id="transmission" for="transmission" >Transmission</label>
            <label class="pull-right" id="transmission" for="transmission" ><?php echo($transmission);?></label>
            <hr>
            <label id="enginecapacity" for="enginecapacity" >Engine Capacity</label>
            <label class="pull-right" id="enginecapacity" for="enginecapacity" ><?php echo($engine_capacity);?></label>
            <hr>
            <label id="fuel" for="fuel" >Fuel</label>
            <label class="pull-right" id="fuel" for="fuel" ><?php echo($fuel);?></label>
            <hr>
            <label id="price" for="price" >Price </label>
            <label class="pull-right" id="price" for="price" ><?php echo($price);?></label>
            <hr>
        </div>
    </div>
    <div class="row-md-5">
        <div class=" col-md-5"> </div>
        <div class="col-md-5">
            <div style="margin-bottom: 20px"><a href='#' class='btn btn-primary'>Checkout</a></div>
        </div>
    </div>
</div>
<?php include('../inc/footer.php');?>
