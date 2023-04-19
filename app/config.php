<?php
$server = "db";
$user = "root";
$pass = "Nnrrr@123";
$db = "car";

$con = mysqli_connect($server,$user,$pass, $db);
if(!$con){
    die("Connection Error....!".mysqli_connect_error());
}



