<?php 
if (mysqli_connect_errno()) 
{
	 echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
} 
	$con=mysqli_connect('localhost','root','','pickmafood'); 
	
	//$id = mysqli_real_escape_string($con,$_POST['id']);
	
	$name = mysqli_real_escape_string($con,$_POST['name']);
	$cardNo = mysqli_real_escape_string($con,$_POST['cardNo']);
	$expMM = mysqli_real_escape_string($con,$_POST['expMM']);
	$expYYYY = mysqli_real_escape_string($con,$_POST['expYYYY']);
	$cvv = mysqli_real_escape_string($con,$_POST['cvv']);
	$payMethod = "Creditcard" ; 
    
	$sql="INSERT INTO payment VALUES ('','$name','$cardNo','$expMM','$expYYYY','$cvv')";  
    $insert = mysqli_query($con,$sql);

	if (!$insert) 
	{die('Error: ' . mysqli_error($con));} 
	else 
	{echo ("QRCODE!");}

	$sql1="INSERT INTO orderinfo VALUES ('','','','$payMethod','')";  
    $insert = mysqli_query($con,$sql1);

	if (!$insert) 
	{die('Error: ' . mysqli_error($con));} 
	else 
	{echo ("QRCODE!");}

	?>
<!DOCTYPE html>
<html>
<body>
	<form action="qrcodee.html">
		<br><br> "Continue" to get QR code<br>
		<a href="qrcodee.html"></a><button>Continue</button></a>
</form>
</body>
</html>
 
 
  