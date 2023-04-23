<?php
session_start();
global $conn;
require('../config.php');
if(isset($_SESSION['admin_name'])){
    $id = (int) $_GET['id'];
    $sql = "UPDATE customer SET status=1 WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    header('location: all_customers.php');

}
else{
    header('location: login_reg.php');
}
