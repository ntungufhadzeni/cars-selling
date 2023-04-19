<?php
global $con;
require('../config.php');
session_start();
$vid=$_SESSION['vid'];
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
                if($row['customer_status'] == 1) {
                    $_SESSION['admin_logged'] = false;
                    $_SESSION['customer_id'] = $row['customer_id'];
                    $_SESSION['customer_name'] = $row['customer_name'];

                    header('location: car_view.php?id='.$vid);
                }
                else {
                    $error_login= true;
                    $error_msg_login = 'Your account has been suspended';
                }
            } else {
                $error_login = true;
                $error_msg_login = 'Password wrong';
            }
        } else {
            $error_login= true;
            $error_msg_login = 'Email not recognized';
        }
    }
}
