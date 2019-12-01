<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pick Ma Food</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/staffmenu.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:400,500,700&display=swap" rel="stylesheet">
    </head>
    <body>
        <h2>Welcome!</h2>
        <div class="avatar">
                /*คิวรี่รูป*/
        </div>
        <?php 
        session_start();
        $con=mysqli_connect('localhost','root','','pickmafood'); 
        // Check connection 
        if (mysqli_connect_errno()) 
            { echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
        if(isset($_SESSION["uName"]))
            {
                $sql = "SELECT * FROM staff WHERE staffID LIKE '".$_SESSION["uName"]."' LIMIT 1";
                $res = mysqli_query($con,$sql);
                if (!$res) 
                    {
                        die('Error: ' . mysqli_error($con));
                     } 
                else
                    {
                        if(mysqli_num_rows($res)==1)
                        {
                            $row = mysqli_fetch_assoc($res);
                            ?>

                           
        <h2><?php echo $row['fName']." ". $row['lName']; ?></h2>
        <p>Staff Id: <?php echo $_SESSION["uName"]; ?></p>
         <?php
                        }
                    }
            } 
            mysqli_close($con);
            ?>
        <div class="cont2">
            <div class="cont1">
            <a href="viewlog.php">
                    <div class="menu">
                            <i class="far fa-file-alt fa-4x"></i>
                            <p>VIEW LOG</p>
                    </div></a>
                    <a href="addmachine.php">
                    <div class="menu">
                            <i class="fas fa-plus fa-3x"></i><br>
                            <p>ADD MACHINE</p>
                    </div></a>
            </div>
            <div class="cont1">
            <a href="stafffind.php">
                    <div class="menu">
                            <i class="fas fa-search fa-3x"></i>
                            <p>VIEW MACHINE</p>
                    </div></a>
                    <a href="addMachProd.php">
                    <div class="menu">
                            <i class="fas fa-box fa-4x"></i>
                            <p>PRODUCTS</p>
                    </div></a>
            </div>
            <div class="cont1">
            <a href="report.php">
                    <div class="menu">
                            <i class="fas fa-exclamation-circle fa-4x"></i>
                            <p>REPORT</p>
                    </div></a>
                    <a href="login.php">
                    <div class="menu">
                    <i class="fas fa-power-off fa-4x"></i>
                            <p>LOGOUT</p>
                    </div></a>
            </div>
            
        </div>
    </body>
</html>