<?php 
error_reporting(E_PARSE);

//SELECT fare_id=(SELECT fare FROM busfare f WHERE f.fare_id = r.fare_id), r.route_id, r.route_start, r.route_end FROM route r; 
$sql_show_fare_select = "SELECT fare_id, fare FROM busfare ORDER BY fare+0 ASC";
$result_show_fare_select = $conn->query($sql_show_fare_select);

if ($result_show_fare_select->num_rows > 0) {
	while ($row = $result_show_fare_select->fetch_assoc()) {
	    echo '<option value="'.$row["fare_id"].'">$ '.$row[fare].'</option>';
	}
}

 ?>