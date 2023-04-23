<?php
global $conn;
require('../config.php');
$vid=$_GET['vid'];
$sql = 'DELETE FROM car WHERE id='.$vid;
$result = mysqli_query($conn, $sql);
header('location:all_cars.php');
