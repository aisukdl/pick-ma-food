<?php 
if(isset($_POST['vName3'])){
    //  session_start();
      $con=mysqli_connect('localhost','root','','pickmafood'); 
      // Check connection 
      if (mysqli_connect_errno()) 
        { echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
              $machID = $_POST['vName3'];
              $sql = "DELETE FROM machine WHERE machineId=$machID";
              $sql2 = "SELECT * FROM machine WHERE machineID = '$machID'";
              $res2 = mysqli_query($con,$sql2);
              $res = mysqli_query($con,$sql);
              
              if (!$res) 
                {
                die('Error: ' . mysqli_error($con)); } 
              else
                {
                  if($res)
                    {
                    // echo '<div class="row">';
                    while($row = mysqli_fetch_array($res2))
                      {
                        ?>
                      <?php 
                      header("Location: deleted.html"); /* Redirect browser */
                      
                      /* Make sure that code below does not get executed when we redirect. */
                      exit;
                      echo "Machine: ". $row['machineName']. " is deleted."; 
                      ?>
                      <?php
                      }
                    }
                else
                    {
                    echo "No machine is deleted";	
                    }
              }
              mysqli_close($con);
      }

?>