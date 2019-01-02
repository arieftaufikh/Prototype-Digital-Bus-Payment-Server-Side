<?php 

require_once '../includes/DbOperation.php';
$respone = array();

if ($_SERVER['REQUEST_METHOD']=='POST') {
	if (isset($_POST['username']) && isset($_POST['password'])) {

		$db = new DbOperation();

		if ($db->driverLogin($_POST['username'],$_POST['password'])) {

			$result = $db->getBusComplete($_POST['busid']);

			if ($db->updateBusDriver($_POST['busid'],$_POST['username'])) {
				$respone['error'] = 0;
				$respone['username'] = $_POST['username'];
				$respone['busplate']=$result['plate_no'];
				$respone['message'] = "Login Success";
			}else{
				$respone['error'] = 1;
				$respone['message'] = "Something Went Wrong";
			}
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