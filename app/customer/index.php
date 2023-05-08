<?php
session_start();
$name = '';
if (isset($_SESSION['customer_name'])) {
    $name = $_SESSION['customer_name'];
} else {
    header('location: login-reg.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Online-cars</title>
</head>

<body>
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <h2>Hi, <em><?php echo $name ?></em></h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                            <a class="nav-link" href="profile.php"> Profile
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
        </div>
    </div>
    <div style="margin-bottom: 80px;"></div>
    <div class="container" style="min-height:500px;">
        <div class=''>
        </div>
        <div class="container">
            <?php
            include '../classes/car.php';
            $car = new Car();
            ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <h3>Search</h3>
                        <div class="list-group-item">
                            <input type="text" placeholder="Search a car" name="search-text-car" id="search-text-car">
                        </div>
                    </div>
                    <div class="list-group">
                        <h3>Price</h3>
                        <div class="list-group-item">
                            <input id="priceSlider" data-slider-id='ex1Slider' data-slider-min="20000" data-slider-max="2000000" data-slider-step="10000" data-slider-value="50000" />
                            <div class="priceRange">20000 - 2000000</div>
                            <input type="hidden" id="minPrice" value="20000" />
                            <input type="hidden" id="maxPrice" value="2000000" />
                        </div>
                    </div>
                    <div class="list-group">
                        <h3>Maker</h3>
                        <div class="brandSection">
                            <?php
                            $makes = $car->getMake();
                            foreach ($makes as $make) {
                            ?>
                                <div class="list-group-item checkbox">
                                    <label><input type="checkbox" class="productDetail make" name="make" value="<?php echo $make; ?>"> <?php echo $make; ?></label>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    <div class="list-group">
                        <h3>Year</h3>
                        <?php
                        $years = $car->getYears();
                        $min_year = $years['min_year'];
                        $max_year = $years['max_year'];
                        ?>
                        <div class="list-group-item">
                            <input id="yearSlider" data-slider-id='ex1Slider' data-slider-min="<?php echo ($min_year); ?>" data-slider-max="<?php echo ($max_year); ?>" data-slider-step="1" />
                            <div class="yearRange"><?php echo ($min_year . ' - ' . $max_year); ?> </div>
                            <input type="hidden" id="minYear" value="<?php echo ($min_year); ?>" />
                            <input type="hidden" id="maxYear" value="<?php echo ($max_year); ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row searchResult">
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>
<script src="../assets/js/search.js"></script>
        <?php include('../inc/footer.php'); ?>