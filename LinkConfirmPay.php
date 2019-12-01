<!DOCTYPE html>
<html>
<body>
    <?php 
     if(isset($_GET['sub'])) 
     {
        if(isset($_GET['pick']))
	    {
            
            header("Location:qrcode.php");
            
  
        }
        elseif(isset($_GET['credit']))
        {
         
            header("Location:creditcard.html");
        
        }
    }
  
?>

</body>
</html>
 </form>