<?php
global $conn;
include('config.php');
$limit = 6;
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;

$sql = "SELECT * FROM car ORDER BY date_created DESC LIMIT $start_from, $limit";
$rs_result = mysqli_query($conn, $sql);
?>

<div class="row justify-content-center mb-3">
    <?php while ($row = mysqli_fetch_assoc($rs_result)) {
        $name = $row['maker'];
        $model = $row['model'];
        $description = $row['description'];
        $photo = "assets/images/cars/" . $row['image'];
        $url = $row['url'];
        $price =  $row['price'];
        $currency = $row['currency'];
        $company_name = $row['company_name'];
        $id = $row['id'];
    ?>
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="card h-100 w-100">
                <a href='<?php echo ("customer/car-view.php?id=" . $id); ?>'><img class="card-img-top" height="250" src="<?php echo ($photo); ?>" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title"><?php echo ($name . ' ' . $model) ?></h4>
                    <h5 class="text-danger"><?php echo ($currency . ' ' . number_format($price, 2, ',', ' ')); ?></h5>
                    <p class="card-text"><?php echo $description; ?></p>
                </div>
                <div class="card-footer">
                    <a href='<?php echo ($url); ?>'> <?php echo ($company_name); ?></a>
                </div>
            </div>
        </div>
    <?php }; ?>
</div>