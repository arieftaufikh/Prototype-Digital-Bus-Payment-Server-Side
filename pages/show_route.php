<?php 
require ('connection.php');
error_reporting(E_PARSE);

$sql_showroute = "SELECT route.route_id,route.route_start,route.route_end,busfare.fare FROM route join busfare ON route.fare_id=busfare.fare_id ORDER BY route.route_id+0";
$result_showroute = $conn->query($sql_showroute);

if ($result_showroute->num_rows > 0) {
	while ($row = $result_showroute->fetch_assoc()) {
		echo '<tr><td>'.$row[route_id].'</td><td>'.$row[route_start].' - '.$row[route_end].'</td><td>$ '.$row[fare].'</td></tr>';
	}
}else{
	echo '<tr><td>No Data</td><td>No Data</td><td>No Data</td></tr>';
}

mysqli_free_result($result_showrout);
mysqli_close($conn);

?>