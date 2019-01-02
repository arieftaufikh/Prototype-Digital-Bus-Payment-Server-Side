<?php 
session_set_cookie_params(0);
session_start();
error_reporting(E_PARSE);


$servername = "localhost";
$username = "root";
$db = "digital_bus";

$conn = new mysqli($servername,$username,"",$db);
$conn2 = new mysqli($servername,$username,"",$db);

if (!$conn) {
	die("Connection failed : ".mysqli_connect_error());
}

if (!$conn2) {
	die("Connection failed : ".mysqli_connect_error());
}

if (!function_exists('logged')) {
	function logged(){
		if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
			return true;
		}else{
			return false;
		}
	}
}

?>