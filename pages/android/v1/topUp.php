<?php 

require_once '../includes/DbOperation.php';
$respone = array();

if ($_SERVER['REQUEST_METHOD']=='POST') {

	if (isset($_POST['username']) && isset($_POST['code'])) {
		
		if(($_POST['username']!="") || ($_POST['code']=="")){

			$db = new DbOperation;

			if ($db->checkVoucherAvailability($_POST['code'])) {
				
				$result_user = $db->getUserBalance($_POST['username']);
				$result_amount = $db->getVoucherAmount($_POST['code']);
				$result_account = $db->getUserAccount($_POST['username']);

				$userbalance = $result_user['balance'];
				$useraccount = $result_account['account_id'];
				$voucher_amount = $result_amount['amount'];

				$balance = $userbalance + $voucher_amount;
				$balance_riel = $balance * 4000;
				$topupid = $useraccount.$_POST['code'];

				
				if ($db->topUp($topupid,$_POST['username'],$useraccount,$_POST['code'],$voucher_amount)) {

					if ($db->updateUserBalance($balance,$balance_riel,$_POST['username'])) {

						if ($db->updateVoucher($_POST['code'])){
							$current_balance = $db->getUserBalance($_POST['username']);
							$respone['error']=false;
							$respone['message']="Top up Success";
							$respone['balance']	= $current_balance['balance'];
							$respone['balance_riel'] = $current_balance['balance_riel'];
						}else{
							$respone['error']=true;
							$respone['message']="Error updating your balance, please contact our support";
						}
						
					}else{
						$respone['error']=true;
						$respone['message']="Something went wrong, try again later";

					}

				}else{

					$respone['error']=true;
					$respone['message']="Something went wrong, try again later 2";

				}


			}else{

				$respone['error']=true;
				$respone['message']="Voucher Already Used";

			}

		}else{

			$respone['error']=true;
			$respone['message']="Required Field(s) is missing";

		}

	}else{

		$respone['error']=true;
		$respone['message']="Required Field(s) is missing";	

	}

}else{

	$respone['error']=true;
	$respone['message']="Invalid Request";

}

echo json_encode($respone);

 ?>