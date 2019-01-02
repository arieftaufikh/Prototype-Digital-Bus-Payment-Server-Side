<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<div class="table-responsive-md">
	    <table class="table table-striped table-bordered table-hover" id="tbl_fare">
	        <thead>
	            <tr>
	                <th width="25%">Fare ID</th>
	                <th width="25%">Fare ($)</th>
	                <th width="25%">Fare (Riel)</th>
	                <th width="20%"></th>
	            </tr>
	        </thead>
	        <tbody>
	            <?php 
	            error_reporting(E_PARSE);

	            $sql_showfare = "SELECT * FROM busfare ORDER BY fare_id+0 ASC";
	            $result_showfare = $conn->query($sql_showfare);

	            if ($result_showfare->num_rows > 0) {
	            	while ($row = $result_showfare->fetch_assoc()) {
	            		$id = $row[fare_id];
	            		echo '<tr>
		            			<td>'.$row[fare_id].'</td>
		            			<td id="fare'.$row[fare_id].'">'.$row[fare].'</td>
		            			<td id="fare'.$row[fare_id].'">'.$row[fare_riel].'</td>
		            			<td><input type="button" name="edit" id="'.$row[fare_id].'" value="Edit" class="btn btn-primary btn-block edit_data"></td>
	            			</tr>
	            		';
	            	}
	            }

	            ?>
	        </tbody>
	    </table>
	    <!-- /.table-responsive -->
	</div>
    
    <!-- Modal HTML --> 
	 <div id="add_data_Modal" class="modal fade">  
	      <div class="modal-dialog">  
	           <div class="modal-content">  
	                <div class="modal-header">  
	                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
	                     <h4 class="modal-title">Update Fare</h4>  
	                </div>  
	                <div class="modal-body">  
	                     <form role="form"  action="update_fare.php" method="POST">  
	                          <input type="text" name="fareid" id="fareid" hidden>
	                          <label>Fare</label>  
	                          <input type="text" name="fare" id="fare" class="form-control" />  
	                          <label>Exchange Rate</label>  
	                          <input type="text" name="rate" id="rate" class="form-control" /> 
	                          <br />
	                          <input type="submit" name="update" id="update" value="Update" class="btn btn-success" />  
	                     </form>  
	                </div>  
	                <div class="modal-footer">  
	                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
	                </div>  
	           </div>  
	      </div>  
	 </div>                       


    <?php 
    	mysqli_free_result($result_showfare);
    	mysqli_close($conn);
     ?>

 <script>
	$(document).ready(function(){   
	      $(document).on('click', '.edit_data', function(){  
           var fare_id = $(this).attr("id");
           var fare = document.getElementById('fare'+fare_id).innerHTML;
           $('#add_data_Modal').modal('show');
           $('#fareid').val(fare_id);
           $('#fare').val(fare);
      });
	});  
</script>