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
        WHERE price BETWEEN ".$minPrice." AND ".$maxPrice;
        }
        if(isset($_POST["make"])) {
            $makeFilterData = implode("','", $_POST["make"]);
            $sqlQuery .= "
        AND maker IN('".$makeFilterData."')";
        }
        if(isset($_POST["year"])) {
            $yearFilterData = implode(",", $_POST["year"]);
            $sqlQuery .= "
        AND year IN(".$yearFilterData.")";
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
			<div class="col-sm-4 col-lg-3 col-md-3">
			<div class="product">
			<img src="../assets/images/cars/'. $row['image'] .'" 
alt="" class="img-responsive" >
			<p><strong><a 
href="car_view.php?id='.$row['id'].'">'.$row['maker'].' '. $row['model'] .'</a></strong></p>
			<h4 style="text-align:center;" class="text-danger" 
>'. $row['currency'].' '. number_format($row['price'], 2, ',', ' ') .'</h4>
            <a href='.$row['url'].'>'.$row['company_name'].'</a>
			<p>Maker : '. $row['maker'].'<br />
			Model : '. $row['model'] .' <br />
			Year : '. $row['year'] .'</p>
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

    public function getYear()
    {
        $sqlQuery = "SELECT DISTINCT year FROM ".$this->carTable;
        $result = mysqli_query($this->dbConnect, $sqlQuery);

        $years = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $years[] = $row['year'];
        }

        return $years;
    }
}

