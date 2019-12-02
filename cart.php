<!DOCTYPE html>
<html>
<head>
	<title>Cart</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pick Ma Food</title>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="css/order.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:400,500,700&display=swap" rel="stylesheet">
</head>
<body>
<div class="header">
            <h2>PICK MA FOOD</h2>
            <i class="fas fa-times"></i>
</div>
<div class="body-container">
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
$total = 0;
if(!empty($_SESSION["shopping_cart"]))
					{
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
									<td><img src= "data:image/jpeg;base64,<?php echo base64_encode($row['image']);?>" class="image"></td>
									<?php
									echo "<td>". $row['brand']." ". $row['productName']. "</td>";
									echo "<td><form method='post'><input type='number' name='quan' id='q' value='". $values['order_quan']. "' min='1' max=".$row["stock"]. "><br>";
									echo "<input type='hidden' name='pid' value='".$pID."'>";
									echo "<input type= 'submit' name='sub' value='update'></form></td>";
									echo "<td>". $row['price']." THB</td>";
									$tot = 0;
									$tot = number_format($values["order_quan"] * $row['price'], 2);
									echo "<td>". $tot ." THB</td>";?>
									<td> <a href='cart.php?action=delete&id=<?php echo $pID; ?>'> <span class='text-danger'> Remove </span></a></td>
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
				echo '<script>window.location="cart.php"</script>';
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
				echo '<script>window.location="cart.php"</script>';
			}
		}
}
mysqli_close($con);
 ?>
 </table>
 <?php if($total>0)
{
?>
<form action="Orderdb.php" method = "post">
	 <input type="hidden" name="tot" value="<?php echo $total;?>">
	 <input  type="submit"  name="sub" value="Confirm Order">
 </form>
<?php } ?>
</div>
</div>
</body>
</html>
