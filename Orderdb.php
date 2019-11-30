<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
session_start();
$con=mysqli_connect('localhost','root','','pickmafood'); 
// Check connection 
if (mysqli_connect_errno()) { echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
if(isset($_POST['sub']) && isset($_SESSION["user"]))
{
$total = mysqli_real_escape_string($con,$_POST['tot']);
// echo $total;
$uid = $_SESSION['user'];
$sql="INSERT INTO orderinfo (userName,total,payMethod)  VALUES ('$uid','$total','NONE')";
$insert = mysqli_query($con,$sql);
if (!$insert) { die('Error: ' . mysqli_error($con)); } 
else{ 
	$sqlID = "SELECT orderID FROM orderinfo WHERE userName LIKE '$uid' ORDER BY orderID DESC LIMIT 1";
	$res = mysqli_query($con,$sqlID);
	if(mysqli_num_rows($res)==1)
	{
		$result = mysqli_fetch_assoc($res);
		foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		$id = $values["item_id"];
		$quantity = $values["order_quan"];
		$sql1="INSERT INTO orderprod (orderID,productID,quantity)  VALUES ('".$result["orderID"]."','$id','$quantity')";
		$insert1 = mysqli_query($con,$sql1);
		if (!$insert1) { die('Error: ' . mysqli_error($con)); } 
	
	}
			$_SESSION["orderID"] = $result["orderID"];
			echo '<script>window.location="payment.html"</script>';
	}
		
	}
}
mysqli_close($con);
 ?>

</body>
</html>
