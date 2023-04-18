<?php
session_start();
include '../classes/car.php';
$car = new Car();
if(isset($_POST["action"])){
    $html = $car->searchCars($_POST);
    $data = array("html" => $html,);
    #echo json_encode($data);
    echo $html;
}

