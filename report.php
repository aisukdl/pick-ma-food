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
        <link rel="stylesheet" href="css/report.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:400,500,700&display=swap" rel="stylesheet">
    </head>

    <body>
    <?php
	$con = mysqli_connect("localhost","root","","pickmafood");
	if (mysqli_connect_errno()) 
	{ 
    echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
    ?>
        <div class="header">
            <h2>PICK MA FOOD</h2>
            <i class="fas fa-times"></i>
        </div>
        <div class="body-container">
                <h2>Report</h2>
                <div class="cont2">
                <form action = "report_db.php" method="POST">
                <p>Username: </p>
                <input type="text" placeholder="your username" name="username" required></input></div>
                <br>
                <div class="cont1">
                <br><p>Topic</p>
		                <select name="category" class="form-control">
			                <option value="pick">Type of report</option>
			            <?php
			            $sql = mysqli_query($con, "SELECT DISTINCT category From report");
			                while ($row = mysqli_fetch_array($sql)){
				                echo "<option value='". $row['category'] ."'>" .$row['category'] ."</option>" ;
			                }
                        ?>
                        </select><br><br>
                </div>
                <div class="cont2">
                    <p>Details</p>
                    <textarea name="description" rows="10" cols="30">Please, give some specific detail...
                    </textarea>
                </div>
                <button type="submit" class="submit-btn">SEND</button>
                </form>
        </div>
    </body>
</html>