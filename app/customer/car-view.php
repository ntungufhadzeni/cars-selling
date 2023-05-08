<?php
global $conn;
include_once '../config.php';
session_start();
$name = '';
$id = $_GET['id'];
$sql = "select * from car where id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$photo = $row['image'];
$seller = $row['company_name'];
$make = $row['maker'];
$model = $row['model'];
$car_name = $make . " " . $model;
$description = $row['description'];
$price = $row['price'];
$color = $row['color'];
$year = $row['year'];
$transmission = $row['transmission'];
$currency = $row['currency'];
$engine_capacity = $row['engine_capacity'];
$status = $row['status'];
$fuel = $row['fuel'];
$mileage = number_format($row['mileage'], 0, ',', ' ');
$price_f = $currency . ' ' . number_format($price, 2, ',', ' ');
if ($currency != 'R') {
    $price_f = $currency . ' ' . number_format($price, 2, ',', ' ') . ' (R ' . number_format($price * 18.09, 2, ',', ' ') . ')';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
    <title>Car: <?php echo ($car_name) ?></title>
</head>

<body>
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" <?php
                                        if (isset($_SESSION['customer_name'])) {
                                            echo ('href="index.php"');
                                        } else {
                                            echo ('href="../index.php"');
                                        }
                                        ?>>
                    <h2>Online-<em>Cars</em></h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <?php
                        if (isset($_SESSION['customer_name'])) {
                            echo ('<li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>');
                        } else {
                            echo ('<li class="nav-item active">
                        <a class="nav-link" href="../index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>');
                        } ?>
                        <?php
                        if (isset($_SESSION['customer_name'])) {
                            echo ('<li class="nav-item ">
                        <a class="nav-link" href="profile.php"> Profile
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
                    </li>');
                        }
                        ?>
                    </ul>
                </div>
        </nav>
    </header>

    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Login to Your Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="loginFrm" class="modal-body" action="" method="post">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a class="btn btn-primary" href='<?php $_SESSION['msg_register'] = "register"; echo ("login-reg.php"); ?>'>Register</a>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="banner header-text">
        <div class="owl-banner owl-carousel">
        </div>
    </div>
    <div style="margin-bottom: 80px;"></div>
    <div class="container" style="background-color:#eaeff1; border-radius: 20px;">
        <h1 class="ptext " style="color:#333333;margin-top:90px; "><b>Details</b>
        </h1>
        <!-- Display image work-->
        <div>
            <div class="row">
                <div class=" col-md-2"> </div>
                <div class=" col-md-10">
                    <img id="large-image" src='<?php echo ('../assets/images/cars/' . $photo); ?>' class="img-thumbnail" height="480" width="640">
                </div>
            </div>

        </div>

        <!-- Display image work end-->
        <div class="row" style="margin-top:30px;">
            <div class=" col-xs-offset-1 col-md-11">

                <label id="car-name" for="car-name"> <?php echo ($car_name); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </div>
        <p>
            <?php echo $description; ?>
        </p>
        <div class="row" style="margin-bottom:20px;">
            <div class="col-xs-offset-1 col-md-4 ">
                <hr>
                <label id="seller" for="seller">Seller</label>
                <label class="pull-right" id="seller"><?php echo ($seller); ?></label>
                <hr>
                <label id="maker" for="maker">Maker</label>
                <label class="pull-right" id="maker"><?php echo ($make); ?></label>
                <hr>
                <label id="model" for="model">Model</label>
                <label class="pull-right" id="model"><?php echo ($model); ?></label>
                <hr>
                <label id="color" for="color">Color</label>
                <label class="pull-right" id="color"><?php echo ($color); ?></label>
                <hr>
                <label id="mileage" for="mileage">Mileage</label>
                <label class="pull-right" id="mileage"><?php echo ($mileage); ?> km</label>
                <hr>
            </div>
            <div class=" col-md-1 "> </div>
            <div class="col-md-4">
                <hr>
                <label id="yearmonth" for="yearmonth">Year/Month</label>
                <label class="pull-right" id="yearmonth" for="yearmonth"><?php echo ($year); ?></label>
                <hr>
                <label id="transmission" for="transmission">Transmission</label>
                <label class="pull-right" id="transmission" for="transmission"><?php echo ($transmission); ?></label>
                <hr>
                <label id="enginecapacity" for="enginecapacity">Engine Capacity</label>
                <label class="pull-right" id="enginecapacity" for="enginecapacity"><?php echo ($engine_capacity); ?></label>
                <hr>
                <label id="fuel" for="fuel">Fuel</label>
                <label class="pull-right" id="fuel" for="fuel"><?php echo ($fuel); ?></label>
                <hr>
                <label id="price" for="price">Price </label>
                <label class="pull-right" id="price" for="price"><?php echo ($price_f); ?></label>
                <hr>
            </div>
        </div>
    <div id="login-msg"></div>
        <div class="row-md-5">
            <div class=" col-md-5"> </div>
            <div class="col-md-5">
                <?php
                if (isset($_SESSION['customer_name'])) { ?>
                    <div style="margin-bottom: 20px"><a href="place-order.php?id=<?php echo $id; ?>" class='btn btn-primary'>Checkout</a></div>
                <?php }
                ?>
                <?php
                if (!isset($_SESSION['customer_name'])) { ?>
                    <div style="margin-bottom: 20px">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login-modal">
                            Login before you checkout
                        </button>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#loginFrm").submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: "login.php",
      method: "post",
      data: $("form").serialize() + "&action=login",
      success: function (response) {
        let responseData = JSON.parse(response);
        let error = responseData['error'];
        $("#login-modal").modal('hide');
        $("#loginFrm").find("input,textarea,select").val("").end();
        $("#login-msg").html(responseData['msg']);
        if(!error){
            setTimeout(() => {
          document.location.reload();
        }, 3000);
        }
      },
    });
  });
});
</script>
    <?php include('../inc/footer.php'); ?>