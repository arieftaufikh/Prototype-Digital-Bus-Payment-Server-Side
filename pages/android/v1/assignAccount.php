<?php 

require_once('../includes/DbOperation.php');
$respone = array();

if ($_SERVER['REQUEST_METHOD']=='POST') {
	if (isset($_POST['username'])) {
		$db = new DbOperation();

		$result=$db->createAccount($_POST['username']);
		if ($result==1) {
			$respone['error']=1;
			$respone['message']="User assigned to an account";
		}else{
			$respone['error']=true;
			$respone['message']="Account assignment failed";
		}
	}else{
		$respone['error']=true;
		$respone['message']="Required field are missing";
	}
}else{
	$respone['error']=true;
	$respone['message']="Invalid request";
}

echo json_encode($respone);


 ?>