<?php
global $conn;
require('../config.php');

if (isset($_POST['action']) == 'password') {
    $old_password = htmlspecialchars($_POST['old-password']);
    $new_password = htmlspecialchars($_POST['new-password']);
    $retype_password = htmlspecialchars($_POST['retype-password']);
    $id = htmlspecialchars($_POST['customer-id']);

    if (!empty($old_password) and !empty($new_password) and !empty($retype_password)) {

        if (preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#\$&*~]).{8,}$/", $new_password)) {
            if ($retype_password == $new_password) {
                if ($old_password != $new_password) {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $sql = "SELECT * FROM customer WHERE id = '$id'";
                    $result = mysqli_query($conn, $sql);

                    $row = mysqli_fetch_assoc($result);
                    if (password_verify($old_password, $row['password'])) {
                        $sql = "UPDATE customer SET password = '$hashed_password' WHERE id = '$id'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $error_card_msg = "Password Changed Successfully";
                            $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                            echo $msg;
                        } else {
                            $error_card_msg = "Password Change Failed";
                            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                            echo $msg;
                        }
                    } else {
                        $error_card_msg = "Old Password Doesn't Match!";
                        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                        echo $msg;
                    }
                } else {
                    $error_card_msg =
                        "You have already used the password. Enter new password";
                    $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                    echo $msg;
                }
            } else {
                $error_card_msg =
                    "Passwords don't match";
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
                echo $msg;
            }
        } else {
            $error_card_msg =
                "Password must be 8 characters long and include at least 1 uppercase, lowercase, numeric number, special character";
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            echo $msg;
        }
    } else {
        $error_card_msg = 'All fields required';
        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $error_card_msg . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        echo $msg;
    }
}
