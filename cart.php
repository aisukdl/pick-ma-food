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
	 <a href="prodInVend.php" class="button">Back</a>
<?php 

$con=mysqli_connect('localhost','root','','pickmafood'); 
// Check connection 
if (mysqli_connect_errno()) 
	{ echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
session_start();
?>
<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					//show products in cart
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_brand"]." ". $values["item_name"]; ?></td>
						<td><?php echo $values["order_quan"]; ?></td>
						<td> <?php echo $values["item_price"]; ?>&nbsp;THB</td>
						<td><?php echo number_format($values["order_quan"] * $values["item_price"], 2);?>&nbsp;THB</td>
						<td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["order_quan"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right"> <?php echo number_format($total, 2); ?>&nbsp;THB</td>
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
			</div>

<?php 
// for deleting product from cart
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
				echo '<script>window.location="cart.php"</script>';
			}
		}
	}
}

mysqli_close($con);
 ?>
</body>
</html>