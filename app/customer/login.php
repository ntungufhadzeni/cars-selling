<?php
global $conn;
require('../config.php');
session_start();
$id=$_SESSION['id'];
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email= htmlspecialchars($_POST['email']);
    $password= htmlspecialchars($_POST['password']);

    if(!empty($email) AND !empty($password)) {
        $sql = "SELECT * FROM customer WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $nor = mysqli_num_rows($result);

        if ($nor > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                if($row['customer_status'] == 1) {
                    $_SESSION['admin_logged'] = false;
                    $_SESSION['customer_id'] = $row['id'];
                    $_SESSION['customer_name'] = $row['first_name'];

                    header('location: car_view.php?id='.$id);
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
