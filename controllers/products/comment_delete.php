<?php 

session_start();
require_once(__DIR__."/../../database/db.php");
include(__DIR__."/../../helpers/middleware.php");
include(__DIR__."/../../helpers/validateUser.php");


// if (isset($_GET['delete_id'])) {
// 	$query = "DELETE FROM `comments` WHERE `comments`.`id` = ?";
// 	$stmt = $conn -> stmt_init();
// 	if (!$stmt->prepare($query)) {
// 		echo "error";
// 		die();
// 	}
// 	$stmt -> bind_param("i", $_GET["delete_id"]);
// 	$stmt->execute();
// 	$_SESSION['message'] = 'delete';
// 	$_SESSION['type'] = "success"; 
// 	header('Location: ../../admin/users/single.php');
// 	exit();
// } 


// if (isset($_GET['del'])) {
// 	$id = $_GET['del'];
// 	mysqli_query($db, "DELETE FROM info WHERE id=$id");
// 	$_SESSION['msg'] = "Address deleted";
// 	header('Location: /');
// }



// session_start();
// require_once(DIR."/../../database/db.php");
// include(DIR."/../../helpers/middleware.php");
// include(DIR."/../../helpers/validateUser.php");

    $id = intval($_GET['id']);



    $query = "DELETE FROM comments WHERE id = $id";
    $conn->query($query);



    $_SESSION['message'] = "Delete Successfull";
    header('Location: '.$_SERVER['HTTP_REFERER']);



?>