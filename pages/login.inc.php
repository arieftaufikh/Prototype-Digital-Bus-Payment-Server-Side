<?php 

require_once 'connection.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$query_login = "SELECT username,password FROM user WHERE username='$username' AND password='$password' AND role_id=1";

$query_login_result = $conn->query($query_login);
$login_num = $query_login_result->num_rows;

if ($login_num==0) {
	echo 'Username / Password Salah';
	header('location: login.php');
	$_SESSION['incorect']=1;
}else if ($login_num==1) {
	echo 'Login Berhasil';
	header('location: index.php');
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['password'] = $_POST['password'];
}

mysqli_free_result($query_login_result);
mysqli_close($conn);

?>