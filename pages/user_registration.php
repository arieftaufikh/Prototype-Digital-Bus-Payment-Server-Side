<?php 

require('connection.php');

$user = htmlspecialchars($_POST['username']);
$password = md5(htmlspecialchars($_POST['password']));
$password2 = md5(htmlspecialchars($_POST['password2']));
$phoneNumber = htmlspecialchars($_POST['phonenumber']);
$fullname = htmlspecialchars($_POST['fullname']);
$email = htmlspecialchars($_POST['email']);
$role_id = htmlspecialchars($_POST['role']);

$sql_registration_user = "INSERT INTO user (username,password,phone_number,fullname,email,role_id) VALUE ('".$user."','".$password."',CONCAT('".$phoneNumber."'),'".$fullname."','".$email."','".$role_id."')";


if ($password!=$password2) {
	$_SESSION['error_update_user']="Password did not match.";
	header('Location: http://localhost/DigitalBus/pages/user.php');
}else{
	if ($conn->query($sql_registration_user) === TRUE) {
		if($role_id==3){
			$acc_id = mt_rand(10000,100000);
			$acc_id = $acc_id . $user;
			$sql_account = "INSERT INTO account (account_id,username) VALUE ('".$acc_id."','".$user."')";
			if ($conn->query($sql_account)=== TRUE) {
				header('Location: http://localhost/DigitalBus/pages/user.php');
			}else{
				$_SESSION['error_update_user']="Error Occur";
				header('Location: http://localhost/DigitalBus/pages/user.php');
			}
		}
		header('Location: http://localhost/DigitalBus/pages/user.php');
	}else{
		//echo "Error : ".$conn->error;

		$_SESSION['error_update_user'] = "Username / Email already used, recheck your data";
		//echo $_SESSION['error_update_user'];
		header('Location: http://localhost/DigitalBus/pages/user.php');
	}	
}



 ?>