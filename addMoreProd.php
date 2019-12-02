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

    <body>
    
        <div class="header">
            <h2>PICK MA FOOD</h2>
        </div>
        <a href="addMachProd.php">
        <div class="fa-time">
            <i class="fas fa-times"></i>
        </div></a>
        <div class="popup">
  <?php
   session_start();
      $con=mysqli_connect('localhost','root','','pickmafood'); 
      // Check connection 
      if (mysqli_connect_errno()) 
        { echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
              $machName = $_SESSION['machineName'];
              $sql = "SELECT * FROM machine WHERE machineName = '$machName'";
              $res = mysqli_query($con,$sql);
              if (!$res) 
                {
                die('Error: ' . mysqli_error($con)); } 
              else
                {
                  if(mysqli_num_rows($res)>0)
                    {
                    // echo '<div class="row">';
                    while($row = mysqli_fetch_array($res))
                      {?>
                      <?php 
                      echo "Machine: ". $row['machineName']. "<br> Machine Address: ". $row['lat']. ",". $row["lng"]; 
                      ?>
                      <?php
                      }
                    }
                else
                    {
                    echo "No machine is selected";	
                    }
              }
              mysqli_close($con);
    ?>
    </div>
        
<!-- <form action="addMachProd_db.php" method="post"> -->
<?php
// session_start();
$con=mysqli_connect('localhost','root','','pickmafood'); 
// Check connection 
if (mysqli_connect_errno()) 
	{ echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
				// if(isset($_POST['Done2']))
				// 	{
				// 	// $_POST["machName"] =$_POST['machineName'];
				// 	unset($_POST["shopping_cart"]);
                // 	}
				if(isset($_SESSION["machineName"]))
				{
                $machineName = $_SESSION["machineName"];
                $sql2 = "SELECT * FROM machine WHERE machineName='$machineName'";
                $res2 = mysqli_query($con,$sql2);
                $row2 = mysqli_fetch_array($res2);
                $machID = $row2["machineID"];
                // $machID = $res2;
                // $sql = "SELECT p.*, mp.stock AS stock FROM product AS p,machineProd AS mp WHERE mp.machineID = '$machID' AND mp.productID = p.productID AND stock > 0";
                // $sql = "SELECT p.*, mp.stock FROM product AS p,machineProd AS mp WHERE stock > 0";
                $sql = "SELECT DISTINCT p.* FROM product AS p, machineprod AS mp WHERE p.productID NOT IN (SELECT productID FROM machineprod AS mp WHERE mp.machineID = '$machID')";
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
                                
								<form  action="addMore_db.php" method = "post">
                                <?php $_SESSION['machineID'] = $machID;?>
								<input type="number" name="quantity" value="0" min="0" max="<?php echo $row['stock']; ?>">
								<input type="hidden" name="id" value="<?php echo $row['productID']; ?>">
                                <br>
                                <input  type="submit" name="submit2" value="Add to machine" class="edit-btn">
                                </form>
                                 </div></div>

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

    </body>
</html>