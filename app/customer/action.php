<?php
session_start();
include '../classes/car.php';
$car = new Car();
if(isset($_POST["action"])){
    $html = $car->searchCars($_POST);
    echo $html;
}

