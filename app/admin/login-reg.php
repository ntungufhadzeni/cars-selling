<?php
session_start();
global $conn;
require('../config.php');

if (isset($_POST['login'])) {
    $error_login = false;
    $error_msg_login = '';
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        if (!empty($email) and !empty($password)) {

            $sql = "SELECT * FROM admin WHERE email='$email';";
            $result = mysqli_query($conn, $sql);
            $nor = mysqli_num_rows($result);

            if ($nor > 0) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['password'])) {
                    $_SESSION['admin_logged'] = true;
                    $_SESSION['admin_id'] = $row['id'];
                    $_SESSION['admin_name'] = $row['first_name'];
                    header('location:all-customers.php');
                } else {
                    $error_login = true;
                    $error_msg_login = 'Wrong password';
                }
            } else {
                $error_login = true;
                $error_msg_login = 'Email not recognized';
            }
        }
    } else {
        $error_login = true;
        $error_msg_login = 'Email and password are required';
    }
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Online-Cars</title>
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
                                    <a class="dropdown-item" href="login-reg.php">Admin</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../customer/login-reg.php">Customer</a>
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
                                <h4>Admin Panel</h4>
                                <br>
                            </div>
                        </div>
                                <div class="logo mb-3">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="email-login">Email<span style="color:red">*</span></label>
                                            <label for="Email"></label><input type="email" name="email" id="email-login" class="form-control" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="Email" required>
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
                </div>
            </div>
        </div>
    </div>
        <script type="text/javascript">
            function showPassL() {
                let x = document.getElementById("password-login");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
function checkPasswordMatch() {
    let password1 = document.getElementById("reg-password").value;
    let password2 = document.getElementById("retype-password").value;

    if (password1 != password2) {
        document.getElementById("retype-password").setCustomValidity("Passwords do not match");
    } else {
        document.getElementById("retype-password").setCustomValidity("");
    }
}
</script>
<script>
function checkPasswordPattern() {
    let password = document.getElementById("reg-password").value;

    if (password.match(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#$&*~]).{8,}$/)) {
        document.getElementById("reg-password").setCustomValidity("");
    } else {
        document.getElementById("reg-password").setCustomValidity("Password must be 8 characters long and include at least 1 uppercase, lowercase, numeric number, special character");
    }
}
</script>
<?php include('../inc/footer.php'); ?>