<?php  

function userOnly($redirect = '/index.php')
{
	if (empty($_SESSION['id'])) {
		$_SESSION['message'] = 'You need to login first';
		$_SESSION['type'] = 'error';
		header('location: ' . $redirect);
		exit(0);
	}

}

function adminOnly($redirect = '/index.php')
{
	if (isset($_SESSION['user_details']) || !$_SESSION["user_details"]['admin']) {
		$_SESSION['message'] = 'You need to login first';
		$_SESSION['type'] = 'error';
		header('location: ' . $redirect);
		exit(0);
	}

}

function guestsOnly($redirect = '/index.php') 
{
	if (isset($_SESSION['id'])) {
		header('location: ' . $redirect);
		exit(0);
	}

}


