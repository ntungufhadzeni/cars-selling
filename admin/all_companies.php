<?php
session_start();
$name = '';
if(isset($_SESSION['admin_name'])){
    $name = $_SESSION['admin_name'];
    $id = $_SESSION['admin_id'];
}
else{
    header('location: login_reg.php');
}
?>

<?php
global $con;
include_once '../config.php';


$sql = "SELECT * FROM company";
$result = mysqli_query($con,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/s.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <script src="../assets/dis/jquery.simplePagination.js"></script>
    <link rel="stylesheet" href="../assets/dis/simplePagination.css" />
    <link rel="stylesheet" href="../assets/css/style_search.css">
    <script src="../assets/js/search.js"></script>
    <title>Online-cars</title>
</head>
<body>
<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php"><h2><em><?php echo $name ?></em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="all_customers.php"> Customers
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="all_companies.php"> Companies
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="orders.php"> Orders
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="all_company_admin.php"> Company Admin
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                </ul>
            </div>
    </nav>
</header>
<div class="banner header-text">
    <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
            <div class="text-content">
                <!-- <h4>Online-Cars</h4> -->
                <h2 style="color:white;">Online-Cars</h2>
            </div>
        </div>
        <div class="banner-item-02">
            <div class="text-content">

            </div>
        </div>
        <div class="banner-item-03">
            <div class="text-content">
                <h4>Last Minute</h4>
                <h2>Grab last minute deals</h2>
            </div>
        </div>
    </div>
</div>
<div style="margin-bottom: 50px;"></div>
<div  class="row">
    <div class="col-md-2"></div>
    <div class="col-md-2">
        <a href="add_company_form.php" class="btn btn-info btn-block">Add a Company </a>
    </div>
</div>
<div class="container" style=" margin-top:90px;">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>
                ID
            </th>
            <th>
                Name
            </th>
            <th>
                Country
            </th>
            <th>
                Currency
            </th>
            <th>
                Website
            </th>
            <th>
                Company Status
            </th>
            <th>
                Action
            </th>
        </tr>
        </thead>
        <?php
        if(mysqli_num_rows($result)){
            while($row = mysqli_fetch_assoc($result)){


                ?>
                <tr>
                    <th scope="row">
                        <?php echo($row['company_id']); ?>
                    </th>
                    <td>
                        <?php echo($row['company_name']); ?>
                    </td>
                    <td>
                        <?php echo($row['company_country']); ?>
                    </td>
                    <td>
                        <?php echo($row['company_currency']); ?>
                    </td>
                    <td>
                        <?php echo($row['company_url']); ?>
                    </td>
                    <td>
                        <?php
                        if($row['company_status'] == 1){
                            echo "<font color='green'>Company Activated</font>";
                        }else{
                            echo "<font color='red'>Company Deactivated</font>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $id = $row['company_id'];
                        if($row['company_status'] == 1){
                            echo('<a href="deactivate_company.php?id='.$id.'><button class="btn btn-primary">Deactivate</button></a>');
                        }else{
                            echo('<a href="activate_company.php?id='.$id.'><button class="btn btn-primary">Activate</button></a>');
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
<script
    src="https://www.bootstrapskins.com/google-maps-authorization.js?id=1c150919-c678-1a10-c97a-f597084f6f83&c=google-maps-code&u=1450373278" defer async>
</script>
<?php include('../inc/footer.php');?>
