<?php 

require('connection.php');

$username = htmlspecialchars($_POST['username']);
$phonenumber = htmlspecialchars($_POST['phonenumber']);
$fullname = htmlspecialchars($_POST['fullname']);
$email = htmlspecialchars($_POST['email']);
$role = htmlspecialchars($_POST['roleid']);


$sql_update_user = "UPDATE user SET phone_number=CONCAT('".$phonenumber."'), fullname='".$fullname."', 
	email='".$email."',
	role_id=".$role." WHERE username='".$username."'";
if ($conn->query($sql_update_user) === TRUE) {
	//cho 'Update Berhasil';
	header('Location: http://localhost/DigitalBus/pages/user.php');
}else{
	echo "Error : ".$conn->error;
}
 ?>