<?php 

require_once(__DIR__."/../../database/db.php");
include(__DIR__."/../../helpers/middleware.php");
include(__DIR__."/../../helpers/validateUser.php");


// $table = 'posts';

// $topics = selectAll('topics');
// $posts = selectAll($table);

// $errors = array(); 
// $id = "";
// $title = "";
// $body = "";
// $topic_id = "";
// $published = "";

// if (isset($_GET['id'])) {
// 	$post = selectOne($table, ['id' => $_GET['id']]);

// 	$id = $post['id'];
// 	$title = $post['title'];
// 	$body = $post['body'];
// 	$topic_id = $post['topic_id'];
// 	$published = $post['published'];
// }


// if (isset($_GET['delete_id'])) {
// 	adminOnly();
// 	$count = delete($table, $_GET['delete_id']); {
// 	$_SESSION['message'] = "Post updated successfully";
// 	$_SESSION['type'] = "success";
// 	header("location: ../../admin/posts/index.php");
// 	exit();

// }

// if (isset($_GET['published']) && isset($_GET['p_id'])) {
// 	adminOnly();
// 	$published = $_GET['published'];
// 	$p_id = $_GET['p_id'];
// 	$count = update($table, $p_id, ['published' => $published]);
// 	$_SESSION['message'] = "Post pubslished state changed!";
// 	$_SESSION['type'] = "success";
// 	header("location: ../../admin/posts/index.php");
// 	exit();
// }

// if (isset($_POST['add-post'])) {
// 	adminOnly();
// 	//dd($_FILES['image']['name']);
// 	$errors = validatePost($_POST);

// 	if (!empty($_FILES['image']['name'])) {
// 		$image_name = time() . '_' . $_FILES['image']['name'];
// 		$destination = "../../assets/img/" . $image_name;

// 		$result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

// 	if ($result) {
// 		$_POST['image']	= $image_name;
// 	} else {
// 		array_push($errors, "Failed to upload image");
// 	}
// } else {
// 	array_push($errors, "Post image required");
// }	

// 	if (count($errors) == 0) {
// 		unset($_POST['add-post']);
// 		$_POST['user_id'] = $_SESSION['id'];
// 		$_POST['published'] = isset($_POST['published']) ? 1 : 0;
// 		$_POST['body'] = htmlentites($_POST['body']);

// 		$post_id = create($table, $_POST);
// 		$_SESSION['message'] = "Post created successfully";
// 		$_SESSION['type'] = "success";
// 		header("location: ../../admin/posts/index.php");
// 		exit();
// 	} else {
// 		$title = $_POST['title'];
// 		$body = $_POST['body'];
// 		$topic_id = $_POST['topic_id'];
// 		$published = isset($_POST['published']) ? 1 : 0;
// 	}
// }

// if (isset($_POST['update-post'])) {
// 	adminOnly();
// 	$errors = validatePosts($_POST);

// 	if (!empty($_FILES['image']['name'])) {
// 		$image_name = time() . '_' . $_FILES['image']['name'];
// 		$destination = "../../assets/img/" . $image_name;

// 		$result = move_upload_files($_FILES['images']['tmp_name'], $destination);

// 		if ($result) {
// 			$_POST['image']	= $image_name;
// 		} else {
// 			array_push($errors, "Post image required");
// 		}
// 	} else {
// 		array_push($errors, "Failed to upload image");
// 	}
// 		if (count($erros) == 0) {
// 			$id = $_POST['id'];
// 			unset($_POST['update-post'], $_POST['id']);
// 			$_POST['user_id'] = $_SESSION['id'];
// 			$_POST['published'] = isset($_POST['published']) ? 1 : 0;
// 			$_POST['body'] = htmlentites($_POST['body']);

// 			$post_id = update($table, $id, $_POST);
// 			$_SESSION['message'] = "Post updated successfully";
// 			$_SESSION['type'] = "success";
// 			header("location: ../../admin/posts/index.php");
// 		} else {
// 			$title = $_POST['title'];
// 			$body = $_POST['body'];
// 			$topic_id = $_POST['topic_id'];
// 			$published = isset($_POST['published']) ? 1 : 0;
// 		}
// 	}

// }

if (isset($_POST["action"])) {
	if ($_POST["action"] == "add-post") {

		$title = $_POST["title"];
		$body = $_POST["body"];
		$topic_id = $_POST["topic_id"];
		$user_id = $_SESSION["user_details"]["id"];

		$img_name = $_FILES['image']['name'];
		$img_size = $_FILES['image']['size'];
		$img_tmpname = $_FILES['image']['tmp_name'];
		$img_path = "/assets/img/$img_name";
		$img_type = pathinfo($img_name, PATHINFO_EXTENSION);

		$is_img = false;
		$has_details = false;

		$type = array("jpg", "jpeg", "png", "svg", "gif");
		echo "string";
		//To check wether the admin upload an image file
		if(!in_array($img_type, $type)) {

			
			echo "Please upload an image file";
			die();

		}

		
		foreach($_POST as $key => $value) {
			if(empty($value)) {
				die("Please fill out all fields");
			}
		} 

		//Store the product in the database.
		if($img_size > 0) {
			move_uploaded_file($img_tmpname, $_SERVER["DOCUMENT_ROOT"] . $img_path);
			$query = "INSERT INTO posts (user_id, title, image, body, topic_id) VALUES (?, ?, ?, ?, ?)";

			$stmt = $conn->prepare($query);
			$stmt->bind_param("isssi", $user_id, $title, $img_path, $body, $topic_id);
			$stmt->execute();
			$stmt->close();
			$conn->close();

			header("Location: /");
		}
	}

	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		// $address = $_POST['address'];

		mysqli_query($db, "UPDATE posts SET title=?, image=? ,body=? WHERE id= ?");
		$_SESSION['message'] = "Address updated!"; 
		header('location: index.php');
	}

	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM info WHERE id=$id");
		$_SESSION['message'] = "Address deleted!"; 
		header('location: index.php');
	}
	

}




if (isset($_GET['delete_id'])) {
	$query = "DELETE FROM `posts` WHERE `posts`.`id` = ?";
	$stmt = $conn -> stmt_init();
	if (!$stmt->prepare($query)) {
		echo "error";
		die();
	}
	
	$stmt -> bind_param("i", $_GET["delete_id"]);
	$stmt->execute();
	$_SESSION['message'] = 'post has been deleted';
	$_SESSION['type'] = "success"; 
	header('Location: ../../admin/posts/index.php');
	exit();
}
