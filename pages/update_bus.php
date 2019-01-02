<?php 

require('connection.php');

$busid = htmlspecialchars($_POST['busid']);
$busplate = htmlspecialchars($_POST['busplate']);


$sql_update_bus = "UPDATE bus SET plate_no='".$busplate."' WHERE bus_id=".$busid."";
if ($conn->query($sql_update_bus) === TRUE) {
	//cho 'Update Berhasil';
	header('Location: http://localhost/DigitalBus/pages/bus.php');
}else{
	echo "Error : ".$conn->error;
	//header('Location: http://localhost/DigitalBus/pages/bus.php');
}
 ?>