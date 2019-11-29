<!DOCTYPE html>
<html>
<head>
	<title>Search By Name</title>
</head>
<body>
<?php
session_start();
$con=mysqli_connect('localhost','root','','pickmafood'); 
// Check connection 
if (mysqli_connect_errno()) 
	{ echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
if(isset($_POST['submit']) && isset($_SESSION["user"]))
	{
	$vendName = mysqli_real_escape_string($con, $_POST['vendName']);
	$result = mysqli_query($con,"SELECT * FROM machine WHERE machineName LIKE '%$vendName%'");
	if (!$result) { die('Error: ' . mysqli_error($con)); } 
	else
		{
		if(mysqli_num_rows($result)>0)
			{
			echo "<form action='prodInVend.php' method='post'>";
			while($row1 = mysqli_fetch_array($result)) 
 				{ 
 				echo "<input type='radio' name='vName' value = '".$row1['machineID']."' required>".$row1['machineName']. " <br>";
 				} 
			echo "<br><input type='submit' name='Done' value='Done'> </form>";
			}
		else
			{
			echo "<br> Machine Not Found";
			}
		}
	}

 mysqli_close($con); 
 ?>
</body>
</html>