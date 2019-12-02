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
        <link rel="stylesheet" href="css/product.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:400,500,700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="header">
            <h2>Report Notification</h2>
        </div>
        <a href="staffmenu.php">
        <div class="fa-time">
            <i class="fas fa-times"></i>
        </div></a>
        <div class="table">
            <table>
            <thead>
                <tr>
                    <td>reportID</td>
                    <td>category</td>
                    <td>description</td>
                    <td>read status</td>
                </tr>
            </thead>
        

            <?php
            session_start();
            // Create connection
            $conn =mysqli_connect("localhost","root","","pickmafood");
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * FROM report WHERE staffID LIKE '".$_SESSION["uName"]."' LIMIT 1";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    ?>

                    <tr>
                    <td><?php echo $row['reportID']?></td>
                    <td><?php echo $row['category']?></td>
                    <td><?php echo $row['description']?></td>
                    <td><?php if($row['readStatus']==0){
                        echo "<p style='color:red;'>". "unread";
                    }
                    else{
                        echo "read";
                    }
                    // echo $row['readStatus']
                    ?></td>
                    </tr>

                    <?php

                    // echo "logid: " . $row["logId"]. " - machineId: " . $row["machineId"]. " - act: " . $row["activity"]. " - time: " . $row["time"]. "<br>";
                }
            }
            else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>    

    </body>
</html>