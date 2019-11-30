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
        <link rel="stylesheet" href="css/order.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:400,500,700&display=swap" rel="stylesheet">
    </head>
    <body>
            <?php 
            session_start();
            $con=mysqli_connect('localhost','root','','pickmafood'); 
            // Check connection 
            if (mysqli_connect_errno()) 
                { echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
            ?>
        <div class="header">
            <h2>PICK MA FOOD</h2>
            <i class="fas fa-times"></i>
        </div>
        <!--เริ่มลูปphpตรงนี้-->
        <div class="products">
            <div class="image">
                /*รูป*/
            </div>
            <div class="price">
                /*ชื่อ+ราคา*/ <br>
                <i class="fas fa-minus-circle"></i>/*เลขจำนวน*/<i class="fas fa-plus-circle"></i>
            </div>
        </div>
        <!--จบลูป-->
        <button type="button" class="find-btn">CHECKOUT</button>
    </body>
</html>