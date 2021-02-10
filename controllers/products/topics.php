<?php 

require_once(__DIR__."/../../database/db.php");
include(__DIR__."/../../helpers/middleware.php");
include(__DIR__."/../../helpers/validateUser.php");


$table = 'topics';


$erros = array();
$id = '';
$namne = '';
$description = '';

$topics = selectAll("$table");


if (isset($_POST['add-topic'])) {
	adminOnly();
	$errors = validateTopic($_POST);

	if ($count($errors) === 0) {
		unset($_POST['add-topic']);
		$topic_id = create($table, $_POST);
		$_SESSION['message'] = 'Topic created successfully';
		$_SESSION['type'] = 'success';
		header('location: ../../admin/topics/index.php');
		exit();	
	} else {	
		$name = $_POST['name'];
		$description = $_POST['description'];
	}
}

 
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$topic = selectOne($table, ['id' => $id]);
	$id = $topic['id'];
	$namne = $topic['name'];
	$description = $topic['description'];
}

if (isset($_GET['del_id'])) {
	$id =$_GET['del_id'];
	$count = delete($table, $id);
	$_SESSION['message'] = 'Topic delete succesfully';
	$_SESSION['type'] = 'success';
	header('Location: ../../admin/topics/index.php');
	exit();
}

if (isset($_POST['update-topic'])) {
	adminOnly();
	$errors = vaildateTopic($_POST);

	if (count($errors) === 0) {
		$id = $_POST['id'];
		unset($_POST['update-topic'], $_POST['id']);
		$topic_id = update($table, $id, $_POST);
		$_SESSION['message'] = 'Topic updated succesfully';
		$_SESSION['type'] = 'success';
		header('Location: ../../admin/topics/index.php');
		exit();
	} else {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$description = $_POST['description'];
	}	
}
