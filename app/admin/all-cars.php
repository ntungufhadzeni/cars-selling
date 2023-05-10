<?php
session_start();
$name = '';
global $conn;
include_once '../config.php';
if (isset($_SESSION['admin_name'])) {
    $name = $_SESSION['admin_name'];
    $id = $_SESSION['admin_id'];
    $sql = "SELECT * FROM car";
    $result = mysqli_query($conn, $sql);
} else {
    header('location: login-reg.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/search.js"></script>
    <title>Cars</title>
</head>

<body>
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <h2><em><?php echo $name ?></em></h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="all-customers.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="all-customers.php"> Customers
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="all-cars.php"> Cars
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="orders.php"> Orders
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
        </div>
    </div>
    <div style="margin-bottom: 50px;"></div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-2">
            <a href="add-car-form.php" class="btn btn-info btn-block">Add a Car </a>
        </div>
    </div>
    <div class="container" style=" margin-top:90px;">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {

            echo ('<div class="col-md-10 well" >');

            echo ('<div class="row">');

            echo ('<div class="col-md-2" >');
            echo ('<img class="img-circle" src="../assets/images/cars/' . $row['image'] . '" width="150px" height="120px">');
            echo ('</div>');

            echo ('<div class="col-md-3" >');
            echo ('<table  class="table table-striped">');
            echo ('<thead>');
            echo (' <tr>');
            echo ('<th> Stock#: </th>');
            echo ('<th>' . $row['id'] . '</th>');
            echo ('</tr>');
            echo ('</thead>');
            echo ('<tbody>');
            echo ('<tr>');
            echo ('<td>Maker:  </td>');
            echo ('<td>' . $row['maker'] . '</td>');

            echo ('</tr>');
            echo ('<tr>');
            echo ('<td>Model:</td>');
            echo ('<td>' . $row['model'] . '</td>');


            echo ('     </tr>');
            echo (' <tr>');
            echo ('<td>Year/Month:</td>');
            echo ('<td>' . $row['year'] . '</td>');
            echo ('</tr>');
            echo ('</tbody>');
            echo ('</table>');

            echo (' </div>');

            echo ('<div class="col-md-3">');

            echo (' <table class="table table-striped">');

            echo ('<tbody>');
            echo ('<thead>');
            echo ('<tr>');
            echo ('<td></td>');
            echo ('<td></td>');
            echo ('</tr>');
            echo ('<tr>');
            echo ('<td></td>');
            echo ('<td></td>');
            echo ('</tr>');
            echo ('</thead>');
            echo ('<tr>');
            echo ('<td>Engine: </td>');
            echo ('<td>' . $row['engine_capacity'] . '</td>');

            echo ('</tr>');
            echo ('<tr>');
            echo ('<td>Transmission:</td>');
            echo ('<td>' . $row['transmission'] . '</td>');


            echo ('</tr>');
            echo ('<tr>');
            echo ('<td>Color:</td>');
            echo ('<td>' . $row['color'] . '</td>');

            echo ('</tr>');

            echo ('</tbody>');
            echo ('</table>');
            echo ('</div>');

            echo ('<div class="col-md-2" >');
            echo ('<table  class="table table-striped">');
            echo ('<thead>');
            echo ('<tr>');
            echo ('<th align="center">&nbsp;   </th>');
            echo ('</tr>');
            echo ('</thead>');
            echo ('<tbody>');
            echo ('<tr>');
            echo ('<td align="center" > PRICE R </td>');
            echo ('</tr>');

            echo ('<tr> <td align="center"> ' . $row['price'] . ' </td> </tr>');
            echo ('<tr> <td align="center">&nbsp; </td> </tr>');
            echo ('<tr> <td> </td> </tr>');
            echo ('</tbody>');
            echo ('</table>');
            echo ('</div>');

            echo ('<div class="col-md-1"  >');

            echo (' <table  class="table table-striped">');
            echo ('<thead> ');
            echo ('<tr>');
            echo ('<th align="center">&nbsp; 
         </th>');
            echo ('</tr>');
            echo ('</thead>');
            echo ('<tbody>');
            echo ('<td >');
            echo ('<a href="delete-car.php?vid=' . $row['id'] . '" style="margin-top:10px;" class="btn  btn-danger"> Delete </a>');
            echo (' </td>');
            echo ('</tr>');
            echo ('<tr> <td>&nbsp;   </td> </tr>');

            echo ('</tbody>');
            echo ('</table>');
            echo ('</div>');

            echo ('</div>');
            echo ('</div>');
        }

        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <?php include('../inc/footer.php'); ?>