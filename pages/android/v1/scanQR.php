<?php 

require_once '../includes/DbOperation.php';
$respone = array();
$date_time = $_SERVER['REQUEST_TIME'];

if ($_SERVER['REQUEST_METHOD']=='POST') {

	if (isset($_POST['bus_id']) && isset($_POST['username'])) {
		$db = new DbOperation;

		$resultFare = $db->getFare($_POST['bus_id']);
		$resultUserBalance = $db->getUserBalance($_POST['username']);
		
		$resultDriver= $db->getDriver($_POST['bus_id']);
		//echo $resultDriver['username'];

		$balance = $resultUserBalance['balance']-$resultFare['fare'];
		$balance_riel = $resultUserBalance['balance_riel']-$resultFare['fare_riel'];

		if ($balance>0) {

			if ($resultDriver['username']=="") {
				$respone['error']=true;
				$respone['message']="Bus Not Operating";

			}else{
				//if ($db->busTransaction($resultUserBalance['account_id'],$resultFare['bus_id'],$resultFare['fare_riel'],$resultDriver['username']))
				if ($db->updateUserBalance($balance,$balance_riel,$_POST['username'])) 
				{
		
					if ($db->busTransaction($resultUserBalance['account_id'],$_POST['bus_id'],$resultFare['fare_riel'],$resultDriver['username']))
					//if ($db->updateUserBalance($balance,$balance_riel,$_POST['username'])) 
					{
							
						$respone['error']=false;
						$respone['balance']=round($balance,2);
						$respone['balance_riel']=round($balance_riel,2);
						$respone['message']="Enjoy your ride.";

						$respone['username']=$_POST['username'];
						$respone['account_id']=$resultUserBalance['account_id'];
						$respone['bus_plate']=$resultFare['plate_no'];
						$respone['bus_fare']=$resultFare['fare'];
						//date_default_timezone_get('Asia/Phnom_Penh');
						//$respone['date_time']=date_default_timezone_get('Asia/Phnom_Penh');
						$respone['date_time']= date("Y-m-d")." ".date("h:i:s");
						//$respone['date_time']=$date_time;


					}else{

						$respone['error']=true;
						$respone['message']="Something Went Wrong";

					}

				}else{

					$respone['error']=true;
					$respone['message']="Bus Not Operating";
				}

			}

		}else{

			$respone['error']=true;
			$respone['message']="Balance Insufficient";
		}


	}else{

		$respone['error']=true;
		$respone['message']="Something Went Wrong, Try again later";
	}
	
}else{

	$respone['error']=true;
	$respone['message']="Invalid Request";
	
}

echo json_encode($respone);

 ?>