<?php

$db_host = 'db';
$db_name = 'MYSQL_DATABASE';
$db_user = 'MYSQL_USER';
$db_pass = 'MYSQL_PASSWORD';
$port = 3306;

$conn = new mysqli($db_host,$db_user,$db_pass,$db_name, $port);
if($conn->connect_error){
    die('Error failed to connect to MySQL: ' . $conn->connect_error);
}


