<?php
session_start();
$con=mysqli_connect('localhost','root','','pickmafood'); 
// Check connection 
if (mysqli_connect_errno()) { echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
if(isset($_POST['sub']))
{
$total = mysqli_real_escape_string($con,$_POST['tot']);
// echo $total;
$sql="INSERT INTO orderinfo  VALUES ('','','$total','','')";
$insert = mysqli_query($con,$sql);
if (!$insert) { die('Error: ' . mysqli_error($con)); } 
else{ echo ("total added!");
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		$id = $values["item_id"];
		$quantity = $values["order_quan"];
		$sql1="INSERT INTO orderprod  VALUES ('','$id','$quantity')";
		$insert = mysqli_query($con,$sql1);
		if (!$insert) { die('Error: ' . mysqli_error($con)); } 
		else {echo ("quantity added");}
	}
		//$total =  $total + ($values["order_quan"] * $values["item_price"]);
	}
}
// foreach($_SESSION["shopping_cart"] as $keys => $values)
// {
// 	$quantity = $values["order_quan"];
// 	$total =  $total + ($values["order_quan"] * $values["item_price"]);
// }

mysqli_close($con);
 ?>

</body>
</html>