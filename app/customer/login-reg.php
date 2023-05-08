<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

session_start();
global $conn;
require('../config.php');

if (isset($_POST['login'])) {
    $error_login = false;
    $error_msg_login = '';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        if (!empty($email) && !empty($password)) {
            $sql = "SELECT * FROM customer WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $nor = mysqli_num_rows($result);

            if ($nor > 0) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['password'])) {
                    if ($row['status'] == 1) {
                        $_SESSION['admin_logged'] = false;
                        $_SESSION['customer_id'] = $row['id'];
                        $_SESSION['customer_name'] = $row['first_name'];
                        $_SESSION['customer_email'] = $row['email'];
                        header('location: index.php');
                    } else {
                        $error_login = true;
                        $error_msg_login = 'Your account has been suspended';
                    }
                } else {
                    $error_login = true;
                    $error_msg_login = 'Incorrect password';
                }
            } else {
                $error_login = true;
                $error_msg_login = 'Email not recognized';
            }
        } else {
            $error_login = true;
            $error_msg_login = 'Email and password are required';
        }
    }
} elseif (isset($_POST['register'])) {
    $error_reg = false;
    $error_msg_reg = '';
    $success_msg = '';
    $success = false;
    $first_name = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $surname = trim(mysqli_real_escape_string($conn, $_POST['surname']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $phone = trim(mysqli_real_escape_string($conn, $_POST['phone']));
    $province = ucwords(trim(mysqli_real_escape_string($conn, $_POST['province'])));
    $address = ucwords(trim(mysqli_real_escape_string($conn, $_POST['address'])));
    $password = trim(mysqli_real_escape_string($conn, $_POST['reg-password']));
    $retype_password = trim(mysqli_real_escape_string($conn, $_POST['retype-password']));

    if (!empty($first_name) && !empty($surname) && !empty($email) && !empty($phone) && !empty($province) && !empty($address) && !empty($password) && !empty($retype_password)) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (preg_match("/^0[1-9]\d{8}$/", $phone)) {
                if (preg_match("/^[A-Za-z?\s\-']{2,50}$/", $first_name) && preg_match("/^[A-Za-z\s\-']{2,50}$/", $surname)) {
                    $x = strtolower($email);
                    $sql = "SELECT * FROM customer WHERE LOWER(email) = '$x' OR phone = '$phone';";
                    $result = mysqli_query($conn, $sql);
                    $nor = mysqli_num_rows($result);
                    if ($nor == 0) {
                        if (preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#\$&*~]).{8,}$/", $password)) {
                            if ($retype_password == $password) {
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                $sql = "INSERT INTO customer(first_name,surname,email,phone,address,province,password) 
                                    VALUES ('$first_name','$surname','$email','$phone','$address','$province','$hashed_password')";
                                mysqli_query($conn, $sql);
                                $success = true;
                                $error_reg = false;
                                $success_msg = "Customer registered successfully";
                                $_SESSION['msg_register'] = "register";
                            } else {
                                $error_reg = true;
                                $error_msg_reg = "Passwords don't match";
                                $_SESSION['msg_register'] = "register";
                            }
                        } else {
                            $error_reg = true;
                            $error_msg_reg = "Password must be 8 characters long and include at least 1 uppercase, lowercase, numeric number, special character";
                            $_SESSION['msg_register'] = "register";
                        }
                    } else {
                        $error_reg = true;
                        $error_msg_reg = 'Customer already exists. Reset password if you forgot it.';
                        $_SESSION['msg_register'] = "register";
                    }
                } else {
                    $error_reg = true;
                    $error_msg_reg = 'Invalid name, surname or address';
                    $_SESSION['msg_register'] = "register";
                }
            } else {
                $error_reg = true;
                $error_msg_reg = 'Invalid phone number';
                $_SESSION['msg_register'] = "register";
            }
        } else {
            $error_reg = true;
            $error_msg_reg = 'Invalid email address';
            $_SESSION['msg_register'] = "register";
        }
    } else {
        $error_reg = true;
        $error_msg_reg = 'All fields are required';
        $_SESSION['msg_register'] = "register";
    }
} elseif (isset($_POST['reset1'])) {
    $error = "";
    if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
        $email = $_POST["email"];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            $error .= "<p>Invalid email address please type a valid email address!</p>";
        } else {
            $sel_query = "SELECT * FROM `customer` WHERE email='" . $email . "'";
            $results = mysqli_query($conn, $sel_query);
            $row = mysqli_num_rows($results);
            if ($row == "") {
                $error .= "<p>No user is registered with this email address!</p>";
            }
        }
        if ($error != "") {
            echo "<div class='error'>" . $error . "</div>
   <br /><a href='javascript:history.go(-1)'>Go Back</a>";
        } else {
            $expFormat = mktime(
                date("H"),
                date("i"),
                date("s"),
                date("m"),
                date("d") + 1,
                date("Y")
            );
            $expDate = date("Y-m-d H:i:s", $expFormat);
            $key = md5((2418 * 2) . '' . $email);
            $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
            $key = $key . $addKey;
            // Insert Temp Table
            mysqli_query(
                $conn,
                "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');"
            );

            $output = '<p>Dear user,</p>';
            $output .= '<p>Please click on the following link to reset your password.</p>';
            $output .= '<p>-------------------------------------------------------------</p>';
            $output .= '<p><a href="http://103.45.247.202:8000/customer/reset-password.php?
key=' . $key . '&email=' . $email . '&action=reset" target="_blank">
https://www.allphptricks.com/forgot-password/reset-password.php
?key=' . $key . '&email=' . $email . '&action=reset</a></p>';
            $output .= '<p>-------------------------------------------------------------</p>';
            $output .= '<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
            $output .= '<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';
            $output .= '<p>Thanks,</p>';
            $output .= '<p>Onlinecars Team</p>';
            $body = $output;
            $subject = "Password Recovery - Onlinecars";

            $email_to = $email;
            $fromserver = "enquiries4Onlinecars@gmail.com";
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com"; // Enter your host here
            $mail->SMTPAuth = true;
            $mail->Username = "enquiries4Onlinecars@gmail.com"; // Enter your email here
            $mail->Password = "Online@cars23"; //Enter your password here
            $mail->Port = 465;
            $mail->IsHTML(true);
            $mail->From = "enquiries4Onlinecars@gmail.com";
            $mail->FromName = "Onlinecars";
            $mail->Sender = $fromserver; // indicates ReturnPath header
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($email_to);
            if (!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "<div class='error'>
<p>An email has been sent to you with instructions on how to reset your password.</p>
</div><br /><br /><br />";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Online-Cars</title>
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="../index.php">
                    <h2>Online-<em>Cars</em></h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-hover">
                            <a class="nav-link" href="#" data-bs-toggle="dropdown" aria-expanded="false">Login</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="../admin/login-reg.php">Admin</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="login-reg.php">Customer</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="first">
                    <div class="myform form ">
                        <br><br><br><br>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <a href="#"><img style="width:125px;height:100px; border-radius: 15px;" src="../assets/images/1.jpg" class="img-responsive" alt=""></a>
                            </div>
                            <div style="padding-top:25px" class="col-md-6">
                                <h4>Customer Panel</h4>
                                <br>
                            </div>
                        </div>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link <?php

                                                            if (!isset($_SESSION['msg_register'])) {
                                                                echo "active";
                                                                $_SESSION['msg_register'] = "login";
                                                            } elseif ($_SESSION['msg_register'] == "login") {
                                                                echo "active";
                                                            }
                                                            ?>" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Login</a>
                                <a class="nav-item nav-link  <?php
                                                                if ($_SESSION['msg_register'] == "register") {
                                                                    echo "active";
                                                                }
                                                                ?>" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Register</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Forgot Password?</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade <?php

                                                        if ($_SESSION['msg_register'] == "login") {
                                                            echo "show active";
                                                        }
                                                        ?>" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <br><br>
                                <div class="logo mb-3">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="email">Email<span style="color:red">*</span></label>
                                            <label for="Email"></label><input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password-login">Password<span style="color:red">*</span></label>
                                            <input type="password" name="password" id="password-login" class="form-control" placeholder="Password" required>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="checkbox" onclick="showPassL()"> Show Password
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($error_login) && $error_login) { ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= $error_msg_login ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php }
                                    ?>
                                    <br><br><br><br>
                                </div>
                            </div>
                            <div class="tab-pane fade <?php
                                                        if ($_SESSION['msg_register'] == "register") {
                                                            echo "show active";
                                                            unset($_SESSION['msg_register']);
                                                        }
                                                        ?>" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <br><br>
                                <div class="row justify-content-center">
                                </div>
                                <div class="logo mb-3">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="name">First Names<span style="color:red">*</span></label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="First Names" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname">Surname<span style="color:red">*</span></label>
                                            <input type="text" name="surname" id="surname" class="form-control" placeholder="Surname" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email<span style="color:red">*</span></label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone<span style="color:red">*</span></label>
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" minlength="10" maxlength="10"  required>
                                        </div>
                                        <div class="form-group">
                                            <label for="province">Province<span style="color:red">*</span></label>
                                            <select class="form-control" name="province" id="province" required>
                                                <option value="" class="text-center">--- Select Province ---</option>
                                                <option value="Eastern Cape">Eastern Cape</option>
                                                <option value="Free State">Free State</option>
                                                <option value="Gauteng">Gauteng</option>
                                                <option value="KwaZulu-Natal">KwaZulu-Natal</option>
                                                <option value="Limpopo">Limpopo</option>
                                                <option value="Mpumalanga">Mpumalanga</option>
                                                <option value="Northern Cape">Northern Cape</option>
                                                <option value="North West">North West</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address<span style="color:red">*</span></label>
                                            <textarea class="form-control" id="address" name="address" style="resize:none" rows="4" cols="53" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg-password">Password<span style="color:red">*</span></label>
                                            <input type="password" name="reg-password" id="reg-password" class="form-control" placeholder="Password" minlength="8" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="retype-password">Confirm Password<span style="color:red">*</span></label>
                                            <input type="password" name="retype-password" id="retype-password" class="form-control" placeholder="Confirm Password" minlength="8" required>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="checkbox" onclick="showPass()"> Show Password
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button type="submit" name="register" class="btn btn-info btn-block">Register</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($success) && $success) { ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <?= $success_msg ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php }
                                    ?>
                                    <?php
                                    if (isset($error_reg) && $error_reg) {
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= $error_msg_reg ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php }
                                    ?>
                                    <br><br><br><br>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <br><br>
                                <div class="logo mb-3">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="email">Email<span style="color:red">*</span></label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button type="submit" name="reset" class="btn btn-info btn-block">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form><br><br><br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script>
            function previewFile(input) {
                let file = $("input[type=file]").get(0).files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function() {
                        $("#previewImg").attr("src", reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            }
        </script>
        <script type="text/javascript">
            function showPassL() {
                let x = document.getElementById("password-login");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }

            function showPass() {
                let x = document.getElementById("reg-password");
                let s = document.getElementById("retype-password");
                if (x.type === "password") {
                    x.type = "text";
                    s.type = "text";
                } else {
                    x.type = "password";
                    s.type = "password";
                }
            }
        </script>
        <?php include('../inc/footer.php'); ?>