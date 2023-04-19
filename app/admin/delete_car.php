<?php
global $con;
require('../config.php');
$vid=$_GET['id'];
$sql = 'DELETE FROM car WHERE car_id='.$vid;
$result = mysqli_query($con, $sql);
header('location:index.php');
