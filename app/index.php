<?php // include database connection
global $conn;
include('config.php');
$limit = 6;
//for total count data
$countSql = "SELECT COUNT(maker) FROM car";
$tot_result = mysqli_query($conn, $countSql);

$row = mysqli_fetch_row($tot_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
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
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-hover">
                            <a class="nav-link" href="#" data-bs-toggle="dropdown" aria-expanded="false">Login</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="admin/login-reg.php">Admin</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="customer/login-reg.php">Customer</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
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
    <div class="latest-products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Best Deals</h2>
                        <a href="customer/index.php">Find best deals<i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div id="target-content" class="clearfix"></div>
            <ul class="pagination" id="pagination">
                <?php if (!empty($total_pages)):
                    for ($i = 1; $i <= $total_pages; $i++):
                        if ($i == 1): ?>
                            <li class="page-item active" id="<?php echo $i; ?>"><a href="response.php?page=<?php echo $i; ?>"
                                    class="page-link"><?php echo $i; ?></a></li>
                        <?php else: ?>
                            <li id="<?php echo $i; ?>" class="page-item"><a href="response.php?page=<?php echo $i; ?>"
                                    class="page-link"><?php echo $i; ?></a></li>
                        <?php endif; ?>
                    <?php endfor;
                endif; ?>
            </ul>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <script
                src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    // Add hover action for dropdowns
                    let dropdown_hover = $(".dropdown-hover");
                    dropdown_hover.on('mouseover', function () {
                        let menu = $(this).find('.dropdown-menu'),
                            toggle = $(this).find('.dropdown-toggle');
                        menu.addClass('show');
                        toggle.addClass('show').attr('aria-expanded', true);
                    });
                    dropdown_hover.on('mouseout', function () {
                        let menu = $(this).find('.dropdown-menu'),
                            toggle = $(this).find('.dropdown-toggle');
                        menu.removeClass('show');
                        toggle.removeClass('show').attr('aria-expanded', false);
                    });
                });
            </script>
            <script>
                jQuery("#pagination li").on('click', function (e) {
                    e.preventDefault();
                    jQuery("#target-content").html('loading...');
                    jQuery("#pagination li").removeClass('active');
                    jQuery(this).addClass('active');
                    var pageNum = this.id;
                    jQuery("#target-content").load("response.php?page=" + pageNum);
                });
            </script>
            <style type="text/css">
                .card {
                    height: 260px;
                    width: 20%;
                    margin-top: 10px;
                    margin-right: 10px;
                    float: left
                }

                .page-container {
                    margin-top: 20px;
                }

                .fifty-chars {
                    white-space: nowrap;
                    width: 50ch;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }
            </style>
            <script type="text/javascript">
                $(document).ready(function () {
                    jQuery("#target-content").load("response.php?page=1");
                })
            </script>
            <?php include('inc/footer.php'); ?>