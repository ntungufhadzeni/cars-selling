<?php
session_start();
global $con;
require('../config.php');
if(isset($_SESSION['admin_name'])){
    $id = $_GET['id'];
    $sql = 'UPDATE customer SET customer_status=0 WHERE customer_id='.$id;
    $result = mysqli_query($con, $sql);
    header('location: all_customers.php');

}
else{
    header('location: login_reg.php');
}
