<?php
$server = "localhost";
$user = "ntungu";
$pass = "Nnrrr@123";
$port = 41062;
$db = "car";

$con = mysqli_connect($server,$user,$pass,$db,$port);
if(!$con){
    die("Connection Error....!".mysqli_connect_error());
}
?>


