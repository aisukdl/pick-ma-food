<!DOCTYPE html>
<html>
<head>
	<title>Cart</title>
	<style>
		.button {
  float: right;
  background-color: #e7e7e7;
  border: none;
  color: black;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  font-family: Arial, Helvetica, sans-serif;
}
input[type=submit] {
  float: right;
  background-color: #e7e7e7;
  border: none;
  color: black;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  font-family: Arial, Helvetica, sans-serif;

}
img{
	width: 100px;
	height: 100px;
}
table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 15px;
  font-family: Arial, Helvetica, sans-serif;
}
		
	</style>
</head>
<body>
 <a href="prodVendLoc.php" class="button">Back</a>
<?php 
session_start();
$con=mysqli_connect('localhost','root','','pickmafood'); 
// Check connection 
if (mysqli_connect_errno()) 
	{ echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
?>
<div class="table-responsive">
<table class="table table-bordered">
					<tr>
						<th width="20%">Image</th>
						<th width="40%">Item</th>
						<th width="5%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
<?php 

if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						$mid = $_SESSION["machID"];
						foreach($_SESSION["shopping_cart"] as $keys => $values)
							{
							$pID = $values["item_id"];
							$res = mysqli_query($con,"SELECT p.*,mp.stock AS stock FROM product AS p ,machineProd AS mp WHERE p.productID = '$pID' AND mp.machineID = '$mid' AND p.productID = mp.productID AND stock>0");
							if (!$res) 
								{
								die('Error: ' . mysqli_error($con)); } 
							else
								{
									$row = mysqli_fetch_array($res);
									echo "<tr>";?>
									<td><img src= "data:image/jpeg;base64,<?php echo base64_encode($row['image']);?>"></td>
									<?php
									echo "<td>". $row['brand']." ". $row['productName']. "</td>";
									echo "<td><form method='post'><input type='number' name='quan' id='q' value='". $values['order_quan']. "' min='1' max=".$row["stock"]. "><br>";
									echo "<input type='hidden' name='pid' value='".$pID."'>";
									echo "<input type= 'submit' name='sub' value='update'></form></td>";
									echo "<td>". $row['price']." THB</td>";
									$tot = 0;
									$tot = number_format($values["order_quan"] * $row['price'], 2);
									echo "<td>". $tot ." THB</td>";?>
									<td> <a href='cartLoc.php?action=delete&id=<?php echo $pID; ?>'> <span class='text-danger'> Remove </span></a></td>
									<?php
									$total = $total + $tot;
									echo "</tr>";
								}
							}
							echo "<tr>";
							echo "<td colspan='4' align='right'> Total </td>";
							echo "<td align='right'>". number_format($total,2)." THB</td>";
							echo "<td></td>";
							echo "</tr>";
				}
				
	if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="cartLoc.php"</script>';
			}
		}
	}
}
if(isset($_POST["sub"]))
{
	foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_POST["pid"])
			{
				$_SESSION["shopping_cart"][$keys]["order_quan"] = $_POST["quan"];
				?>
				<script> document.getElementById("q").value = <?php echo $_POST["quan"]; ?></script>
				<?php
				echo '<script>window.location="cartLoc.php"</script>';
			}
		}
}

mysqli_close($con);
 ?>
 </table>
 <form action="Orderdb.php" method = "post">
	 <input type="hidden" name="tot" value="<?php echo $total;?>">
	 <input  type="submit"  name="sub" value="Confirm Order">
 </form>


</div>

</body>
</html>