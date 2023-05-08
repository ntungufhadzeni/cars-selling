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
        $price = $row['price'];
        $year = $row['year'];
        $transmission = $row['transmission'];
        $fuel = $row['fuel'];
        $currency = $row['currency'];
        $mileage = number_format($row['mileage'], 0, ',', ' ');
        $price_f = $currency . ' ' . number_format($price, 2, ',', ' ');
        if ($currency != 'R') {
            $price_f = $currency . ' ' . number_format($price, 2, ',', ' ') . ' (R ' . number_format($price * 18.09, 2, ',', ' ') . ')';
        }
        $company_name = $row['company_name'];
        $id = $row['id'];
        ?>
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="car-container">
                <div class="car-card">
                    <a href='<?php echo ("customer/car-view.php?id=" . $id); ?>'><img class="car-img"
                            src="<?php echo ($photo); ?>" alt="<?php echo ($name . ' ' . $model) ?>"></a>
                    <div class="card__details">
                        <span class="tag">
                            <?php echo ($company_name); ?>
                        </span>
                        <span class="tag"><?php echo ($mileage); ?> km</span>
                        <span class="tag"><?php echo ($year); ?></span>
                        <span class="tag"><?php echo ($fuel); ?></span>
                        <span class="tag"><?php echo ($transmission); ?>
                            </span>
                                        <div class="car-name">
                            <?php echo ($name . ' ' . $model) ?>
                        </div>
                        <h5 class="text-danger">
                            <?php echo ($price_f); ?>
                        </h5>
                        <p class="car-p">
                            <?php echo $description; ?>
                        </p><br>
                        <div>
                            <a class="car-button" href='<?php echo ($url); ?>'>Find out more</a>
                            <a class="car-button" href='<?php echo ("customer/car-view.php?id=" . $id); ?>'>Buy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    ; ?>
</div>