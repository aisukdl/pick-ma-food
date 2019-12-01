<?php 

$con=mysqli_connect("localhost","root","","pickmafood");

// Check connection 
if (mysqli_connect_errno()) 
	{ 
	echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
else
{

    $category = mysqli_real_escape_string($con, $_POST['category']);
    $description2 = mysqli_real_escape_string($con, $_POST['description']);
    $userName = mysqli_real_escape_string($con, $_POST['username']);
    $sql="INSERT INTO report (category,description,userName,staffID) VALUES ('$category','$description2','$userName',1)"; 
    if (!mysqli_query($con,$sql)) 
	{ 
	die('Error: ' . mysqli_error($con)); } 
	else
	{
		echo $category ." , ". $description2;
	}
}


mysqli_close($con);

?>