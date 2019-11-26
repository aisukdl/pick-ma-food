<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Select Vending Machine</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 900px;
      }
    </style>
  </head>

<html>
  <body>
    <div id="map"></div>
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
        mID = locations[i][0];
        document.getElementById('vid').value = mID ;
      }
    })(marker,i));
    }
}
     </script>
	<form action="prodVendLoc.php" method="post" onsubmit="return midCheck();">
    <input type="hidden" name="vName2" id="vid">
    <br><br><input type="submit" id="sub" name="Done2">
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