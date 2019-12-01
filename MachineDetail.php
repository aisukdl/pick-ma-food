<!DOCTYPE html>
<body>
<?php
session_start();
$con=mysqli_connect('localhost','root','','pickmafood'); 
    if(!empty($_SESSION["shopping_cart"]))
    {
        $mid = $_SESSION["machID"];
        $res = mysqli_query($con,"SELECT machineName,machineID FROM `machine` WHERE machineID = $mid");
        
        if ($res) 
                {
                    $row = mysqli_fetch_array($res);
                    echo "Machine Name = ". $row['machineName']." machineID = ". $row['machineID'];
                } 
            else
                {
        
                    die('Error: ' . mysqli_error($con));
            
                }
            
    }
?>
</body>				
</html>

