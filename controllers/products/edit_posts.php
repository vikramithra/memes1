<?php

session_start();
require_once(__DIR__."/../../database/db.php");
include(__DIR__."/../../helpers/middleware.php");
include(__DIR__."/../../helpers/validateUser.php");

  $id = intval($_POST['id']);
  $title = htmlspecialchars($_POST['title']);
  $body = htmlspecialchars($_POST['body']);
  $topic_id = intval($_POST['topic_id']);
  var_dump($_POST);  


  if($_FILES['image']['name'] !=""){ // If the admin wants to update the immage.
      $img_name = $_FILES['image']['name'];
      $img_path = "/assets/img/$img_name";
      move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$img_path);

      $query = "UPDATE posts SET title = ?, body = ?, topic_id = ?, image =?  WHERE id = ?";
      $stmt = $conn->stmt_init() ;
      if(!$stmt->prepare($query)){
         die("connect error");
      }
      $stmt->bind_param('ssisi', $title, $body, $topic_id, $img_path, $id);
      $stmt->execute();
      $stmt->close();
      $conn->close();
  } else { //admin only wants to update the details
        $query = "UPDATE posts SET title = ?, body = ?, topic_id = ?  WHERE id = ?";
              $stmt = $conn->prepare($query);
              $stmt->bind_param('sssi', $title, $body, $topic_id, $id);
              $stmt->execute();
              $stmt->close();
              $cn->close();
}

  header("Location: ". $_SERVER['HTTP_REFERER']);