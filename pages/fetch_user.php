<?php 

	require('connection.php');
	if(isset($_POST['username'])){
		$query = "SELECT * FROM user WHERE username='".$_POST['username']."'";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}
?>