<?php
// start sesssion
session_start();

// create constants
define('SITEURL','http://localhost/food_order/ofos/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());//database connection
$db_select=mysqli_select_db($conn,'food-order') or die(mysqli_error() );// selecting database
?>