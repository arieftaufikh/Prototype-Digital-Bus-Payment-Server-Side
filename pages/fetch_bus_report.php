<?php 
//error_reporting(E_PARSE);
if ($_SERVER['REQUEST_METHOD']=='POST') {
	require('connection.php');

	$busid=htmlspecialchars($_POST['busid']);
	$date = htmlspecialchars($_POST['date']);
	$month = date('F',mktime(0,0,0,$date,10));
	echo '
		<div class="panel-heading">
		    Transaction Report : '.$month.'
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
		    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
		        <thead>
		            <tr>
		                <th>Transaction ID</th>
		                <th>Account ID</th>
		                <th>Bus ID</th>
		                <th>Month</th>
		                <th>Fare</th>
		            </tr>
		        </thead>
		        <tbody>
	';

	$sql = "SELECT `transaction_no`, `account_id`, `bus_id`, `date_time`,`fare` FROM `bus_transaction` WHERE bus_id='".$busid."' OR MONTH(`date_time`)=".$date."";
	$result = $conn->query($sql);
	$income=0;
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo '<tr>
					<td>'.$row['transaction_no'].'</td>
					<td>'.$row['account_id'].'</td>
					<td>'.$row['bus_id'].'</td>
					<td>'.date("F",strtotime($row['date_time'])).'</td>
					<td>'.$row['fare'].'</td>
				</tr>';
				$income +=$row['fare'];
		}
		echo '
			<table width="100%" class="table table-striped table-bordered table-hover">
			    <tbody>
			        <!--Disini-->
			        <tr>
			        	<td><strong>Total Income</strong></td>
			        	<td><strong>'.$income.'</strong></td>
			        </tr>
			    </tbody>
			</table>
			
		';
	}else{
		echo '
			<tr>
				<td>No Data</td>
				<td>No Data</td>
				<td>No Data</td>
				<td>No Data</td>
				<td>No Data</td>
			</tr>
		';
	}
}else{
	echo '
	<div class="panel-heading">
	    Transaction Report
	</div>
	<!-- /.panel-heading -->
	<div class="panel-body">
	    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
	        <thead>
	            <tr>
	                <th>Transaction ID</th>
	                <th>Account ID</th>
	                <th>Bus ID</th>
	                <th>Month</th>
	                <th>Fare</th>
	            </tr>
	        </thead>
	        <tbody>
				<tr>
					<td>No Data</td>
					<td>No Data</td>
					<td>No Data</td>
					<td>No Data</td>
					<td>No Data</td>
				</tr>
	';
}
 ?>

