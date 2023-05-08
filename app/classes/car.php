<?php

class Car
{
    private $server = "db";
    private $user = "MYSQL_USER";
    private $password = "MYSQL_PASSWORD";
    private $port = 3306;
    private $database = "MYSQL_DATABASE";

    private $dbConnect = false;

    private $carTable = '`car`';

    public function __construct(){
        if(!$this->dbConnect){
            $conn = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
            if($conn->connect_error){
                die('Error failed to connect to MySQL: ' . $conn->connect_error);
            } else {
                $this->dbConnect = $conn;
            }
        }
    }

    public function getMake(){
        $sqlQuery = "SELECT DISTINCT maker FROM ".$this->carTable;
        $result = mysqli_query($this->dbConnect, $sqlQuery);

        $makes = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $makes[] = $row['maker'];
        }

        return $makes;
    }

    public function searchCars(){
        $sqlQuery = "SELECT * FROM ".$this->carTable;
        if(!empty($_POST["minPrice"]) && !empty($_POST["maxPrice"])){
            $minPrice = (int) $_POST["minPrice"];
            $maxPrice = (int) $_POST["maxPrice"];
            $sqlQuery .= "
        WHERE ((price BETWEEN ".$minPrice." AND ".$maxPrice." AND currency = 'R')";
            $sqlQuery .= " OR (price BETWEEN " . $minPrice/18.09 . " AND " . $maxPrice/18.09 . " AND currency = '$'))";
        }
        if(isset($_POST["make"])) {
            $makeFilterData = implode("','", $_POST["make"]);
            $sqlQuery .= "
        AND maker IN('".$makeFilterData."')";
        }
        if(!empty($_POST["minYear"]) && !empty($_POST["maxYear"])) {
            $minYear = (int) $_POST["minYear"];
            $maxYear = (int) $_POST["maxYear"];
            $sqlQuery .= "
        AND year BETWEEN ".$minYear." AND ".$maxYear;
        }
        if(isset($_POST["search"]) && $_POST["search"] != '') {
            $search = $_POST["search"];
            $sqlQuery .= "
        AND (LOWER(maker) LIKE '%".$search."%' OR LOWER(model) LIKE '%".$search."%')";
        }
        $sqlQuery .= " ORDER BY price ASC;";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        $totalResult = mysqli_num_rows($result);
        $searchResultHTML = '';
        if($totalResult > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $name = $row['maker'];
                $model = $row['model'];
                $description = $row['description'];
                $photo = "../assets/images/cars/" . $row['image'];
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
                $searchResultHTML .= '
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="car-container">
            <div class="car-card">
                <a href="car-view.php?id=' . $id . '"><img class="car-img" src="' . $photo . '" alt="' . $name . ' ' . $model . '"></a>
                <div class="card__details">
                    <span class="tag">' . $company_name . '</span>
                    <span class="tag">' . $mileage . ' km</span>
                    <span class="tag">' . $year . '</span>
                    <span class="tag">' . $fuel . '</span>
                    <span class="tag">' . $transmission . '</span>
                    <div class="car-name">' . $name . ' ' . $model . '</div>
                    <h5 class="text-danger">' . $price_f . '</h5>
                    <p class="car-p">' . $description . '</p><br>
                    <div>
                        <a class="car-button" href="' . $url . '">Find out more</a>
                        <a class="car-button" href="car-view.php?id=' . $id . '">Buy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>'; 
            }
        } else {
            $searchResultHTML = '<h3>No car found.</h3>';
        }
        return $searchResultHTML;
    }

    public function getModel()
    {
        $sqlQuery = "SELECT DISTINCT model FROM ".$this->carTable;
        $result = mysqli_query($this->dbConnect, $sqlQuery);

        $models = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $models[] = $row['model'];
        }

        return $models;
    }

    public function getYears()
    {
        $sqlQuery = "SELECT MIN(year) AS min_year, MAX(year) AS max_year FROM ".$this->carTable;
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $years = array(
            "min_year" => $row['min_year'],
            "max_year" => $row['max_year']
        );
        return $years;
    }
}

