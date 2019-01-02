<?php 
	error_reporting(E_PARSE);
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
	//require('connection.php');
	//$date = '08';
	//$month = date('F',mktime(0,0,0,$date1,10)).'<br>';
	$voucher_count=0;
	$voucher_used_count=0;
	$total=0;
	$total_used=0;
	
	$sql = "SELECT `code`, `amount`, `status`, `date_generated` FROM `voucher` WHERE `date_generated`>='".$date1."' AND `date_generated`<='".$date2."'";

	$sql2="SELECT voucher.code,voucher.amount,voucher.date_generated,voucher.status,voucher_transaction.username,voucher_transaction.date FROM voucher_transaction JOIN voucher WHERE  voucher.code=voucher_transaction.code AND voucher_transaction.date>='".$date1."' AND voucher_transaction.date <='".$date2."'";

	$result = $conn->query($sql);
	$result2 = $conn2->query($sql2);
	if (!$result2) {
		echo $conn2->error;
	}

	echo '
		<div class="col-lg-12">
			<div class="panel panel-default">
			    <div class="panel-heading">
			        Voucher Generation Details :<strong> '.$date1.' - '.$date2.'</strong>
			    </div>
			    <!-- /.panel-heading -->
			    <div class="panel-body">
			        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
			            <thead>
			                <tr>
			                    <th>Voucher Code</th>
			                    <th>Amount</th>
			                    <th>Status</th>
			                    <th>Date Generated</th>
			                </tr>
			            </thead>
			            <tbody>
	';

							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									echo '<tr>
											<td>'.$row['code'].'</td>
											<td>'.$row['amount'].'</td>
											<td>'.$row['status'].'</td>
											<td>'.date("d F o",strtotime($row['date_generated'])).'</td>
										</tr>';
									$total+=$row['amount'];
									$voucher_count++;
									
								}
								echo '
									<table width="100%" class="table table-striped table-bordered table-hover">
									    <tbody>
									        <!--Disini-->
									        <tr>
									        	<td><strong>Total Voucher Generated</strong></td>
									        	<td><strong>'.$voucher_count.' Voucher</strong></td>
									        </tr>
									        <tr>
									        	<td><strong>Total Amount Generated</strong></td>
									        	<td><strong>$ '.$total.'</strong></td>
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
									</tr>
								';
							}
	echo '
			            </tbody>
			        </table>
			        <!-- /.table-responsive -->
			    </div>
			    <!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->

	';

	echo '
		<div class="col-lg-12">
			<div class="panel panel-default">
			    <div class="panel-heading">
			        Voucher Transaction Details : <strong> '.$date1.' - '.$date2.'</strong>
			    </div>
			    <!-- /.panel-heading -->
			    <div class="panel-body">
			        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
			            <thead>
			                <tr>
			                    <th>Voucher Code</th>
			                    <th>Amount</th>
			                    <th>Date Generated</th>
			                    <th>Username</th>
			                    <th>Date</th>
			                </tr>
			            </thead>
			            <tbody>
	';

							if ($result2->num_rows >0) {
								while ($row2 = $result2->fetch_assoc()) {
								    echo '<tr>
											<td>'.$row2['code'].'</td>
											<td>'.$row2['amount'].'</td>
											<td>'.date("d F o",strtotime($row2['date_generated'])).'</td>
											<td>'.$row2['username'].'</td>
											<td>'.$row2['date'].'</td>
										</tr>';
										$total_used+=$row2['amount'];
										$voucher_used_count++;
								}
								echo '
									<table width="100%" class="table table-striped table-bordered table-hover">
									    <tbody>
									        <!--Disini-->
									        <tr>
									        	<td><strong>Total Voucher Used</strong></td>
									        	<td><strong>'.$voucher_used_count.' Voucher</strong></td>
									        </tr>
									        <tr>
									        	<td><strong>Total Amount Used</strong></td>
									        	<td><strong>$ '.$total_used.'</strong></td>
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
	echo '
			            </tbody>
			        </table>
			        <!-- /.table-responsive -->
			    </div>
			    <!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->

	';
 ?>

