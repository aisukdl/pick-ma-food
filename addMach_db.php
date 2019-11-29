<?php 

$con=mysqli_connect("localhost","root","","pickmafood");

// Check connection 
if (mysqli_connect_errno()) 
	{ 
	echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
else
{

    $lat = mysqli_real_escape_string($con, $_POST['lat']);
    $lng = mysqli_real_escape_string($con, $_POST['lng']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $sql="INSERT INTO machine (machineName,lat,lng) VALUES ('$name','$lat','$lng')"; 
    if (!mysqli_query($con,$sql)) 
	{ 
	die('Error: ' . mysqli_error($con)); } 
	else
	{
		echo $lat ." , ". $lng;
	}
}


mysqli_close($con);

?>