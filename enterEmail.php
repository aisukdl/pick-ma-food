<!DOCTYPE html>
<html>
<head>
      <head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Pick Ma Food</title>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="css/creditcard.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:400,500,700&display=swap" rel="stylesheet">
		<title>Password Reset</title>
</head>
<body>
<div class="header">
            <h2>PICK MA FOOD</h2>
      </div>
      <div class="body-container">
	<form  method="post">
			<label><p2>Enter email address:</p2></label><br>
			<input type="email" name="email" required>
			<button type="submit" name="reset">Submit</button>
	</form>
</div>

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