<?php 
error_reporting(E_PARSE);

$sql_showtrans = "SELECT bus_transaction.transaction_no, bus_transaction.account_id,bus_transaction.bus_id,bus_transaction.date_time, account.username,bus.plate_no,route.route_start,route.route_end,busfare.fare FROM bus_transaction JOIN account ON bus_transaction.account_id=account.account_id JOIN bus ON bus_transaction.bus_id=bus.bus_id JOIN route ON bus.route_id=route.route_id JOIN busfare ON route.fare_id = busfare.fare_id";
$result_showtrans = $conn->query($sql_showtrans);

if ($result_showtrans->num_rows > 0) {
	while ($row = $result_showtrans->fetch_assoc()) {
		echo '<tr>
				<td>'.$row[date_time].'</td>
				<td>'.$row[transaction_no].'</td>
				<td>'.$row[account_id].'</td>
				<td>'.$row[username].'</td>
				<td>'.$row[bus_id].'</td>
				<td>'.$row[plate_no].'</td>
				<td>'.$row[route_start].' - '.$row[route_end].'</td>
				<td>'.$row[fare].'</td>
			</tr>';
	}
}

/*
SELECT bus_transaction.transaction_no, bus_transaction.account_id,bus_transaction.bus_id,bus_transaction.date_time, account.username,bus.plate_no,route.route_start,route.route_end,busfare.fare FROM bus_transaction LEFT JOIN account ON bus_transaction.account_id=account.account_id LEFT JOIN bus ON bus_transaction.bus_id=bus.bus_id LEFT JOIN route ON bus.route_id=route.route_id LEFT JOIN busfare ON route.fare_id = busfare.fare_id
*/

?>





