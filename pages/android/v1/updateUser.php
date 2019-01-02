<?php 

require_once '../includes/DbOperation.php';
$respone = array();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$db = new DbOperation;
	$result = $db->checkDuplicateEmail($_POST['username'],$_POST['email']);
	if ($result == 0) {

		$respone['error']=true;
		$respone['message']="Email already used";

	}else{

		if ($db->updateUser($_POST['fullname'],$_POST['email'],$_POST['phonenumber'],$_POST['username'])==1) {

			$respone['error']=false;			
			$respone['fullname']=$_POST['fullname'];
			$respone['email']=$_POST['email'];
			$respone['phonenumber']=$_POST['phonenumber'];
			$respone['message']="User Information Updated";

		}else{

			$respone['error']=true;
			$respone['message']="Some error occured, try again later";
			
		}
		
	}

}

echo json_encode($respone);

 ?>