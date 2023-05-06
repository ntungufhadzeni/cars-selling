<?php
global $conn;
require('../config.php');

if(isset($_POST['action']) == 'card'){
    $email = htmlspecialchars($_POST['email']);
    $name = htmlspecialchars($_POST['name']);
    $card_number = htmlspecialchars($_POST['card_num']);
    $cvc = htmlspecialchars($_POST['cvc']);
    $exp_month = htmlspecialchars($_POST['exp_month']);
    $exp_year = htmlspecialchars($_POST['exp_year']);
    $customer_id = htmlspecialchars($_POST['customer_id']);
    $card_type = "";

    if (!empty($email) and !empty($name) and !empty($card_number) and !empty($cvc) and !empty($exp_month) and !empty($exp_year)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (preg_match("/^[A-Za-z\s\-']{2,50}$/", $name)) {
                $card_type = validate_card($card_number);
                if ($card_type != "") {
                    if (preg_match("/^\d{3}$/", $cvc)) {
                        if (preg_match("/^(0[1-9]|1[0-2])$/", $exp_month)) {
                            if (preg_match("/^202[3-9]|203\d$/", $exp_year)) {
                                $sql = "INSERT INTO debit_card(customer_id,card_holder,card_number,cvc,exp_month,exp_year,email,card_type) ";
                                $sql .= "VALUES('$customer_id','$name','$card_number','$cvc','$exp_month','$exp_year','$email','$card_type')";
                                $result = mysqli_query($conn, $sql);
                                if ($result) {
                                    $error_card_msg = 'Card added successfully';
                                    $error = false;
                                    $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                                } else {
                                    $error_card_msg = 'There was an issue adding a card';
                                    $error = true;
                                    $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                                }
                            } else {
                                $error_card_msg = 'Invalid year';
                                $error = true;
                                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                            }
                        } else {
                            $error_card_msg = 'Invalid month';
                            $error = true;
                            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                        }
                    } else {
                        $error_card_msg = 'Invalid CVC number';
                        $error = true;
                        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                    }
                } else {
                    $error_card_msg = 'Invalid card number';
                    $error = true;
                    $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                }
            } else {
                $error_card_msg = 'Invalid card holder name';
                $error = true;
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            }
        } else {
            $error_card_msg = 'Invalid email address';
            $error = true;
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        }
    } else {
        $error_card_msg = 'All fields required';
        $error = true;
        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }

    if ($error) {
        $cardHTML = '<div class="user__details-col-field" style="color: #666;"> No debit card</div>';
                     
        $card_btn = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal">Add Debit Card</button>';
        echo json_encode(array("msg" => $msg, "card" => $cardHTML, "card_btn" => $card_btn));
    } else {
        $sql = "SELECT * FROM debit_card where customer_id='$customer_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $card = $card_type . ': ' . ccMasking($card_number) . ' Exp: ' . $exp_month . '/' . $exp_year;
        $cardHTML = '<div class="user__details-col-field" style="color: #666;">' .
            $card . '</div>';
        $card_btn = '<a href="remove-card.php?id=' . $row['id'] . '" class="btn btn-primary">Remove</a>';
        echo json_encode(array("msg" => $msg, "card" => $cardHTML, "card_btn" => $card_btn));
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


