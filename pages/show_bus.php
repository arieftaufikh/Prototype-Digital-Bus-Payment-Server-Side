<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<table class="table table-striped table-bordered table-hover" id="tbl_bus">
    <thead>
        <tr>
            <th>Bus ID</th>
            <th>Bus Plate No</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        require_once('connection.php');
        error_reporting(E_PARSE);

        $sql_showbus = "SELECT bus_id, plate_no FROM bus ORDER BY bus_id + 0 ASC";
        $result_showbus = $conn->query($sql_showbus);

        if ($result_showbus->num_rows > 0) {
        	while ($row = $result_showbus->fetch_assoc()) {
        		echo '<tr>
        				<td>'.$row[bus_id].'</td>
        				<td id="plateno'.$row[bus_id].'">'.$row[plate_no].'</td>
        				<td><input type="button" name="edit" id="'.$row[bus_id].'" value="Edit" class="btn btn-primary edit_data"></td></tr>';
        	}
        }else{
        	echo '<tr><td> No Data </td><td> No Data </td><td> No Data </td></tr>';
        }
        ?>
    </tbody>
</table>

<?php
mysqli_free_result($result_showbus);
mysqli_close($conn);

?>

<div id="add_data_Modal" class="modal fade">  
     <div class="modal-dialog">  
          <div class="modal-content">  
               <div class="modal-header">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    <h4 class="modal-title">Update Bus</h4>  
               </div>  
               <div class="modal-body">  
                    <form role="form"  action="update_bus.php" method="POST">  
                         <input type="text" name="busid" id="busid" hidden>
                         <label>Bus Plate</label>  
                         <input type="text" name="busplate" id="busplate" class="form-control" />  
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


 <script>
	$(document).ready(function(){   
	      $(document).on('click', '.edit_data', function(){  
           var bus = $(this).attr("id");
           var plate_no = document.getElementById('plateno'+bus).innerHTML;
           $('#add_data_Modal').modal('show');
           $('#busid').val(bus);
           $('#busplate').val(plate_no);
      });
	});  
</script>