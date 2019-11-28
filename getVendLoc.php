?php 
include_once 'getVendLoc.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Select Vending Machine</title>
  <style>
    #map{
      height:800px;
    }
  </style>
</head>
<body>
<div id="map"></div>
<script>
  function initMap() {
  var myLatLng = {lat:13.65004,lng:100.49449};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: myLatLng
  });
  var red_icon =  'http://maps.google.com/mapfiles/ms/icons/red-dot.png' ;
  var marker = new google.maps.Marker({
                position: {lat:13.65004,lng:100.49449},//new google.maps.LatLng(locations[i][2], locations[i][3]),
                map: map,
                icon : red_icon
                //html: document.getElementById('form')
            });
}
 

</script>
</body>
</html>

<?php 
  $con=mysqli_connect('localhost','root','','pickmafood'); 
// Check connection 
  if (mysqli_connect_errno()) 
  { echo "Failed to connect to MySQL: " . mysqli_connect_error(); } 

    function getLoc(){

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
            while($r = mysqli_fetch_assoc($result)) 
              {
                $rows[] = $r;
              }
            $indexed = array_map('array_values', $rows);
            //  $array = array_filter($indexed);

              echo json_encode($indexed);
              if (!$rows) 
                {
                  return null;
                }
          }
      }
    }
mysqli_close($con);
?>


?php
  $j = 0;
  foreach ($rows as $k => $v) {
          ?>

                      var latitude = <?php echo $rows[$j]['lat']; ?>;
                var longitude = <?php echo $rows[$j]['lng']; ?>;
                      marker[c] = new google.maps.Marker({
                          position: new google.maps.LatLng(latitude,longitude), //
                          map: map,
                          title: '<?php echo $rows[$j]["name"]; ?>'
                      });
                      c = c + 1;
  <?php
  $j = $j + 1; 
    } ?>