<?php 

require('connection.php');
//error_reporting(E_PARSE);

$routeid = htmlspecialchars($_POST['routeid']);
$routestart = htmlspecialchars($_POST['routestart']);
$routeend = htmlspecialchars($_POST['routeend']);
$fareid = htmlspecialchars($_POST['fare_id']);

$sql_registration_route = "INSERT INTO route (route_id,route_start,route_end,fare_id) VALUE ('".$routeid."','".$routestart."','".$routeend."','".$fareid."')";

if ($conn->query($sql_registration_route) === TRUE) {
	header('Location: http://localhost/DigitalBus/pages/route.php');
}else{
	echo "Error : ".$conn->error;
	$_SESSION['duplicate']=1;
	header('Location: http://localhost/DigitalBus/pages/route.php');
}

 ?>