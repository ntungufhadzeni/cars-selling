<?php
session_start();
$name = '';
if(isset($_SESSION['admin_name'])){
    $name = $_SESSION['admin_name'];
    $id = $_SESSION['admin_id'];
}
else{
    header('location: login-reg.php');
}

global $conn;
require('../config.php');
$photo_name = '';
function inputvalues($data) {
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maker=inputvalues($_POST['maker']);
    $model= inputvalues($_POST['model']) ;
    $color=inputvalues($_POST['color']);
    $stockstatus=inputvalues( $_POST['stockstatus']);
    $year= (int) inputvalues($_POST['year']);
    $transmission=inputvalues($_POST['transmission']);
    $enginecapacity=inputvalues($_POST['enginecapacity']);
    $fuel=inputvalues($_POST['fuel']);
    $price=(int) inputvalues($_POST['price']);
    $description=inputvalues($_POST['description']);
    $mileage=inputvalues($_POST['mileage']);
    $type=inputvalues($_POST['type']);
    $company_name=inputvalues($_POST['company-name']);
    $country= inputvalues($_POST['country']) ;
    $url=inputvalues($_POST['url']);
    $currency=inputvalues( $_POST['currency']);
    $photo_name = preg_replace('/\s/i', '-', $maker."-".$model."-".$year."-".basename($_FILES['photo']['name']));
    $status=1;
    if($stockstatus=='Sold'){
        $status=0;
    }



    $sql="insert into car(maker,model,price,image,fuel,engine_capacity,";
    $sql .="description,color,mileage,status,transmission,type,year,company_name,country,url,currency)";
    $sql .=" values('$maker','$model','$price','$photo_name','$fuel','$enginecapacity','$description','$color','$mileage','$status',";
    $sql .="'$transmission','$type','$year','$company_name','$country','$url','$currency')";


    $result = mysqli_query($conn, $sql);
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

header('location:add-car-form.php');

