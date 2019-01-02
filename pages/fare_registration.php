<?php 

require('connection.php');

$fareid = htmlspecialchars($_POST['fareid']);
$fare = htmlspecialchars($_POST['fare']);
$fare_ril = $fare * 4000;

$sql_registration_fare = "INSERT INTO busfare (fare_id,fare,fare_riel) VALUE ('".$fareid."','".$fare."','".$fare_ril."')";

if ($conn->query($sql_registration_fare) === TRUE) {
	header('Location: http://localhost/DigitalBus/pages/fare.php');
}else{
	echo "Error : ".$conn->error;
	$_SESSION['duplicate']='Terjadi kesalahan';
	//header('Location: http://localhost/DigitalBus/pages/fare.php');
}

 ?>