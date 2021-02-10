<?php 

$server ="localhost";
$username ="root";
$password = "";
$database  = "blog1";

$conn = mysqli_connect($server, $username, $password, $database);

if(!$conn) { // If check Connection
	die("<script>alert('Connection Failed.')<?script");
}


?>