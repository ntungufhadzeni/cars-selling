<?php
session_start();
global $conn;
require('../config.php');
include '../classes/car.php';
if(isset($_POST["action"])){
    $car = new Car();
    $html = $car->searchCars($_POST);
    echo $html;
}
