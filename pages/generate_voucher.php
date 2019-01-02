<?php 

require('connection.php');

$voucher_amount = htmlspecialchars($_POST['voucher_amount']);
$voucher_value = htmlspecialchars($_POST['voucher_value']);
$random = $voucher_value . mt_rand(100000,1000000);
$i = 0;


while($i<$voucher_amount){
	$sql_generate_voucher = "INSERT INTO `voucher`(`code`, `amount`, `status`) VALUES ('".$random."','".$voucher_value."','Available')";
	if ($conn->query($sql_generate_voucher)===TRUE) {
		$i++;
		$random = $voucher_value . mt_rand(100000,1000000);
	}else{
		$random = $voucher_value . mt_rand(100000,1000000);
	}
}

if ($i==$voucher_amount) {
	echo 'Input Berhasil';
	header('Location: http://localhost/DigitalBus/pages/account.php');
	$_SESSION['success'] = $voucher_amount . " Voucher Generated";
}else{
	echo "Error : ".$conn->error;
	$_SESSION['duplicate']='Terjadi kesalahan';
	//header('Location: http://localhost/DigitalBus/pages/voucher.php');
	echo $_SESSION['duplicate'];
}

 ?>