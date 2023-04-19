<?php

class Car
{
    private $host = 'db';
    private $user = 'root';
    private $password = 'Nnrrr@123';
    private $carTable = 'car';

    private $database = "car";
    private $dbConnect = false;

    public function __construct(){
        if(!$this->dbConnect){
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die('Error failed to connect to MySQL: ' . $conn->connect_error);
            } else {
                $this->dbConnect = $conn;
            }
        }
    }

    public function getMake(){
        $sqlQuery = "SELECT DISTINCT car_make FROM ".$this->carTable;
        $result = mysqli_query($this->dbConnect, $sqlQuery);

        $makes = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $makes[] = $row['car_make'];
        }

        return $makes;
    }

    public function searchCars(){
        $sqlQuery = "SELECT * FROM ".$this->carTable.' JOIN company ON car.company_id = company.company_id ';
        if(isset($_POST["minPrice"], $_POST["maxPrice"]) &&
            !empty($_POST["minPrice"]) && !empty($_POST["maxPrice"])){
            $minPrice = (int) $_POST["minPrice"];
            $maxPrice = (int) $_POST["maxPrice"];
            $sqlQuery .= "
		WHERE car_price BETWEEN ".$minPrice." AND ".$maxPrice;
        }
        if(isset($_POST["make"])) {
            $makeFilterData = implode("','", $_POST["make"]);
            $sqlQuery .= "
		AND car_make IN('".$makeFilterData."')";
        }
        /*if(isset($_POST["model"])){
            $modelFilterData = implode("','", $_POST["model"]);
            $sqlQuery .= "
		AND car_model IN('".$modelFilterData."')";
        }*/
        if(isset($_POST["year"])) {
            $yearFilterData = implode(",", $_POST["year"]);
            $sqlQuery .= "
		AND car_year IN('".$yearFilterData."')";
        }
        $sqlQuery .= " ORDER By car_price;";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        $totalResult = mysqli_num_rows($result);
        $searchResultHTML = '';
        if($totalResult > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $searchResultHTML .= '
			<div class="col-sm-4 col-lg-3 col-md-3">
			<div class="product">
			<img src="../assets/images/cars/'. $row['car_image'] .'" 
alt="" class="img-responsive" >
			<p><strong><a 
href="car_view.php?id='.$row['car_id'].'">'.$row['car_make'].' '. $row['car_model'] .'</a></strong></p>
			<h4 style="text-align:center;" class="text-danger" 
>'. $row['car_price'] .'</h4>
            <a href='.$row['company_url'].'>'.$row['company_name'].'</a>
			<p>Make : '. $row['car_make'].'<br />
			Model : '. $row['car_model'] .' <br />
			Price : '. $row['company_currency'].' '.$row['car_price'] .'<br />
			Year : '. $row['car_year'] .'</p>
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
        $sqlQuery = "SELECT DISTINCT car_model FROM ".$this->carTable;
        $result = mysqli_query($this->dbConnect, $sqlQuery);

        $models = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $models[] = $row['car_model'];
        }

        return $models;
    }

    public function getYear()
    {
        $sqlQuery = "SELECT DISTINCT car_year FROM ".$this->carTable;
        $result = mysqli_query($this->dbConnect, $sqlQuery);

        $years = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $years[] = $row['car_year'];
        }

        return $years;
    }
}

?>