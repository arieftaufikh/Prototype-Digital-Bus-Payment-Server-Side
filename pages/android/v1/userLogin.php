<?php 

require_once '../includes/DbOperation.php';
$respone = array();

if ($_SERVER['REQUEST_METHOD']=='POST') {
	if (isset($_POST['username']) && isset($_POST['password'])) {

		$db = new DbOperation();

		if ($db->userLogin($_POST['username'],$_POST['password'])) {

			$balance = $db->getUserBalance($_POST['username']);
			$user = $db->getUserByUsername($_POST['username']);

			$respone['error'] = 0;
			$respone['username'] = $user['username'];
			$respone['password'] = $_POST['password'];
			$respone['phone_number'] = $user['phone_number'];
			$respone['fullname'] = $user['fullname'];
			$respone['email'] = $user['email'];
			$respone['balance'] = $balance['balance'];
			$respone['message'] = "Login Success";

		}else{
			$respone['error'] = 1;
			$respone['message'] = "Invalid username or password";
		}
	}else{
		$respone['error']=2;
		$respone['message'] = "Required fields are missing";
	}
}

echo json_encode($respone);

 ?>