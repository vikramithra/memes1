<?php 


require_once(__DIR__."/../../database/db.php");
include(__DIR__."/../../helpers/middleware.php");
include(__DIR__."/../../helpers/validateUser.php");

$table = 'users';

$admin_users = selectAll($table);


$errors = array();
$id = '';
$username = '';
$admin = '';
$email = '';
$password = '';
$passwordConf = '';


function loginUser($user) 
{
	$_SESSION['id'] = $user['id'];
	$_SESSION['username'] = $user['username'];
	$_SESSION['admin'] = $user['admin'];
	$_SESSION['message'] = 'You are now logged in';
	$_SESSION['type'] = 'success';

	if ($_SESSION['admin']) {
		header('location: ../../admin/dashboard.php');
	} else {
		header('Location: ../../index.php');
	}

	exit();
}


if (isset($_POST['register-btn']) || isset($_POST['create-admin'])) {
	// $errors = validateUser($_POST); 

	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$passwordConf = $_POST["passwordConf"];

	if (strlen($username) < 5) {
		echo "Username cant be less then 5" ;
		die();
	}

	if (strlen($password) < 4) {
		echo "Password must be less then 4";
		die();
	}

	if ($password != $passwordConf) {
		echo "Password and conf must be same";
		die();
	}

	$query = "INSERT INTO users (username, email, password) VALUES (?,?,?)";
	$stmt = $conn -> stmt_init();

	if (!$stmt -> prepare($query)) {
		echo "connection error";
		die();
	}

	$hash_password = password_hash($password, PASSWORD_DEFAULT);
	$stmt -> bind_param("sss", $username, $email, $hash_password);
	$stmt ->execute();
	header( "Location: /");
	
}

	if(isset($_POST['update-user'])) {
		$username = mysqli_real_escape_string($_POST['username']);
		$email = mysqli_real_escape_string($_POST['email']);
		$password = mysqli_real_escape_string($_POST['password']);
		$passwordConf = mysqli_real_escape_string($_POST['passwordConf']);
		$username = mysqli_real_escape_string($_POST['username']);

		mysqli_query($conn, "UPDATE info SET username='$username', email='$email' password='$password' passwordConf='$passwordConf' WHERE id=$id");
		$_SESSION['msg'] = "Address updated";
		header('Location: /');
	}

	// adminOnly();
	// $errors = validateUser($_POST); 

	// if (count($errors) === 0 ) {
	// 	$id = $_POST['id'];
	// 	unset($_POST['passwordConf'], $_POST['update-user'], $_POST['id']);
	// 	$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

	// 	$_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
	// 	$count = update($table, $id, $_POST);
	// 	$_SESSION['message'] = "Admin user created ";
	// 	$_SESSION['type'] = "success";
	// 	header('Location: ../../admin/users/index.php');
	// 	exit();	
	// } else {
	// 	$username = $_POST['username'];
	// 	$admin = isset($_POST['admin']) ? 1 : 0;
	// 	$email =$_POST['email'];
	// 	$password = $_POST['password'];
	// 	$passwordConf = $_POST['passwordConf'];
	//



if (isset($_GET['delete_id'])) {
	$query = "DELETE FROM `users` WHERE `users`.`id` = ?";
	$stmt = $conn -> stmt_init();
	if (!$stmt->prepare($query)) {
		echo "error";
		die();
	}
	$stmt -> bind_param("i", $_GET["delete_id"]);
	$stmt->execute();
	$_SESSION['message'] = 'Admin deleted a user';
	$_SESSION['type'] = "success"; 
	header('Location: ../../admin/users/index.php');
	exit();
}