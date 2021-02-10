<?php  
session_start();
require_once(__DIR__."/../../database/db.php");
include(__DIR__."/../../helpers/middleware.php");
include(__DIR__."/../../helpers/validateUser.php");


	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT * FROM users WHERE username =?";

	$stmt = $conn -> stmt_init();

	if (!$stmt -> prepare($query)) {
		echo "connection error";
		die();
	}

	$stmt -> bind_param("s", $username);
	$stmt ->execute();
	$user = $stmt -> get_result() -> fetch_assoc();
		// var_dump($user);
		// die();
	$_SESSION["user_details"] = $user;
	if (!$user) {
		echo "user not found";
		die();
	}
	if (!password_verify($password, $user["password"])) {
		echo "wrong password";
		die();  
	}
	header("Location: /");

?>