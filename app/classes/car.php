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
        $sqlQuery .= " ORDER BY price;";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        $totalResult = mysqli_num_rows($result);
        $searchResultHTML = '';
        if($totalResult > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $searchResultHTML .= '
        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="product">
                <a href="car-view.php?id=' . $row['id'] . '">
                    <img src="../assets/images/cars/' . $row['image'] . '" alt="" style="width: 100%; height: 200px;">
                </a>
                <p style="text-align:center;" class="car"><strong><a  href="car-view.php?id=' . $row['id'] . '">' . $row['maker'] . ' ' . $row['model'] . ' ' . $row['year'] . '</a></strong></p>
                <p style="text-align:center;" class="text-danger">' . $row['currency'] . ' ' . number_format($row['price'], 2, ',', ' ') . '</p>
                <p style="text-align:center;"><a href="' . $row['url'] . '">' . $row['company_name'] . '</a></p>
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

