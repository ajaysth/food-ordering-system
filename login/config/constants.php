<?php
 

//  session starts
if(!isset($_SESSION)){
 session_start();
}


 //create constants to store non repeatingvalues
 define('SITEURL','http://localhost/foodaj/');
 define('LOCALHOST','localhost');
 define('DB_USERNAME','root');
 define('DB_PASSWORD','');
 define('DB_NAME','food-order');
 $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error()); //database connection
 $db_select=mysqli_select_db($conn , 'food-order')or die(mysqli_error());

?>