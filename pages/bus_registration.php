<?php 

require('connection.php');



$busid = htmlspecialchars($_POST['busid']);
$busplate = htmlspecialchars($_POST['busplate']);




$sql_registration_bus = "INSERT INTO bus (bus_id,plate_no) VALUE ('".$busid."','".$busplate."')";

if ($conn->query($sql_registration_bus) === TRUE) {
	header('Location: http://localhost/DigitalBus/pages/bus.php');
}else{
	echo "Error : ".$conn->error;
	$_SESSION['duplicate']='Terjadi kesalahan';
	header('Location: http://localhost/DigitalBus/pages/bus.php');
	echo $_SESSION['duplicate'];
}

?>