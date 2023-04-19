<?php
global $con;
require('../config.php');
session_start();
$name = '';
if(isset($_SESSION['admin_name'])){
    $name = $_SESSION['admin_name'];
    $id = $_SESSION['admin_id'];
}
else{
    header('location: login_reg.php');
}
function inputvalues($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name=inputvalues($_POST['name']);
$country= inputvalues($_POST['country']) ;
$url=inputvalues($_POST['url']);
$currency=inputvalues( $_POST['currency']);


$sql="insert into company(company_name,company_country,company_currency,company_url)";
$sql .=" values('$name','$country','$currency','$url')";

$result = mysqli_query($con, $sql);
if($result){
    $_SESSION['admin_company_msg']= "Company added successfully";
}
else{
    $_SESSION['admin_company_msg']= "Error adding company.";
}


}

header('location:add_company_form.php');

?>
