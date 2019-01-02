<?php 

require('connection.php');

$fareid = htmlspecialchars($_POST['fareid']);
$fare = htmlspecialchars($_POST['fare']);


if (($_POST['rate']=="") OR ($_POST['rate']==0)) {
	$rate=4000;
}else{
	$rate = htmlspecialchars($_POST['rate']);
}

$fare_riel=$fare*$rate;


$sql_update_fare = "UPDATE busfare SET fare=".$fare.", fare_riel=".$fare_riel." WHERE fare_id=".$fareid."";
if ($conn->query($sql_update_fare) === TRUE) {
	$sql = "SELECT fare_id,fare from busfare";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	    $id = $row['fare_id'];
	    $newFare = $row['fare']*$rate;
	    $query = "UPDATE busfare set `fare_riel`=".$newFare." WHERE fare_id=".$id."";
	    $conn->query($query);
	}
	//cho 'Update Berhasil';
	header('Location: http://localhost/DigitalBus/pages/fare.php');
}else{
	echo "Error : ".$conn->error;
}
 ?>