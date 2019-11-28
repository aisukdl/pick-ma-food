<!DOCTYPE html>
<html>
<head>
	<title>All products</title>
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
<?php 

session_start();
$con=mysqli_connect('localhost','root','','pickmafood'); 
// Check connection 
if (mysqli_connect_errno()) 
	{ echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
	$sql = "SELECT * FROM product";
	$res = mysqli_query($con,$sql);
	if (!$res) 
		{
		die('Error: ' . mysqli_error($con)); } 
	else
	{
		if(mysqli_num_rows($res)>0)
							{
								while($row = mysqli_fetch_array($res))
									{ ?>
								<div class="column">
								<div class = "box">
								<img src= "data:image/jpeg;base64, <?php echo base64_encode($row['image']); ?>"><br>
								<div class="content">
									<div class = "brand"> <?php echo  $row['brand']; ?> </div>
									<div class = "name"> <?php echo $row['productName']; ?></div>
								</div>
								<br><div class = add> <div class="price"> <?php echo $row['price']; ?> &nbsp;THB</div>
								<form  method = "post" action="getMachLoc.php">
								<input type="hidden" name="id" value="<?php echo $row['productID']; ?>">
								<br><input class="button" type="submit" name="submit" value="Select">
								</form></div></div></div>
								<?php
								}
							}
	}

mysqli_close($con);
 ?>
</body>
</html>