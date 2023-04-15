<?php
global $con;
include_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/s.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Online-cars</title>
</head>
<body>
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <h2>Online-<em>Cars</em></h2>
                </a>
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
                            <div class="dropdown dropdown-hover">
                                <a class="nav-link" data-bs-toggle="dropdown" aria-expanded="false" href="#"> Login </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="admin/login_reg.php">Admin</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="customer/login_reg.php">Customer</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Company</a>
                                    </li>
                                </ul>
                            </div>
                    </ul>
                </div>
        </nav>
    </header>
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
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
    <div class="latest-products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Latest Cars</h2>
                        <a href="#">view all products <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <?php
                include_once 'config.php';

                $sql  = "SELECT * FROM car";
                $result = mysqli_query($con, $sql);
                $check = mysqli_num_rows($result);

                if ($check > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row['car_name'];
                        $car_type = $row['car_type'];
                        $car_color = $row['car_color'];
                        $year = $row['car_year'];
                        $car_description = $row['car_description'];
                        $car_mileage = $row['car_mileage'];
                        $price = $row['car_price'];
                        $car_image = $row['car_image'];
                        $car_quantity = $row['car_quantity'];
                        $company_id = $row['company_id'];
                        $added_date = $row['added_date'];

                        ?>
                        <div class="col-md-4">
                            <div class="product-item">
                                <div class="card" style="min-width: 18rem; ">
                                    <img class="card-img-top" style="height:350px;" src="<?php echo "company/img/Cars/" . $car_image; ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $name ?></h5>
                                        <h6>Year :<?php echo $year ?></h6><br>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<h1 style='color:red;size:25px; text-align:center;'></h1>
                        <br>
                           <br>
      ";
                    echo "<h1><a href='index.php'></a><h1>";
                }
                ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            // Add hover action for dropdowns
            let dropdown_hover = $(".dropdown-hover");
            dropdown_hover.on('mouseover', function() {
                let menu = $(this).find('.dropdown-menu'),
                    toggle = $(this).find('.dropdown-toggle');
                menu.addClass('show');
                toggle.addClass('show').attr('aria-expanded', true);
            });
            dropdown_hover.on('mouseout', function() {
                let menu = $(this).find('.dropdown-menu'),
                    toggle = $(this).find('.dropdown-toggle');
                menu.removeClass('show');
                toggle.removeClass('show').attr('aria-expanded', false);
            });
        });
    </script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/css/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>