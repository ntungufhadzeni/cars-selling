<?php
global $con;
require('../config.php');
session_start();

if (isset($_POST['login'])) {
    $error_login = false;
    $error_msg_login = '';
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email= htmlspecialchars($_POST['email']);
        $password= htmlspecialchars($_POST['password']);

        if(!empty($email) AND !empty($password)) {

            $sql = "SELECT * FROM customer WHERE customer_email = '$email';";
            $result = mysqli_query($con, $sql);
            $nor = mysqli_num_rows($result);

            if ($nor > 0) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['password'])) {
                    #header('location:../admin/admin.php');
                    $_SESSION['admin_logged']=false;
                    $_SESSION['customer_id']= $result['customer_id'];
                    $_SESSION['customer_id_email']= $result['customer_email'];
                    echo "<script>alert('Welcome')</script>";
                    } else {
                        $error_login = true;
                        $error_msg_login = 'Password wrong';
                    }
                } else {
                    $error_login= true;
                    $error_msg_login = 'Email not recognized';
                }
            }
        } else {
            $error_login= true;
            $error_msg_login= 'Email and password are required';
        }

}

elseif (isset($_POST['register'])){
    $error_reg = false;
    $error_msg_reg = '';
    $success_msg = '';
    $success = false;
    $name = trim(mysqli_real_escape_string($con,$_POST['name']));
    $surname = trim(mysqli_real_escape_string($con,$_POST['surname']));
    $email = trim(mysqli_real_escape_string($con,$_POST['email']));
    $contact = trim(mysqli_real_escape_string($con,$_POST['contact']));
    $province = ucwords(trim(mysqli_real_escape_string($con,$_POST['province'])));
    $address = ucwords(trim(mysqli_real_escape_string($con,$_POST['address'])));
    $password = trim(mysqli_real_escape_string($con,$_POST['reg-password']));
    $retype_password = trim(mysqli_real_escape_string($con,$_POST['retype-password']));

    if(!empty($name)&&!empty($surname)&&!empty($email)&&!empty($contact)&&!empty($province)&&!empty($address)
        &&!empty($password)&&!empty($retype_password)){

        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            if(preg_match("/^0[1-9]\d{8}$/",$contact)){
                $x = strtolower($email);
                $sql ="SELECT * from  customer where  lower(customer_email) = '$x' or customer_contact = '$contact';";

                $result = mysqli_query($con,$sql);
                $nor = mysqli_num_rows($result);
                if($nor == 0) {
                    if(preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#\$&*~]).{8,}$/",$password)){
                    if ($retype_password == $password) {
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);;
                        $sql = "INSERT INTO customer(customer_name,customer_surname,customer_email,customer_contact,customer_address,customer_province,password)
                                                                                                   VALUES('$name','$surname','$email','$contact','$address','$province','$hashed_password')";
                        mysqli_query($con, $sql);
                        $success = true;
                        $error_reg = false;
                        $success_msg = "Customer registered successfully";
                        $_SESSION['msg_register'] = "register";
                    }
                    else{
                        $error_reg = true;
                        $error_msg_reg = "Passwords don't match";
                        $_SESSION['msg_register'] = "register";
                    }
                }
                    else{
                        $error_reg = true;
                        $error_msg_reg = "Password must be 8 characters long and include at least 1 uppercase, lowercase, numeric number, special character";
                        $_SESSION['msg_register'] = "register";
                    }
                }
                else{
                    $error_reg = true;
                    $error_msg_reg = 'Customer already exists. Reset password if you forgot it.';
                    $_SESSION['msg_register'] = "register";
                }
            }
            else{
                $error_reg = true;
                $error_msg_reg = 'Invalid phone number';
                $_SESSION['msg_register'] = "register";
            }
        }
        else{
            $error_reg = true;
            $error_msg_reg = 'Invalid email address';
            $_SESSION['msg_register'] = "register";
        }
    }
    else{
        $error_reg = true;
        $error_msg_reg = 'All fields are required';
        $_SESSION['msg_register'] = "register";
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
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/s.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
</head>
<body>
<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <h2>Online-<em>Cars</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <div class="dropdown dropdown-hover">
                        <a class="nav-link active" data-bs-toggle="dropdown" aria-expanded="false" href="#">Login</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="../admin/login_reg.php">Admin</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="login_reg.php">Customer</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Company</a>
                            </li>
                        </ul>
                    </div>
                </ul>
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
                            <a href="#"><img style="width:125px;height:100px; border-radius: 15px;" src= "../assets/images/1.jpg" class="img-responsive" alt=""></a>
                        </div>
                        <div style="padding-top:25px" class="col-md-6">
                            <h4>Customer Panel</h4>
                            <br>
                        </div>
                    </div>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link <?php

                            if(!isset($_SESSION['msg_register'])){
                                echo "active";
                                $_SESSION['msg_register'] = "login";
                            }
                            elseif($_SESSION['msg_register'] == "login"){
                                echo "active";
                            }
                            ?>" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Login</a>
                            <a class="nav-item nav-link  <?php
                            if ($_SESSION['msg_register'] == "register")
                            {
                                echo "active";
                            }
                            ?>" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Register</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Forgot Password?</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade <?php

                        if($_SESSION['msg_register'] == "login"){
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
                                        <label for="password">Password<span style="color:red">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
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
                                if(isset($error_login) && $error_login){?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?=  $error_msg_login ?>
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
                        if ($_SESSION['msg_register'] == "register")
                        {
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
                                        <input type="text" name="name" id="name"  class="form-control"  placeholder="Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="surname">Surname<span style="color:red">*</span></label>
                                        <input type="text" name="surname" id="surname"  class="form-control"  placeholder="Surname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Email">Email<span style="color:red">*</span></label>
                                        <input type="email" name="email" id="Email"  class="form-control"  placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact">Contact<span style="color:red">*</span></label>
                                        <input type="text" name="contact" id="contact"  class="form-control"  placeholder="Contact" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="province">Province<span style="color:red">*</span></label>
                                        <select class="form-control form-control-lg" name="province" id="province" required>
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
                                        <textarea id="address" name="address" style="resize:none" rows="4" cols="53" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg-password">Password<span style="color:red">*</span></label>
                                        <input type="password" name="reg-password" id="reg-password"  class="form-control" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="retype-password">Confirm Password<span style="color:red">*</span></label>
                                        <input type="password" name="retype-password" id="retype-password"  class="form-control" placeholder="Confirm Password" required>
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
                                if(isset($success) && $success){?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?=  $success_msg ?>
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
                                        <label for="exampleInputEmail1">Email<span style="color:red">*</span></label>
                                        <input type="email" name="email" id="Email"  class="form-control"  placeholder="Email" required>
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
    <script>
        function previewFile(input){
            let file = $("input[type=file]").get(0).files[0];
            if(file){
                let reader = new FileReader();
                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script type="text/javascript">
        function showPassL() {
            let x = document.getElementById("passL");
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
                s.type ="password";
            }
        }
    </script>
    <script type="text/javascript">
        $('#myTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
    <script type="text/javascript">
        $('#myTab a[href="#profile"]').tab('show') // Select tab by name
        $('#myTab li:first-child a').tab('show') // Select first tab
        $('#myTab li:last-child a').tab('show') // Select last tab
        $('#myTab li:nth-child(3) a').tab('show') // Select third tab
    </script>
    <script src="../assets/jquery/jquery.min.js"></script>
    <script src="../assets/css/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/owl.js"></script>
    <script src="../assets/js/slick.js"></script>
    <script src="../assets/js/isotope.js"></script>
    <script src="../assets/js/accordions.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
