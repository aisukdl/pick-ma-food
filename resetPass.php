<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset Form</title>
</head>
<body>
	<form method="post">
			<label>New password</label>
			<input type="password" name="new_pass" required><br><br>
			<label>Confirm new password</label>
			<input type="password" name="new_pass_c" required>
			<button type="submit" name="new_password">Submit</button>
		</div>
	</form>
<?php  
	session_start();
	$con=mysqli_connect('localhost','root','','pickmafood'); 
	// Check connection 
	if (mysqli_connect_errno()) 
	{ echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
	if (isset($_POST['new_password']) && isset($_SESSION["mail"])) {
  $new_pass = mysqli_real_escape_string($con, $_POST['new_pass']);
  $new_pass_c = mysqli_real_escape_string($con, $_POST['new_pass_c']);
  // Grab to token that came from the email link
  $email = $_SESSION["mail"];
  if ($new_pass !== $new_pass_c)
  {
  	 echo '<script>alert("Password do not match")</script>';
  	 echo '<script>window.location="index.html"</script>';
  }
  else
  {
  	$email = $_SESSION["mail"];
  	$sql = "UPDATE user SET password='$new_pass' WHERE email='$email'";
    $res = mysqli_query($con, $sql);
    if(!$res)
	{
		die('Error: ' . mysqli_error($con)); }
	else
	{
		echo '<script>window.location="index.html"</script>';
	}

  }
}
mysqli_close($con);
?>
</body>
</html>
