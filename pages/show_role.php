<?php
error_reporting(E_PARSE); 

$sql_showrole = "SELECT role_id,role_name FROM role ORDER BY role_id+0 ASC";
$result_showrole = $conn->query($sql_showrole);

if ($result_showrole->num_rows > 0) {
	while ($row = $result_showrole->fetch_assoc()) {
	    echo '<option value="'.$row["role_id"].'">'.$row[role_name].'</option>';
	}
}

 ?>