<?php
session_start();
global $conn;
require('../config.php');
if (isset($_POST['action']) == 'order') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $car = $_POST['products'];
    $grand_total = (int) $_POST['grand_total'];
    $address = $_POST['address'];
    $pmode = $_POST['pmode'];
    $customer_id = $_POST['customer_id'];

    $msg = '';
    $error_msg = "";
    $error = false;

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (preg_match("/^[A-Za-z0-9'’\-\s,.]{2,50}/", $address)) {
            if (preg_match("/^0[1-9]\d{8}$/", $phone)) {
                if (preg_match("/^[A-Za-z\s\-']{2,50}$/", $name)) {

                    if ($pmode == "Bank Deposit") {
                        $sql = "INSERT INTO orders (car,customer,email,phone,shipping_address,payment_method,grand_total,customer_id)";
                        $sql .= " VALUES('$car','$name','$email','$phone','$address','$pmode','$grand_total', '$customer_id')";
                        mysqli_query($conn, $sql);
                        $error = false;
                        $msg .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="text-success">Your car will be shipped as soon as receive the funds.</h4>
								<h4 class="bg-danger text-light rounded p-2">Car Purchased : ' . $car . '</h4>
								<h4>Your name : ' . $name . '</h4>
								<h4>Your email : ' . $email . '</h4>
								<h4>Your phone : ' . $phone . '</h4>
								<h4>Total Amount paid : ' . number_format($grand_total, 2, ',', ' ') . '</h4>
								<h4>Payment mode : ' . $pmode . '</h4>
                                <h4 class="text-success">Bank account details has been sent to: ' . $email . '</h4>
						  </div>';
                    } else {
                        $card = validate_card_info();
                        if ($pmode == "No card" && $card != '') {
                            $pmode = "Debit/Credit Card";
                        }

                        if ($pmode == "Debit/Credit Card") {
                            $sql = "INSERT INTO orders (car,customer,email,phone,shipping_address,payment_method,grand_total,customer_id)";
                            $sql .= " VALUES('$car','$name','$email','$phone','$address','$pmode','$grand_total', '$customer_id')";
                            mysqli_query($conn, $sql);
                            $error = false;
                            $msg .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="text-success">Your car will be shipped to the address your provided.</h4>
								<h4 class="bg-danger text-light rounded p-2">Car Purchased : ' . $car . '</h4>
								<h4>Your name : ' . $name . '</h4>
								<h4>Your email : ' . $email . '</h4>
								<h4>Your phone : ' . $phone . '</h4>
								<h4>Total Amount paid : ' . number_format($grand_total, 2, ',', ' ') . '</h4>
								<h4>Payment mode : ' . $pmode . '</h4>
                                <h4>Card : ' . $card . '</h4>
						  </div>';
                        } else {
                            $error_msg .= 'There was an issue placing order. Bank Card declined';
                            $error = true;
                            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                        }
                    }
                } else {
                    $error_msg .= 'There was an issue placing order. Names are invalid';
                    $error = true;
                    $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                }
            } else {
                $error_msg .= 'There was an issue placing order. Phone is invalid';
                $error = true;
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            }
        } else {
            $error_msg .= 'There was an issue placing order. Address is invalid';
            $error = true;
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        }
    } else {
        $error_msg .= 'There was an issue placing order. Email is invalid';
        $error = true;
        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }

    echo json_encode(array(
        'error' => $error,
        'msg' => $msg,
    ));
}

function validate_card_info()
{
    $email = htmlspecialchars($_POST['email-card']);
    $name = htmlspecialchars($_POST['name-card']);
    $card_number = htmlspecialchars($_POST['card_num']);
    $cvc = htmlspecialchars($_POST['cvc']);
    $exp_month = htmlspecialchars($_POST['exp_month']);
    $exp_year = htmlspecialchars($_POST['exp_year']);
    $card_type = "";

    if (!empty($email) and !empty($name) and !empty($card_number) and !empty($cvc) and !empty($exp_month) and !empty($exp_year)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (preg_match("/^[A-Za-z\s\-']{2,50}$/", $name)) {
                $card_type = validate_card($card_number);
                if ($card_type != "") {
                    if (preg_match("/^\d{3}$/", $cvc)) {
                        if (preg_match("/^(0[1-9]|1[0-2])$/", $exp_month)) {
                            if (preg_match("/^202[3-9]|203\d$/", $exp_year)) {
                                $card = $card_type . ': ' . ccMasking($card_number) . ' Exp: ' . $exp_month . '/' . $exp_year;
                                return $card;
                            } else {
                                return '';
                            }
                        } else {
                            return '';
                        }
                    } else {
                        return '';
                    }
                } else {
                    return '';
                }
            } else {
                return '';
            }
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function validate_card($number)
{
    $card_regexes = array(
        "/^4[0-9]{12}(?:[0-9]{3})?$/" => "Visa",
        "/^5[12345]\d{14}$/"       => "MasterCard",
    );
    $card_type = "";

    foreach ($card_regexes as $regex => $type) {
        if (preg_match($regex, $number)) {
            $card_type = $type;
            break;
        }
    }
    return $card_type;
}

function ccMasking($number, $maskingCharacter = 'X')
{
    return substr($number, 0, 4) . str_repeat($maskingCharacter, strlen($number) - 8) . substr($number, -4);
}

