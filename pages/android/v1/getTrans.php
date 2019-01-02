<?php 

require_once '../includes/DbOperation.php';
$respone = array();

if ($_SERVER['REQUEST_METHOD']=='POST') {
	if (isset($_POST['username']) && isset($_POST['start']) && isset($_POST['end'])) {

		$db = new DbOperation();

		$date = new DateTime($_POST['end']);
		$date->modify('+1 day');
		$date = $date->format('Y-m-d');

		$result=$db->getBusTransaction($_POST['username'],$_POST['start'],$date);
		
		if ($result==null) {
			$respone['error']=0;
			$respone['message']="No Data";
		}else{
			while ($row = $result->fetch_assoc()) {
			   $respone[]=$row;
			}
		}
		
	}else{
		$respone['error']=1;
		$respone['message'] = "Something went wrong.";
	}
}

echo json_encode($respone);

 ?>