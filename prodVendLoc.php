<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pick Ma Food</title>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="css/ProdVendLoc.css">
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
						<a href="cart.php" class="button">Cart</a>
						
						 <?php
					if(isset($_POST['vName2']))
					{
						$_SESSION["machID"] =$_POST['vName2'];
						unset($_SESSION["shopping_cart"]);
					}

					if(isset($_SESSION["machID"]))
					{
										$machID = $_SESSION["machID"];
				$sql = "SELECT p.*, mp.stock AS stock FROM product AS p,machineProd AS mp WHERE mp.machineID = '$machID' AND mp.productID = p.productID AND stock > 0";
				$res = mysqli_query($con,$sql);
				if (!$res) 
					{
					die('Error: ' . mysqli_error($con)); } 
				else
					{
						if(mysqli_num_rows($res)>0)
							{
							echo '<div class="row">';
							while($row = mysqli_fetch_array($res))
								{?>
								<div class="column">
								<div class = "box">
								<img src= "data:image/jpeg;base64, <?php echo base64_encode($row['image']); ?>"><br>
								<div class="content">
									<div class = "brand"> <?php echo  $row['brand']; ?> </div>
									<div class = "name"> <?php echo $row['productName']; ?></div>
								</div>
								<br><div class = add> <div class="price"> <?php echo $row['price']; ?> &nbsp;THB</div><br>
								<form  method = "post">
								<input type="number" name="quantity" value="1" min="1" max="<?php echo $row['stock']; ?>">
								<input type="hidden" name="id" value="<?php echo $row['productID']; ?>">
								<br><input class="button" type="submit" name="submit2" value="Add to cart">
								</form></div></div></div>

								<?php
								}
							}
					else
							{
							echo "No products available";	
							}
				}
					}
					else
					{
						echo "<script> window.location.href = 'selVendLoc.php';</script>";
					}

				if(isset($_POST['submit2'])) 
									{
										if(isset($_SESSION["shopping_cart"]))
										{
											$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
										if(!in_array($_POST["id"], $item_array_id))
											{
												$count = count($_SESSION["shopping_cart"]);
													$item_array = array(
													'item_id' => $_POST["id"],
													'order_quan' => $_POST["quantity"]);
													$_SESSION["shopping_cart"][$count] = $item_array;
										}

											
											else
											{
												echo '<script>alert("Item Already Added")</script>';
											}
										}
										else
										{
											$item_array = array('item_id' => $_POST["id"],
																'order_quan' => $_POST["quantity"]);
											$_SESSION["shopping_cart"][0] = $item_array;
											
										}
							}

mysqli_close($con);
?>
</div>
</body>
</html>