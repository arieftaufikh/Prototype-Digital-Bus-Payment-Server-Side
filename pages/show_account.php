<?php 
error_reporting(E_PARSE);

$sql_showaccount = "SELECT `account_id`, `username`, `balance`, `date_created` FROM `account";
$result_showaccount = $conn->query($sql_showaccount);

if ($result_showaccount->num_rows > 0) {
	while ($row = $result_showaccount->fetch_assoc()) {
		echo '<tr>
				<td>'.$row[account_id].'</td>
				<td>'.$row[username].'</td>
				<td>'.$row[balance].'</td>
				<td>'.$row[date_created].'</td>
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