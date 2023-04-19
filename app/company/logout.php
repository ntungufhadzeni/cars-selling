<?php
session_start();
unset($_SESSION['company_id']);
unset($_SESSION['company_name']);
header("location:login_reg.php");

