<?php 
require_once '../includes/DbOperation.php';
$respone = array();

if ($_SERVER['REQUEST_METHOD']=='POST') {

	if (isset($_POST['username']) &&
	 isset($_POST['password']) &&
	  isset($_POST['phone_number']) &&
	   isset($_POST['fullname']) &&
	    isset($_POST['email'])) {

		if (($_POST['username']!="") &&
		 ($_POST['password']!="") &&
		  ($_POST['phone_number']!="") &&
		   ($_POST['fullname']!="") &&
		    ($_POST['email']!="")) {

			$db = new DbOperation();
			$result = $db->createUser($_POST['username'], $_POST['password'], $_POST['phone_number'], $_POST['fullname'], $_POST['email']);
			$result2 = $db->createAccount($_POST['username']);

			if ($result == 1) {

				$respone['error']=1;
				$respone['message']= "User registered successfully";

			}else if ($result == 2) {

				$respone['error']=true;
				$respone['message']= "Some error occurred please try again later";			

			}else if ($result == 0) {

				$respone['error']=2;
				$respone['message']= "Username or email already used";	
			}

		}else{

			$respone['error']=true;
			$respone['message'] = "Required fields are missing";

		}

	}else{

		$respone['error']=true;
		$respone['message'] = "Required fields are missing";

	}
}else{

	$respone['error'] = true;
	$respone['message'] = "Invalid Request";

}

echo json_encode($respone);

 ?>