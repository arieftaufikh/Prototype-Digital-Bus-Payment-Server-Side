<?php 

require_once '../includes/DbOperation.php';
$respone = array();

if ($_SERVER['REQUEST_METHOD']=='POST') {
	if (isset($_POST['busid'])) {

		$db = new DbOperation();

		if ($db->driverLogout($_POST['busid'])) {
			$respone['error']=0;
			$respone['message']="Logout Success";
		}else{
			$respone['error']=1;
			$respone['message'] = "Something went wrong.";
		}
	}else{
		$respone['error']=1;
		$respone['message'] = "Something went wrong.";
	}
}

echo json_encode($respone);

 ?>