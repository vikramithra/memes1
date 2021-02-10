<?php 

function validateTopic($topic)
{
	$errors = array();

	if (empty($topicr['name'])) {
		array_push($errors, 'Name is required');
	}


	// $existingTopic = selectOne('topics', ['name' => $topic['name']]);
	// if ($existingTopic) {
	// 	array_push($errors, 'Name already exists');
	// }

	$existingPost = selectOne('topics', ['name' => $post['name']]);
	if ($existingTopic) {
		if (isset($post['update-topic']) && $existingPost['id'] != $post['id']) {
			array_push($errors, 'Name already exists');
	}
		if (isset($post['add-post'])) {
			array_push($errors, 'Name already exists');
		}
	}

	return $errors;
}

