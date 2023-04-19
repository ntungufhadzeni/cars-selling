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


$sql = "SELECT * FROM car";
$rs_result = mysqli_query($con,$sql);
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
    <link rel="stylesheet" href="../assets/css/stylesheet.css" />
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
<div  class="row">
    <div class="container-fluid" style=" margin-top:150px;">
        <div class="container">
            <div class="col-sm-10">
                <h1 class="text-center " style="color:#333333;  margin-top:-60px;"> Company Add Form </h1>
                <div class="well" style="border:solid ; border-color:rgb(3, 60, 115); margin-top:15px;">
                    <div class="form1">
    <form action="add_company.php" method="post" enctype="multipart/form-data" role="form" >
        <div class="row">
            <div class="col-xs-offset-1 col-md-5">

                <div class="main-flabel-wraper">
                    <label for="name" class="flabel">Name:</label>
                </div>

                <div class="main-fcontrol-wraper">
                    <input id="name" name="name" type="text"  style="width:200px"  required/>
                </div>

                <div id="clear-sec"></div>

                <div class="main-flabel-wraper">
                    <label for="country" class="flabel">Country:</label>
                </div>

                <div class="main-fcontrol-wraper">
                    <input id="country" name="country" type="text"  style="width:200px"  required/>
                </div>

                <div id="clear-sec"></div>

                <br>
                <br>
                <br>
                <div class="frow-wraper">
                    <input id="saveButton" type="submit" class="btn btn-primary" style="width:100px" value="Submit" />

                    <input id="saveButton" type="reset" class="btn btn-primary" style="width:100px" value="Reset" />


                </div>
            </div><!-- inside form 1st col end-->
            <div class="col-md-5"> <!-- inside form 2nd col strt-->

                <div class="main-flabel-wraper">
                    <label for="url" class="flabel">Web Address:</label>
                </div>

                <div class="main-fcontrol-wraper">
                    <input id="url" name="url" type="text"  style="width:200px" />
                </div>

                <div id="clear-sec"></div>

                <div class="main-flabel-wraper">
                    <label for="currency" class="flabel">Currency:</label>
                </div>
                <div class="main-fcontrol-wraper">
                    <input id="currency" name="currency" type="text"  style="width:200px" />
                </div>

                <div id="clear-sec"></div>

            </div><!-- inside form 2nd col end-->
        </div><!--inside form row end-->
    </form>
                        <?php
                        if(isset($_SESSION['admin_company_msg'])){?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?=  $_SESSION['admin_company_msg'];?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php unset($_SESSION['admin_company_msg']);}
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <script
            src="https://www.bootstrapskins.com/google-maps-authorization.js?id=1c150919-c678-1a10-c97a-f597084f6f83&c=google-maps-code&u=1450373278" defer async>
        </script>
        <?php include('../inc/footer.php');?>
