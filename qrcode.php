<?php
function qrco()
{
header('Content-Type: image/png');
    function randw($length=10)
    {
        $random = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"),0,$length);
        return $random;

    }
    $text = randw();
    $id = rand();
    $size = 300;
    $padding = 10;
    require_once 'C:\composer\vendor/autoload.php';
    $qr = new Endroid\QrCode\QrCode();
    $qr->setText($text);
    $qr->setSize($size);
    echo $qr->writeString();
if (mysqli_connect_errno()) 
{
	 echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
} 
   
    $con=mysqli_connect('localhost','root','','pickmafood'); 
    
    $orderID = $id;
    $qrData = $text;
    $status = "1";
    $sql="INSERT INTO otp VALUES ('','$qrData','$status')"; 
    //$sql="INSERT INTO orderinfo  VALUES ('','','','','$status')"; 
    $insert = mysqli_query($con,$sql);
    if (!$insert) 
	{
		 die('Error: ' . mysqli_error($con));
	} 
    mysqli_close($con); 
}
qrco();   
 ?>
 
