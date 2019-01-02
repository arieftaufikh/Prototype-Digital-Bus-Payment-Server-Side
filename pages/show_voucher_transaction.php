<?php 
error_reporting(E_PARSE);

$sql_showaccount = "SELECT `transaction_id`, `username`, `account_id`, `code`, `amount`, `date` FROM `voucher_transaction`";
$result_showaccount = $conn->query($sql_showaccount);

if ($result_showaccount->num_rows > 0) {
	while ($row = $result_showaccount->fetch_assoc()) {
		echo '<tr>
				<td>'.$row[transaction_id].'</td>
				<td>'.$row[username].'</td>
				<td>'.$row[account_id].'</td>
				<td>'.$row[code].'</td>
				<td>'.$row[amount].'</td>
				<td>'.$row[date].'</td>
			</tr>';
	}
}else{
	echo '<tr>
			<td>No Data</td>
			<td>No Data</td>
			<td>No Data</td>
			<td>No Data</td>
			<td>No Data</td>
			<td>No Data</td>
		</tr>';
}

?>