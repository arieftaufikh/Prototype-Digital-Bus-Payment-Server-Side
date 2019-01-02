<?php 
require('connection.php');

if (isset($_SESSION['username']) or isset($_POST['password'])) {
	session_destroy();
	header('location: login.php');
}

 ?>