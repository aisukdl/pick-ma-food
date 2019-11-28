<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<style>
	.content{
  width:200px;
  text-align: center;
  display:block;
  font-size: 20px;
  font-family: Arial, Helvetica, sans-serif;
  align-self: center;
	}
	.box{
  width: auto;
  height: 423px;
  margin: 80px auto;
  background: #FFFFFF;
  border-radius: 6px;
 
  display: flex;
  flex-direction: column;

	}	
img {
  max-width:210px;
  max-height: 280px;
  float: center;
  align-self: center;
}
.column {
  float: left;
  width: 350px;
  padding: 5px;
}

/* Clear floats after image containers */
.row::after {
  content: "";
  clear: both;
  display: table;
  align-self: center;
}
.add{
	align-self: center;
	align-items: center;
	text-align: center;
	font-size: 16px;
	border: none;
	font-family: Arial, Helvetica, sans-serif;
	}
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
	</style>
</head>
<body>
	 <a href="cartLoc.php" class="button">Cart</a>
<?php
session_start();
$con=mysqli_connect('localhost','root','','pickmafood'); 
// Check connection 
if (mysqli_connect_errno()) 
	{ echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
				if(isset($_POST['Done2']))
					{
					$_SESSION["machID"] =$_POST['vName2'];
					unset($_SESSION["shopping_cart"]);
					}
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
</body>
</html>