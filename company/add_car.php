<?php

$photo_name = '';
session_start();
$name = '';
if(!isset($_SESSION['company_name'])){
    $name = $_SESSION['company_name'];
    $id = $_SESSION['company_id'];
}
else{
    header('location: login_reg.php');
}

global $con;
require('../config.php');
session_start();
function inputvalues($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make=inputvalues($_POST['maker']);
    $model= inputvalues($_POST['model']) ;
    $color=inputvalues($_POST['color']);
    $stockstatus=inputvalues( $_POST['stockstatus']);
    $year=inputvalues($_POST['year']);
    $transmission=inputvalues($_POST['transmission']);
    $enginecapacity=inputvalues($_POST['enginecapacity']);
    $fuel=inputvalues($_POST['fuel']);
    $company=$_SESSION['company_id'];
    $price=inputvalues($_POST['price']);
    $description=inputvalues($_POST['description']);
    $mileage=inputvalues($_POST['mileage']);
    $type=inputvalues($_POST['type']);
    $photo_name = $make."-".$model."-".$year.".".$_FILES['photo']['name'];
    $status=1;
    if($stockstatus=='Sold'){
        $status=0;
    }



    $sql="insert into car(car_make,car_model,car_price,car_image,car_fuel,car_engine_capacity,";
    $sql .="car_description,car_color,car_mileage,company_id,car_status,car_transmission,car_type,car_year)";
    $sql .=" values('$make','$model','$price','$photo_name','$fuel','$enginecapacity','$description','$color','$mileage','$company','$status',";
    $sql .="'$transmission','$type','$year')";

    $result = mysqli_query($con, $sql);
    if($result){
        $_SESSION['admin_car_msg'] = "Car added successfully";
    }
    else{
        $_SESSION['admin_car_msg'] = "Error adding car.";
    }




}

error_reporting(0);

//File Extension
$sFileExt=$_FILES['photo']['type'];
// File Size
$iFileSize=$_FILES['photo']['size'];
$dFileSizeKByte=$iFileSize/1024;

if($dFileSizeKByte<=2048)
{
    // File Extension array
    $arrFilesExtension=array("image/jpeg","image/jpg","image/png","image/GIF","image/bmp");
    // Check File type in given array
    if(in_array($sFileExt,$arrFilesExtension))
    {
        // Make the file path
        $photo="../assets/images/cars/".$photo_name;
        // Upload the File on desired location
        move_uploaded_file($_FILES['photo']['tmp_name'],$photo);


    }
    else
    {
        echo("File extension invalid");
    }
}
else
{
    echo("Maximum size 2MB allowed");
}

header('location:add_car_form.php');
?>
