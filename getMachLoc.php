<!DOCTYPE html>
<html>
<head>
	<title>Select Machine</title>
	    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 900px;
      }
    </style>
</head>
<body>
	<div id="map"></div>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcdvv5F6Ub6cqL644aR8VK3MW7YQcyCvE&callback=initMap">
    </script>
<?php
session_start();
if(isset($_POST['submit'])) 
 {
 	$_SESSION["prodID"] = $_POST['id'];
  $_SESSION["test"] = 1;
 	$pID = $_POST['id'];
 $con=mysqli_connect('localhost','root','','pickmafood'); 
// Check connection 
if (mysqli_connect_errno()) 
	{ echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 
	$sql = "SELECT * FROM machine AS m, machineprod AS mp WHERE mp.productID = '$pID' AND mp.machineID = m.machineID";
	$res = mysqli_query($con,$sql);
	if (!$res) 
		{
		die('Error: ' . mysqli_error($con)); } 
	else
	{
		if(mysqli_num_rows($res)>0)
          {
            $rows = array();
            $i = 0;
            while($row = mysqli_fetch_assoc($res)) 
              {
                $r = array('id' => $row['machineID'],
                  'name' => $row['machineName'],
            'lat' => $row['lat'],
            'lng' => $row['lng']);
                $rows[$i] = $r;
                $i = $i + 1; 
              }
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
        marker.setAnimation(null);
      }
    })(marker,i));
    }
}
     </script>
     	<form action="prodByProd.php" method="post" onsubmit="return midCheck();">
    <input type="hidden" name="vName2" id="vid">
    <br><br><input type="submit" id="sub" name="Done2" value="Select">
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
</script>
</body>
</html>