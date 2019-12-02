<!DOCTYPE HTML>
<html>
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
      float: center;
      background: #FFFFFF;
      border-radius: 6px;
      float: center;
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
      float: center;
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
      font-family: Arial, Helvetica, sans-serif
    }
        </style>
    <!-- ///////////////////////////////////// -->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pick Ma Food</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/stafffind.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:400,500,700&display=swap" rel="stylesheet">
    </head>

    <?php
	$con = mysqli_connect("localhost","root","","pickmafood");
	if (mysqli_connect_errno()) 
	{ 
    echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
    ?>

    <body>
    
        <div class="header">
            <h2>PICK MA FOOD</h2>
        </div>
        <a href="staffmenu.php">
        <div class="fa-time">
            <i class="fas fa-times"></i>
        </div></a>

        <form method="post">
        <div class="body-container">
            <p>Machine Name</p>
            <!-- <input type="text" placeholder="character and number only" name="mname" required> -->
            <select name="machineName" class="form-control">
			                <option value="pick">select machine</option>
			            <?php
			            $sql = mysqli_query($con, "SELECT DISTINCT machineName From machine");
			                while ($row = mysqli_fetch_array($sql)){
				                echo "<option value='". $row['machineName'] ."'>" .$row['machineName'] ."</option>" ;
			                }
                        ?>
            </select>
            <button type="submit" class="edit-btn">SELECT</button><br><br>
            <p>Products</p>
            <a href="addMore.php">+ add more product</a>            
        </div>
        </form>
        
<!-- <form action="addMachProd_db.php" method="post"> -->
<?php
// session_start();
$con=mysqli_connect('localhost','root','','pickmafood'); 
// Check connection 
if (mysqli_connect_errno()) 
	{ echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
				if(isset($_POST['Done2']))
					{
					// $_POST["machName"] =$_POST['machineName'];
					unset($_POST["shopping_cart"]);
                	}
				if(isset($_POST["machineName"]))
				{
                $machineName = $_POST["machineName"];
                $sql2 = "SELECT * FROM machine WHERE machineName='$machineName'";
                $res2 = mysqli_query($con,$sql2);
                $row2 = mysqli_fetch_array($res2);
                $machID = $row2["machineID"];
                // $machID = $res2;
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
								<!-- <div class="column"> -->
								<div class = "box">
								<img src= "data:image/jpeg;base64, <?php echo base64_encode($row['image']); ?>"><br>
								<div class="content">
									<div class = "brand"> <?php echo  $row['brand']; ?> </div>
									<div class = "name"> <?php echo $row['productName']; ?></div>
								</div>
                                <br><div class = add> <div class="price"> <?php echo $row['price']; ?> &nbsp;THB</div><br>
                                
								<form  method = "post">
								<input type="number" name="quantity" value="0" min="0" max="<?php echo $row['stock']; ?>">
								<input type="hidden" name="id" value="<?php echo $row['productID']; ?>">
                                <br>
                                <input  type="submit" name="submit2" value="Add to machine" class="edit-btn">
                                <input  type="submit" name="submit3" value="Delete" class="delete-btn">
                                </form>
                                <?php
                                
                                // $submit2=$_POST["submit2"];
                                if(isset($submit2)){
                                    $productID = $_POST["id"];
                                    echo "<script> window.location.href = 'staffmenu.php';</script>";
                                
                                $quantity = $_POST["quantity"];
                                echo " Product added". $machID. $productID. $quantity;}?>
                                </div></div>
                                
                                
                            <!-- </div> -->

                            <?php
                                
                            //     $sql3="UPDATE machineprod SET stock= stock+'$quantity' WHERE machineID='$machID' AND productID='$productID'"; 
                            //     if (!mysqli_query($con,$sql3)) 
                            //     { 
                            //     die('Error: ' . mysqli_error($con));
                            //  exit;} 
                            //     else
                            //     {
                            //         echo " Product added". $machID. $productID. $quantity;
                            //     }
                                }
								// }
							}
					else
							{
							echo "No products available";	
							}
				}
				}
				else
				{
                    echo "Please, select machine.";
					// echo "<script> window.location.href = 'addMachProd.php';</script>";
				}
				if(isset($_POST["test"]))
				{
					if(isset($_POST['submit2'])) 
									{
										if(isset($_POST["shopping_cart"]))
										{
											$item_array_id = array_column($_POST["shopping_cart"], "item_id");
										if(!in_array($_POST["id"], $item_array_id))
											{
												$count = count($_POST["shopping_cart"]);
													$item_array = array(
													'item_id' => $_POST["id"],
													'order_quan' => $_POST["quantity"]);
                                                    $_POST["shopping_cart"][$count] = $item_array;
										}

											
											else
											{
												echo '<script>alert("Item Already Added")</script>';
											}
										}
							}
					else
										{
											$item_array = array('item_id' => $_POST["prodID"],
																'order_quan' => 1);
											$_POST["shopping_cart"][0] = $item_array;
											//unset($_POST["prodID"]);
										}
					unset($_POST["test"]);
				}

mysqli_close($con);
?>
<div class="popup">
<a href="cart.php" class="edit-btn">Add to machine</a></div>
<!-- <form action="addMachProd_db.php" method="post">
    <input type="hidden" name="pName" id="machineName">
    <input type="hidden" name="vName3" id="machineName">
    <button type="submit" class="submit-btn">CONFIRM</button>
</form> -->

    </body>
</html>