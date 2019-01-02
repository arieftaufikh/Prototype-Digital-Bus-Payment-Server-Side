<?php 
error_reporting(E_PARSE);

$sql_showaccount = "SELECT `code`, `amount`, `status`, `date_generated` FROM `voucher` WHERE status like 'available'";
$result_showaccount = $conn->query($sql_showaccount);

if ($result_showaccount->num_rows > 0) {
	while ($row = $result_showaccount->fetch_assoc()) {
		echo '<tr>
				<td>'.$row[code].'</td>
				<td>$ '.$row[amount].'</td>
				<td>'.$row[status].'</td>
				<td>'.$row[date_generated].'</td>
			</tr>';
	}
}else{
	echo '<tr>
			<td>No Data</td>
			<td>No Data</td>
			<td>No Data</td>
			<td>No Data</td>
		</tr>';
}

?>