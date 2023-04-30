<?php
session_start();
$name = '';
global $conn;
require('../config.php');
if(isset($_SESSION['customer_name'])){
    $name = $_SESSION['customer_name'];
    $id = $_SESSION['customer_id'];
    $customer_sql = "SELECT * FROM customer WHERE id='$id'";
    $customer_result = mysqli_query($conn,$customer_sql);
    $customer = mysqli_fetch_assoc($customer_result);
    $sql = "SELECT * FROM debit_card where customer_id='$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $totalResult = mysqli_num_rows($result);
    if($totalResult > 0){
        $hasCard = true;
        $card = $row['card_type'].': '. ccMasking($row['card_number']).' Exp: '. $row['exp_month'].'/'.$row['exp_year'];
    }
    else{
        $hasCard = false;
    }
}
else{
    header('location: login_reg.php');
}

function ccMasking($number, $maskingCharacter = 'X') {
    return substr($number, 0, 4) . str_repeat($maskingCharacter, strlen($number) - 8) . substr($number, -4);
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
                    <li class="nav-item active">
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
<div class="container my-5">
    <div id="card-alert"></div>
    <div class="row">
        <div class="col-md-3">
            <div class="user">
                <div class="user__image">
                    <img src="../assets/images/user.png" alt="" width="200" height="160">
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <h2 class="mb-4" style="color: #333;">Personal Information</h2>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="mb-2" style="color: #333;">First Names:</h5>
                    <div class="user__details-col-field" style="color: #666;">
                        <?= $customer["first_name"] ?>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <h5 class="mb-2" style="color: #333;">Surname:</h5>
                    <div class="user__details-col-field" style="color: #666;">
                        <?= $customer["surname"] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="mb-2" style="color: #333;">Address:</h5>
                    <div class="user__details-col-field" style="color: #666;">
                        <?= $customer["address"] ?>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <h5 class="mb-2" style="color: #333;">Email:</h5>
                    <div class="user__details-col-field" style="color: #666;">
                        <?= $customer["email"] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="mb-2" style="color: #333;">Debit/Credit Card:</h5>
                    <!-- Button to trigger modal -->
                    <div id="card"><?php
                    if(isset($hasCard) && $hasCard) {
                        echo '<div class="user__details-col-field" style="color: #666;">';
                        echo $card;
                        echo '</div>';
                        echo '<a href="remove_card.php?id=' . $row['id'] . '" class="btn btn-primary">Remove</a>';
                    } else {
                        echo '<div class="user__details-col-field" style="color: #666;"> No debit card</div>';
                        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal">Add Debit Card</button>';
                    }
                    ?>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <h5 class="mb-2" style="color: #333;">Phone:</h5>
                    <div class="user__details-col-field" style="color: #666;">
                        <?= $customer["phone"] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="paymentFrm">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Add Debit Card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="<?= $id; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Card Holder</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Card Holder" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="card_num">Card Number</label>
                        <input type="text" class="form-control card-number" id="card_num" name="card_num" placeholder="Card Number" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cvc">CVC</label>
                            <input type="text" class="form-control card-cvc" id="cvc" name="cvc" placeholder="CVC" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exp_date">Expiration (MM/YYYY)</label>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control card-expiry-month" id="exp_month" name="exp_month" placeholder="MM" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control card-expiry-year" id="exp_year" name="exp_year" placeholder="YYYY" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="payBtn">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        // Sending Form data to the server
        $("#paymentFrm").submit(function(e) {
            e.preventDefault();
            $('#paymentModal').modal('hide');
            jQuery.ajax({
                url: 'add_card.php',
                method: 'post',
                data: $('form').serialize() + "&action=card",
                success: function(response) {
                    $('#paymentFrm')
                        .find("input,textarea,select")
                        .val('')
                        .end()
                    let responseData = JSON.parse(response);
                    $("#card").html(responseData['card'])
                    $("#card-alert").html(responseData['msg']);
                }
            });
        });
    });
</script>
<?php include('../inc/footer.php');?>
