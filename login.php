<!DOCTYPE html>
<html>
<head>
	<title>Login Authentication</title>
</head>
<body>
<?php 
session_start();
$con=mysqli_connect('localhost','root','','pickmafood'); 
// Check connection 
if (mysqli_connect_errno()) 
	{ echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
if(isset($_POST['login']))
{
	$uname = mysqli_real_escape_string($con,$_POST['uname']);
	$pass = mysqli_real_escape_string($con,$_POST['psw']);
	$sql = "SELECT * FROM user WHERE userName LIKE '$uname' AND password LIKE '$pass' LIMIT 1";
	$res = mysqli_query($con,$sql);
	if (!$res) 
	{
	die('Error: ' . mysqli_error($con));
	 } 
	 else
	 {
	 	if(mysqli_num_rows($res)>0)
	 	{
	 		$_SESSION["user"] = $uname;
	 		echo "<script> window.location.href = 'home.php';</script>";
	 	}
	 	else
	 	{
	 	$sql2 = "SELECT * FROM staff WHERE staffID LIKE '$uname' AND password LIKE '$pass' LIMIT 1";
		$res2 = mysqli_query($con,$sql2);	
		if (!$res2) 
			{
			die('Error: ' . mysqli_error($con));
	 		} 
	 	else
		 	{
		 		if(mysqli_num_rows($res2)>0)
	 				{
	 					$_SESSION["uName"] = $uname;
	 					echo "<script> window.location.href = 'staffmenu.php';</script>";
	 				}
	 			else
	 			{
	 				echo '<script>alert("Username or Password incorrect")</script>';
	 				echo "<script> window.location.href = 'index.html';</script>";
	 			}
		 	}
	 	}
	 }
}
mysqli_close($con);
 ?>
</body>
</html>