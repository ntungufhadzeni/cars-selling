<?php
session_start();
$name = '';
global $conn;
require('../config.php');
if (isset($_SESSION['customer_name'])) {
    $name = $_SESSION['customer_name'];
    $id = $_SESSION['customer_id'];
    $customer_sql = "SELECT * FROM customer WHERE id='$id'";
    $customer_result = mysqli_query($conn, $customer_sql);
    $customer = mysqli_fetch_assoc($customer_result);
    $cname = $customer['first_name'] . ' ' . $customer['surname'];
    $cemail = $customer['email'];
    $sql = "SELECT * FROM debit_card where customer_id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $totalResult = mysqli_num_rows($result);
    if ($totalResult > 0) {
        $hasCard = true;
        $card = $row['card_type'] . ': ' . ccMasking($row['card_number']) . ' Exp: ' . $row['exp_month'] . '/' . $row['exp_year'];
    } else {
        $hasCard = false;
    }
} else {
    header('location: login-reg.php');
}

function ccMasking($number, $maskingCharacter = 'X')
{
    return substr($number, 0, 4) . str_repeat($maskingCharacter, strlen($number) - 8) . substr($number, -4);
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
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
    <title>Online-cars</title>
</head>

<body>
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <h2>Hi, <em><?php echo $name ?></em></h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                                        if (isset($hasCard) && $hasCard) {
                                            echo '<div class="user__details-col-field" style="color: #666;">';
                                            echo $card;
                                            echo '</div>';
                                        } else {
                                            echo '<div class="user__details-col-field" style="color: #666;"> No debit card</div>';
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
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div id="card-btn"><?php
                                        if (isset($hasCard) && $hasCard) {
                                            echo '<a href="remove-card.php?id=' . $row['id'] . '" class="btn btn-primary">Remove</a>';
                                        } else {
                                            echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal">Add Debit Card</button>';
                                        }
                                        ?>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="user__details-col-field" style="color: #666;">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#passwordModal">Change Password</button>';
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
                            <input type="text" class="form-control" id="name" name="name" placeholder="Card Holder" pattern="^[A-Za-z\s\-']{2,50}$" value="<?= $cname; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control email" id="email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="Email" value="<?= $cemail; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="card_num">Card Number</label>
                            <input type="text" class="form-control card-number" id="card_num" name="card_num" placeholder="Card Number" pattern="^\d{16}$" maxlength="16" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cvc">CVC</label>
                                <input type="text" class="form-control card-cvc" id="cvc" name="cvc" placeholder="CVC" pattern="^\d{3}$" maxlength="3" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exp_date">Expiration (MM/YYYY)</label>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control card-expiry-month" id="exp_month" name="exp_month" placeholder="MM" pattern="^(0[1-9]|1[0-2])$" minlength="2" maxlength="2" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control card-expiry-year" id="exp_year" name="exp_year" placeholder="YYYY" pattern="^202[3-9]|203\d$" minlength="4" maxlength="4" required>
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

    <!-- Modal -->
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" method="POST" id="passwordFrm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passwordModalLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" class="form-control" id="customer-id" name="customer-id" value="<?= $id; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="old-password">Old Password</label>
                            <input type="password" class="form-control" id="old-password" name="old-password"  placeholder="Old Password" minlength="8" required>
                        </div>
                        <div class="form-group">
                            <label for="new-password">New Password</label>
                            <input type="password" class="form-control email" id="new-password" name="new-password" oninput="checkOldNewPasswordMatch();" placeholder="New Password" minlength="8" required>
                        </div>
                        <div class="form-group">
                            <label for="retype-password">Retype New Password</label>
                            <input type="password" class="form-control card-number" id="retype-password" name="retype-password" oninput="checkPasswordMatch();" placeholder="Retype New Password" minlength="8" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="passwordBtn">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
    $("#paymentFrm").submit(function (e) {
        e.preventDefault();
  $.ajax({
    url: "add-card.php",
    method: "post",
    data: $("form").serialize() + "&action=card",
    success: function (response) {
      $("#paymentFrm").find("input,textarea,select").val("").end();
      $('#paymentModal').modal('hide');
      let responseData = JSON.parse(response);
      $("#card").html(responseData["card"]);
      $("#card-btn").html(responseData["card_btn"]);
      $("#card-alert").html(responseData["msg"]);
    },
  });
});
});
</script>
<script type="text/javascript">
     $(document).ready(function(){
$("#passwordFrm").submit(function (e) {
    e.preventDefault();
  $.ajax({
    url: "change-password.php",
    method: "post",
    data: $("form").serialize() + "&action=password",
    success: function (response) {
        $('#passwordModal').modal('hide');
      $("#passwordFrm").find("input,textarea,select").val("").end();
      $("#card-alert").html(response);
    },
  });
});
});
</script>
<script>
function checkPasswordMatch() {
    let password1 = document.getElementById("new-password").value;
    let password2 = document.getElementById("retype-password").value;

    if (password1 != password2) {
        document.getElementById("retype-password").setCustomValidity("Passwords do not match");
    } else {
        document.getElementById("retype-password").setCustomValidity("");
    }
}
</script>
<script>
function checkOldNewPasswordMatch() {
    let password1 = document.getElementById("old-password").value;
    let password2 = document.getElementById("new-password").value;


    if (password1 != password2) {
       if (password2.match(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#$&*~]).{8,}$/)) {
        document.getElementById("new-password").setCustomValidity("");
    } else {
        document.getElementById("new-password").setCustomValidity("Password must be 8 characters long and include at least 1 uppercase, lowercase, numeric number, special character");
    }
    } else {
        document.getElementById("new-password").setCustomValidity("Old and new password match. Enter new password");
    }

}
</script>
    <?php include('../inc/footer.php'); ?>
    