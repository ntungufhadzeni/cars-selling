<?php
session_start();
$name = '';
if(isset($_SESSION['customer_name'])){
    $name = $_SESSION['customer_name'];
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
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item ">
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
<div style="margin-bottom: 50px;"></div>
<div class="container" style="min-height:500px;">
    <div class=''>
    </div>
<div class="container">
    <?php
    include '../classes/car.php';
    $car = new Car();
    ?>
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <h3>Price</h3>
                <div class="list-group-item">
                    <input id="priceSlider" data-slider-id='ex1Slider' data-slider-min="20000" data-slider-max="2000000" data-slider-step="10000" data-slider-value="50000"/>
                    <div class="priceRange">20000 - 2000000</div>
                    <input type="hidden" id="minPrice" value="20000" />
                    <input type="hidden" id="maxPrice" value="2000000" />
                </div>
            </div>
            <div class="list-group">
                <h3>Make</h3>
                <?php
                $makes = $car->getMake();
                foreach($makes as $make){
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="productDetail make" name="make"
                                      value="<?php echo $make; ?>"  > <?php echo $make; ?></label>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!--<div class="list-group">
                <h3>Model</h3>
                <?php
                $models = $car->getModel();
                foreach($models as $model){
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="productDetail model" name="model"
                                      value="<?php echo $model; ?>"  > <?php echo $model; ?></label>
                    </div>
                    <?php
                }
                ?>
            </div>-->
            <div class="list-group">
                <h3>Year</h3>
                <?php
                $years = $car->getYear();
                foreach($years as $year){
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="productDetail year" name="year"
                                      value="<?php echo $year; ?>"  > <?php echo $year; ?></label>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>
        <div class="col-md-9">
            <div class="row searchResult">
            </div>
        </div>
    </div>
</div>
<?php include('../inc/footer.php');?>
