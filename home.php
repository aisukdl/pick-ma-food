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
        <link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:400,500,700&display=swap" rel="stylesheet">
    </head>
    <body>
      <?php 
      session_start();
      $con=mysqli_connect('localhost','root','','pickmafood'); 
      // Check connection 
      if (mysqli_connect_errno()) { echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
      if(isset($_SESSION["user"]))
      {
     ?>
      <!--Nav Bar-->
      <nav class="navbar nav navbar-expand-lg navbar-light bg-custom">
        <a class="navbar-brand" href="#">PICK MA FOOD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php">My Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Report</a> <!--unn's report link-->
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Settings</a>
            </li>
          </ul>
        </div>
      </nav>

      <!--Body-->
      <div class="body-container">
        <img class="vending-machine" src="images/vending-machine.png">
        <h2>Find your favorite food from vending machine near you. Order now! </h2>
        <div class="findbox">

            <form action="selVendName.php" method="post">
            <input type="text" placeholder="Enter machine location" name="vendName" required>
            <i class="fas fa-location-arrow" onclick="vendLoc()"></i>
            <button type="submit" class="find-btn" name="submit">Find</button>
            </form>
            <a href="allProd.php">
            <p>or Find by product </p></a>
        </div>
      </div>
      <?php
    }
       mysqli_close($con); ?>
       <script>
        function vendLoc()
        {
          window.location.href = 'selVendLoc.php';
        }
         
       </script>
    </body>
</html>