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
        <link rel="stylesheet" href="css/stafffind.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:400,500,700&display=swap" rel="stylesheet">
    </head>

    <!--////////////////////////////-->
    <body>
      <a href="staffmenu.php">
          <div class="fa-time">
          <i class="fas fa-times"></i>
        </div>
        </a>
        <div class="header">
            <h2>View Machine</h2>
              
        </div>
        
        <div class="body-container">
        <div class="map">
          Select Machine<br>
          <div id="map" style="height: 300px; width: 82%; margin: auto; border: 1px;" ></div>
        </div>
        
        <!-- item in machine box -->
        <script>
          function midCheck3(){
            alert('You clicked the top text');
          }
        </script>
        </div>

    <!--////////////////////////////-->
    <!-- <div id="map"></div> -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcdvv5F6Ub6cqL644aR8VK3MW7YQcyCvE&callback=initMap">
    </script>
      <?php 
         $con=mysqli_connect('localhost','root','','pickmafood'); 
    // Check connection 
      if (mysqli_connect_errno()) 
      { echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 

     $sql = "SELECT machineID,machineName,lat,lng FROM machine";
     $result = mysqli_query($con,$sql);
     if (!$result) 
      {
      die('Error: ' . mysqli_error($con)); }
    else
      {
      if(mysqli_num_rows($result)>0)
          {
            $rows = array();
            $i = 0;
            while($res = mysqli_fetch_assoc($result)) 
              {
                $r = array('id' => $res['machineID'],
                  'name' => $res['machineName'],
            'lat' => $res['lat'],
            'lng' => $res['lng']);
                $rows[$i] = $r;
                $i = $i + 1; 
              }
          }
      }
mysqli_close($con); 
?>
    <script>
      var map;
      var mID = 0;
        function initMap() {
         map = new google.maps.Map(document.getElementById('map'), {
          center:{lat:13.65004,lng:100.49449}, 
          zoom: 15
        });
        var marker;
        var locations = [[]];
        var c = 0;
        var ti;
      <?php
	     foreach ($rows as $k => $v) {
          ?>
                      var data = <?php echo $v["id"]; ?>;
		        	    		var latitude = <?php echo $v['lat']; ?>;
								      var longitude = <?php echo $v['lng']; ?>;
                      locations.push([data,latitude,longitude]);
		        	    		/*marker = new google.maps.Marker({
		            	        position: new google.maps.LatLng(latitude,longitude), //
                          title: "<?php /*echo $v["id"]; */?>",
		            	        map: map
		            	    });
                      markerArray.push(marker);*/
	<?php
		} ?>
    for (var i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
                          position: new google.maps.LatLng(locations[i][1],locations[i][2]), //
                          map: map
                      });
    var infoWindow = new google.maps.InfoWindow;
    google.maps.event.addListener(marker,'click',(function(marker,i){
      return function(){
        //console.log(locations[i][0]);
        marker.setAnimation(google.maps.Animation.BOUNCE);
        mID = locations[i][0];
        document.getElementById('vid').value = mID ;
        document.getElementById('vid2').value = mID ;
        marker.setAnimation(null);
      }
    })(marker,i));
    }
}
     </script>
    
  <form method="post" onsubmit="return midCheck();">
    <input type="hidden" name="vName2" id="vid">
      <input type="submit" name="button1" value="Machine Detail" class="edit-btn">
    <br>
    <br>
  </form>
</script>
  
  <div class="popup">
  <?php
   if(isset($_POST['vName2'])){
    //  session_start();
      $con=mysqli_connect('localhost','root','','pickmafood'); 
      // Check connection 
      if (mysqli_connect_errno()) 
        { echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
              $machID = $_POST['vName2'];
              $sql = "SELECT * FROM machine WHERE machineID = '$machID'";
              $res = mysqli_query($con,$sql);
              if (!$res) 
                {
                die('Error: ' . mysqli_error($con)); } 
              else
                {
                  if(mysqli_num_rows($res)>0)
                    {
                    // echo '<div class="row">';
                    while($row = mysqli_fetch_array($res))
                      {?>
                      <?php 
                      echo "Machine: ". $row['machineName']. "<br> Machine Address: ". $row['lat']. ",". $row["lng"]; 
                      ?>
                      <?php
                      }
                    }
                else
                    {
                    echo "No machine is selected";	
                    }
              }
              mysqli_close($con);
      }
    ?>
    </div>
    
    <form action="stafffind_db.php" method="post" onsubmit="return midCheck2();">
    <br>
      <input type="hidden" name="vName3" id="vid2">
      <input type="submit" name="DELETE1" value="Delete" class="delete-btn">
    </form>

    <form action="editmachine.php" method="post" onsubmit="return midCheck2();">
    <input type="hidden" name="serialNumber" id="vid2">
    <!-- <input type="text" name="serialNumber" /> -->
      <input type="submit" name="addProd" value="Edit" class="edit-btn" >
    <br>
    <br>
    </form>

<script>    
    function midCheck()
    {
     var check = document.getElementById('vid').value;
     // console.log("no"+check);
      if(check=="")
      {
        // console.log("So done");      
        alert("Please select vending machine"); 
        return false;      
      }
      return true;
    }

    function midCheck2()
    {
     var check = document.getElementById('vid2').value;
     // console.log("no"+check);
      if(check=="")
      {
        // console.log("So done");      
        alert("Please select vending machine again before click delete button."); 
        return false;      
      }
      return true;
    }
    </script>
  </body>
</html>