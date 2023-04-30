<?php
session_start();
global $conn;
require '../config.php';
$name = '';
$customer_id = '';
if(isset($_SESSION['customer_name'])){
    $name = $_SESSION['customer_name'];
    $customer_id = $_SESSION['customer_id'];
    $sql = "SELECT * FROM debit_card where customer_id='$customer_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $totalResult = mysqli_num_rows($result);
    if($totalResult > 0) {
        $hasCard = true;
    }
    else{
        $hasCard = false;
    }
}
else{
    header('location: login_reg.php');
}

$id=$_GET['id'];

$sql = "SELECT CONCAT(maker, ' ', model) AS item, price, currency FROM car WHERE id='" . $id . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$price = $row['price'];
$item = $row['item'];

if($row['currency'] != 'R'){
    $shipping = 'R10 000,00';
    $grand_total = 10000 + (int) $price * 18.09;
}
else{
    $shipping = 'R0,00';
    $grand_total = (int) $price;
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/s.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
    <link rel="stylesheet" href="../assets/css/style_search.css">
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
                    <li class="nav-item">
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 px-4 pb-4" id="order">
            <h4 class="text-center text-info p-2">Complete your order!</h4>
            <div class="jumbotron p-3 mb-2 text-center">
                <h6 class="lead"><b>Car : </b><?= $item; ?></h6>
                <h6 class="lead"><b>Shipping Costs : </b><?= $shipping; ?></h6>
                <h5><b>Total Amount Payable : </b>R<?= number_format($grand_total,2, ',', ' ') ?></h5>
            </div>
            <form action="" method="post" id="placeOrder">
                <input type="hidden" name="products" value="<?= $item; ?>">
                <input type="hidden" name="customer_id" value="<?= $customer_id; ?>">
                <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" class="form-control" placeholder="Enter phone" required>
                </div>
                <div class="form-group">
                    <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter delivery address here..."></textarea>
                </div>
                <h6 class="text-center lead">Select Payment Mode</h6>
                <div class="form-group">
                    <select name="pmode" class="form-control" required>
                        <option value="" selected disabled>-Select Payment Mode-</option>
                        <option value="Bank Deposit">Bank Deposit</option>
                        <?php
                        if($hasCard){
                            echo '<option value="Debit/Credit Card">Debit/Credit Card</option>';
                        }
                        else{
                            echo '<option value="" disabled>No debit/credit card, add bank card</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
                </div>
            </form>
        </div>
    </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

<script type="text/javascript">
    $(document).ready(function() {

        // Sending Form data to the server
        $("#placeOrder").submit(function(e) {
            e.preventDefault();
            jQuery.ajax({
                url: 'checkout.php',
                method: 'post',
                data: $('form').serialize() + "&action=order",
                success: function(response) {
                    $("#order").html(response);
                }
            });
        });
    });
</script>
<?php include('../inc/footer.php');?>
