<?php
global $conn;
require('../config.php');
session_start();
if($_POST['action'] == 'login'){
    $email= htmlspecialchars($_POST['email']);
    $password= htmlspecialchars($_POST['password']);

    if(!empty($email) AND !empty($password)) {
        $sql = "SELECT * FROM customer WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $nor = mysqli_num_rows($result);

        if ($nor > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                if($row['status'] == 1) {
                    $_SESSION['admin_logged'] = false;
                    $_SESSION['customer_id'] = $row['id'];
                    $_SESSION['customer_name'] = $row['first_name'];
                    $error_msg = 'Welcome! '. $row['first_name'];
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            ' . $error_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                }
                else {
                    $error_msg = 'Your account has been suspended';
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                }
            } else {
                $error_msg = 'Wrong password';
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            }
        } else {
            $error_msg = 'Email not recognized';
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        }
    }
}
