<?php 

require('connection.php');

include(__DIR__ . DIRECTORY_SEPARATOR . 'phpqrcode'.DIRECTORY_SEPARATOR.'qrlib.php');

$busid = htmlspecialchars($_POST['bus_id_route']);
$route = htmlspecialchars($_POST['route']);


//Mulai Disini

	/*$QR_Dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'phpqrcode'.DIRECTORY_SEPARATOR.'QR'.DIRECTORY_SEPARATOR;

	if (!file_exists($QR_Dir)) {
		mkdir($QR_Dir);
	}

	$location = $QR_Dir.md5($busid).'|'.md5($route).'.png';
	$errorCorrectionLevel = 'H';
	$matrixPointSIze = 6;
	$filename = md5($busid).md5($route);
	QRCode::png($bus_id.$route, $location, $errorCorrectionLevel, $matrixPointSIze, 2);*/

	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'QR'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'QR/'; 
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'H';
    $matrixPointSize = 8;
        
    // user data
    $filename = $PNG_TEMP_DIR.md5(($busid.$route).'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    QRcode::png($busid, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

//Akhir disini


$sql_registration_route = "UPDATE bus SET route_id='".$route."', `qr`='".$busid.$route."',`qr_location`='".$filename."' WHERE bus_id='".$busid."'";

if ($conn->query($sql_registration_route) === TRUE) {
	header('Location: http://localhost/DigitalBus/pages/bus.php');
	echo 'Succes';
}else{
	echo "Error : ".$conn->error;
	$_SESSION['duplicate2']=1;
	//header('Location: http://localhost/DigitalBus/pages/bus.php');
	echo $_SESSION['duplicate'];
}

 ?>