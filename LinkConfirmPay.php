<!DOCTYPE html>
<html>
<body>
    <?php 
   
        if(isset($_GET['sub'])) 
        { 
        if($_GET['radio']=='pick')
	    {
            
            header("Location:qrcode.php");
            
  
        }
        elseif($_GET['radio']=='credit')
        {
         
            header("Location:creditcard.html");
        
        }
    }

   else
   {
       echo "error";
   }
?>

</body>
</html>
 </form>