<?php
session_start();
global $conn;
require '../config.php';
$name = '';
$customer_id = '';
if (isset($_SESSION['customer_name'])) {
    $name = $_SESSION['customer_name'];
    $customer_id = $_SESSION['customer_id'];
    $sql = "SELECT * FROM debit_card where customer_id='$customer_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $totalResult = mysqli_num_rows($result);
    if ($totalResult > 0) {
        $hasCard = true;
    } else {
        $hasCard = false;
    }
} else {
    header('location: login-reg.php');
}

$id = $_GET['id'];

$sql = "SELECT CONCAT(maker, ' ', model) AS item, price, currency FROM car WHERE id='" . $id . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$price = $row['price'];
$item = $row['item'];

if ($row['currency'] != 'R') {
    $shipping = 'R10 000,00';
    $grand_total = 10000 + (int) $price * 18.09;
} else {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
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
            </div>
        </nav>
    </header>


    <div class="banner header-text">
        <div class="owl-banner owl-carousel">
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 px-4 pb-4" id="order">
                <h4 class="text-center text-info p-2">Complete your order!</h4>
                <div id="error"></div>
                <div class="jumbotron p-3 mb-2 text-center">
                    <h6 class="lead"><b>Car : </b><?= $item; ?></h6>
                    <h6 class="lead"><b>Shipping Costs : </b><?= $shipping; ?></h6>
                    <h5><b>Total Amount Payable : </b>R<?= number_format($grand_total, 2, ',', ' ') ?></h5>
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
                        <select name="pmode" id="pmode" class="form-control" required>
                            <option value="" selected disabled>-Select Payment Mode-</option>
                            <option value="Bank Deposit">Bank Deposit</option>
                            <?php
                            if ($hasCard) {
                                echo '<option value="Debit/Credit Card">Debit/Credit Card</option>';
                            } else {
                                echo '<option value="No card">Debit/Credit Card</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div id="card"></div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>

                            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>
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
                        let responseData = JSON.parse(response);
                        let error = responseData['error'];
                        let msg = responseData['msg'];
                        if (error) {
                            $("#error").html(msg);
                        } else {
                            $("#order").html(msg);
                        }


                    }
                });
            });
        });
    </script>
    <script>
        const select = document.getElementById('pmode');
        const container = document.getElementById('card');

        select.addEventListener('change', (event) => {
            const value = event.target.value;

            if (value === 'No card') {
                container.innerHTML = `
                <div class="form-group">
                    <label for="name-card">Card Holder</label>
                    <input type="text" class="form-control" id="name-card" name="name-card" placeholder="Card Holder" required>
                </div>
                <div class="form-group">
                    <label for="email-card">Email</label>
                    <input type="text" class="form-control email" id="email-card" name="email-card" placeholder="Email" required>
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
            `;
            } else {
                container.innerHTML = '';
            }
        });
    </script>

    <?php include('../inc/footer.php'); ?>