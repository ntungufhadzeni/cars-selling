<?php
global $conn;
require('../config.php');
$id = $_GET['id'];
$sql = 'DELETE FROM debit_card WHERE id=' . $id;
$result = mysqli_query($conn, $sql);
header('location:profile.php');
