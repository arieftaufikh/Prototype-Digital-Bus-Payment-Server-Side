<script type="text/javascript">
	$(document).ready(function(){   
	      $(document).on('click', '.edit_data', function(){  
           var fare_id = $(this).attr("id");
           var fare = document.getElementById('fare'+fare_id).innerHTML;
           $('#add_data_Modal').modal('show');
           $('#txtfare_id').val(fare_id);
           $('#txtfare').val(fare);

      });
	}); 
</script>

 <script>
	 $(document).ready(function(){
	 	$(document).on('click','.edit_data', function(){
	 		var fare_id = $(this).attr("id");
	 		$.ajax({
	 			url:"fetch.php",
	 			method:"POST",
	 			data:{fare_id:fare_id},
	 			dataType:"json",
	 			success:function(data){
	 				$('#txtfare_id').val(data.fare_id);
	 				$('#txtfare').val(data.fare);
	 				$('#add_data_Modal').modal('show');
	 			}
	 		})
	 	})
	 })
</script>