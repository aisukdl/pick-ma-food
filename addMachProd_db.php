<!DOCTYPE html>
<html>     
      <head>
                  <meta charset="UTF-8" />
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Pick Ma Food</title>
                  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                  <link rel="stylesheet" href="css/creditcard.css">
                  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
                  <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:400,500,700&display=swap" rel="stylesheet">
      </head>
<body>
<div class="header">
   <h2>PICK MA FOOD</h2>
</div>
<?php 
session_start();
$con=mysqli_connect("localhost","root","","pickmafood");

// Check connection 
if (mysqli_connect_errno()) 
	{ 
	echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
else
{

    // $machineId = mysqli_real_escape_string($con, $_POST['vName3']);
    // $lng = mysqli_real_escape_string($con, $_POST['lng']);
    // $name = mysqli_real_escape_string($con, $_POST['name']);
	// $sql="INSERT INTO machine (machineName,lat,lng) VALUES ('$name','$lat','$lng')"; 
	// if(isset($submit2)){
		$machID = $_SESSION["machineID"];
                // $sql2 = "SELECT * FROM machine WHERE machineName='$machineName'";
                // $res2 = mysqli_query($con,$sql2);
                // $row2 = mysqli_fetch_array($res2);
				// $machID = $row2["machineID"];
				
		$productID = $_POST["id"];
		// echo "<script> window.location.href = 'staffmenu.php';</script>";
		// $machID = $_SESSION["machID"]
		$quantity = $_POST["quantity"];
		$sql3="UPDATE machineprod SET stock= stock+'$quantity' WHERE machineID='$machID' AND productID='$productID'"; 
            if (!mysqli_query($con,$sql3)) 
            { 
            	die('Error: ' . mysqli_error($con));
				// exit;
			} 
            else
            {?>
				<div class="content">
					<br><br>
									<div class = "brand"> <?php echo  " Product is added"; ?> </div><br>
									<!-- <div class = "name"> <?php echo $row['productName']; ?></div> -->
								</div>
                <!-- echo " Product added". $machID. $productID. $quantity; -->
			<?php };
			
	// }
}


mysqli_close($con);

?>
          <a href="addMachProd.php">
          <button>BACK</button></a>
    </div>
</body>
</html>