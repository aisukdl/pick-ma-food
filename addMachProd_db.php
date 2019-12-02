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
		$machID = $_SESSION['machineID'];
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
            {
                echo " Product added". $machID. $productID. $quantity;
            };
	// }
}


mysqli_close($con);

?>