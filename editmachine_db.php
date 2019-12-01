<?php 

$con=mysqli_connect("localhost","root","","pickmafood");

// Check connection 
if (mysqli_connect_errno()) 
	{ 
	echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
else
{

    $oldName = mysqli_real_escape_string($con, $_POST['oldName']);
    $newName = mysqli_real_escape_string($con, $_POST['newName']);
    // $userName = mysqli_real_escape_string($con, $_POST['vName2']);
    $lat = mysqli_real_escape_string($con, $_POST['lat']);
    $lng = mysqli_real_escape_string($con, $_POST['lng']);
    if($newName=="" && $lat!=NULL)
    {
        $sql="UPDATE machine SET lat='$lat', lng='$lng' WHERE machineName = '$oldName'";
    }
    else if($lat==NULL){
        $sql="UPDATE machine SET machineName = '$newName' WHERE machineName = '$oldName'";
    }
    else{
        $sql="UPDATE machine SET machineName = '$newName', lat='$lat', lng='$lng' WHERE machineName = '$oldName'";
    }
    if (!mysqli_query($con,$sql)) 
    { 
        die('Error: ' . mysqli_error($con)); 
    } 
    else
    {
        header("Location: updated.html"); /* Redirect browser */
                      
          /* Make sure that code below does not get executed when we redirect. */
        exit;
        echo $oldName ."is updated to ". $newName;
    }
    
    // $sql="INSERT INTO report (category,description,userName,staffID) VALUES ('$category','$description2','$userName','$staffId')"; 
    
}


mysqli_close($con);

?>