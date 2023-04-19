<?php
session_start();
global $con;
require('../config.php');
if(isset($_SESSION['admin_name'])){
    $id = $_GET['id'];
    $sql = 'UPDATE company_admin SET status=1 WHERE id='.$id;
    $result = mysqli_query($con, $sql);
    header('location: all_company_admin.php');

}
else{
    header('location: login_reg.php');
}
