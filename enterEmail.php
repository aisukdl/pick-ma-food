<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset</title>
</head>
<body>
	<form  method="post">
			<label>Enter email address:</label><br>
			<input type="email" name="email" required>
			<button type="submit" name="reset">Submit</button>
	</form>

	<?php 
	session_start();
		$con=mysqli_connect('localhost','root','','pickmafood'); 
	// Check connection 
	if (mysqli_connect_errno()) 
	{ echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 

	if (isset($_POST['reset'])) {
  	$email = mysqli_real_escape_string($con, $_POST['email']);
  	// ensure that the user exists on our system
  	$query = "SELECT email FROM user WHERE email='$email'";
  	$results = mysqli_query($con, $query);

	if(!$results)
	{
		die('Error: ' . mysqli_error($con)); }

	else
	{
	$row = mysqli_fetch_array($results);
	if($row <= 0) {
	    echo '<script>alert("Sorry, no user exists on our system with that email")</script>';
	  }
	 else
	 {
	 	$_SESSION["mail"] = $email;
	    echo '<script>window.location="resetPass.php"</script>';
	 }
	}


}

mysqli_close($con);
	 ?>
</body>
</html>