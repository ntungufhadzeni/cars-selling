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
    <title>Add Car</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="all_customers.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="all_cars.php"> Cars
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
<div  class="row">
<div class="container-fluid" style=" margin-top:150px;">
<div class="container">
    <div class="col-sm-10">
        <h1 class="text-center " style="color:#333333;  margin-top:-60px;"> Car Add Form </h1>
        <div class="well" style="border:solid ; border-color:rgb(3, 60, 115); margin-top:15px;">
    <div class="form1">
        <form action="add_car.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-offset-1 col-md-5">

                    <div class="main-flabel-wraper">
                        <label for="maker" class="flabel">Maker:</label>
                    </div>
                    <div class="main-fcontrol-wraper">
                        <input id="maker" name="maker" type="text"  style="width:200px" required />
                    </div>

                    <div id="clear-sec"></div>

                    <div class="main-flabel-wraper">
                        <label for="model" class="flabel">Model:</label>
                    </div>

                    <div class="main-fcontrol-wraper">
                        <input id="model" name="model" type="text"  style="width:200px" required />
                    </div>

                    <div id="clear-sec"></div>

                    <div class="main-flabel-wraper">
                        <label for="mileage" class="flabel">Mileage:</label>
                    </div>

                    <div class="main-fcontrol-wraper">
                        <input id="mileage" name="mileage" type="text"  style="width:200px"  required/>
                    </div>

                    <div id="clear-sec"></div>

                    <div class="main-flabel-wraper">
                        <label for="color" class="flabel">Color:</label>
                    </div>

                    <div class="main-fcontrol-wraper">
                        <input id="color" name="color" type="text"  style="width:200px" required />
                    </div>

                    <div id="clear-sec"></div>

                    <div class="main-flabel-wraper">
                        <label for="stockstatus" class="flabel">Stock Status:</label>
                    </div>

                    <div class="main-fcontrol-wraper">

                        <select id="stockstatus" name="stockstatus"  style="width:200px" required >
                            <option value="Available"> Available </option>
                            <option value="Sold">Sold</option>
                        </select>
                    </div>

                    <div id="clear-sec"></div>

                    <div class="main-flabel-wraper">
                        <label for="year" class="flabel">Year:</label>
                    </div>

                    <div class="main-fcontrol-wraper">
                        <input id="year" name="year" type="text"  style="width:200px" />
                    </div>

                    <div id="clear-sec"></div>

                    <div class="main-flabel-wraper">
                        <label for="type" class="flabel">Type:</label>
                    </div>

                    <div class="main-fcontrol-wraper">
                        <input id="type" name="type" type="text"  style="width:200px" />
                    </div>

                    <div id="clear-sec"></div>

                    <div class="main-flabel-wraper">
                        <label for="company-name" class="flabel">Company Name:</label>
                    </div>

                    <div class="main-fcontrol-wraper">
                        <input id="company-name" name="company-name" type="text"  style="width:200px"  required/>
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
                        <label for="transmission" class="flabel">Transmission:</label>
                    </div>
                    <div class="main-fcontrol-wraper">
                        <select id="transmission" name="transmission"  style="width:200px" required >
                            <option value="Manual"> Manual </option>
                            <option value="Automatic">Automatic</option>
                        </select>
                    </div>

                    <div id="clear-sec"></div>

                    <div class="main-flabel-wraper">
                        <label for="enginecapacity" class="flabel">Engine Capacity:</label>
                    </div>

                    <div class="main-fcontrol-wraper">
                        <input id="enginecapacity" name="enginecapacity" type="text"  style="width:200px" required />
                    </div>

                    <div id="clear-sec"></div>


                    <div class="main-flabel-wraper">
                        <label for="fuel" class="flabel">Fuel:</label>
                    </div>

                    <div class="main-fcontrol-wraper">
                        <input id="fuel" name="fuel" type="text"  style="width:200px" required />
                    </div>

                    <div id="clear-sec"></div>


                    <div class="main-flabel-wraper">
                        <label for="price" class="flabel">Price :</label>
                    </div>

                    <div class="main-fcontrol-wraper">
                        <input id="price" name="price" type="text" min="0" style="width:200px" required/>
                    </div>

                    <div id="clear-sec"></div>

                    <div class="main-flabel-wraper">
                        <label for="description" class="flabel">Description :</label>
                    </div>

                    <div class="main-fcontrol-wraper">
                        <input id="description" name="description" type="text" min="0" style="width:200px" required/>
                    </div>

                    <div class="main-flabel-wraper">
                        <label for="url" class="flabel">Url:</label>
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

                    <div class="main-flabel-wraper">
                        <label for="description" class="flabel">Images:</label>
                    </div>
                    <div class="main-fcontrol-wraper" >
                        <input id="photo" name="photo" type="file" required />
                    </div>
                    <div id="clear-sec"></div>

                </div><!-- inside form 2nd col end-->
            </div><!--inside form row end-->
        </form>
        <?php
        if(isset($_SESSION['admin_car_msg'])){?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?=  $_SESSION['admin_car_msg'];?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php unset($_SESSION['admin_car_msg']);}
        ?>
    </div>
        </div>
</div>
</div>
<script
    src="https://www.bootstrapskins.com/google-maps-authorization.js?id=1c150919-c678-1a10-c97a-f597084f6f83&c=google-maps-code&u=1450373278" defer async>
</script>
<?php include('../inc/footer.php');?>
