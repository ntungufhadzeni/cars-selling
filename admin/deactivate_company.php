<?php
session_start();
global $con;
require('../config.php');
if(isset($_SESSION['admin_name'])){
    $id = $_GET['id'];
    $sql = 'UPDATE company SET company_status=0 WHERE company_id='.$id;
    $result = mysqli_query($con, $sql);
    header('location: all_companies.php');

}
else{
    header('location: login_reg.php');
}
