<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php 
error_reporting(E_PARSE);

$sql_showuser = "SELECT user.username,user.password,user.phone_number,user.fullname,user.email,role.role_name FROM user JOIN role ON user.role_id=role.role_id";
$result_showuser = $conn->query($sql_showuser);

if ($result_showuser->num_rows > 0) {
	while ($row = $result_showuser->fetch_assoc()) {
		echo '<tr>
				<td>'.$row[username].'</td>
				<td>'.$row[phone_number].'</td>
				<td>'.$row[fullname].'</td>
				<td>'.$row[email].'</td>
				<td>'.$row[role_name].'</td>
				<td><input type="button" name="edit" id="'.$row[username].'" value="Edit" class="btn btn-primary edit_data"></td>
			</tr>';
	}
}

?>

<div id="update_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Edit User</h4>  
                </div>  
                <div class="modal-body">  
                     <form role="form" action="update_user.php" method="post">  
                          <label>Username</label>  
                          <input type="text" name="user" id="user" class="form-control" readonly />  
                          <br /> 
                          <label>Phone Number</label>  
                          <input type="text" name="phonenumber" id="phonenumber" class="form-control" />  
                          <br /> 
                          <label>Full Name</label>  
                          <input type="text" name="fullname" id="fullname" class="form-control" />  
                          <br /> 
                          <label>Email</label>  
                          <input type="email" name="email" id="email" class="form-control" />  
                          <br /> 
                          <label>Role</label>  
                          <select class="form-control" name="roleid" id="roleid" class="form-control">
                              <?php require('show_role.php') ?>
                          </select>
                          <br />
                          <input type="hidden" name="username" id="username">  
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
 		$(document).on('click', '.edit_data',function(){
 			var username = $(this).attr("id");
 			$.ajax({
 				url:"fetch_user.php",
 				method:"POST",
 				data:{username:username},
 				dataType:"json",
 				success:function(data){
 					$('#user').val(data.username)
 					$('#username').val(data.username);
 					$('#phonenumber').val(data.phone_number);
 					$('#fullname').val(data.fullname);
 					$('#email').val(data.email);
 					$('#roleid').val(data.role_id);
 					$('#update_data_Modal').modal('show');
 				}
 			});
 		});
 	})
 </script>

<?php

mysqli_free_result($result_showuser);
mysqli_close($conn);

?>