<!DOCTYPE HTML>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pick Ma Food</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/addmachine.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:400,500,700&display=swap" rel="stylesheet">
    </head>
    <!-- //////////////////////////////////////////////////////// -->
  <body>
    <h1>Add Machine</h1>
    <form action="addMach_db.php" method="POST">
    <div class="body-container">
        <br><br>
        <p>Machine Name</p>
        <input type="text" placeholder="character and number only" name="name" required>
        <br><br>
        <p>Machine Location</p>
    </div>
    <div id="map" style="height: 400px; width: 80%; margin: auto; border: 1px;" ></div>
    <br><br>

    <script>
    function initMap() {
    var myLatLng = {lat:13.75398,lng:100.50144};

    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: myLatLng
    });

    var marker = new google.maps.Marker({
    map: map,
    });

    function placeMarker(location) {
      if ( marker ) {
        marker.setPosition(location);
      } 
      else {
        marker = new google.maps.Marker({
        position: location,
        map: map
      });
      }
      document.getElementById("lat").value = marker.getPosition().lat();
      document.getElementById("lng").value = marker.getPosition().lng();
    }

    google.maps.event.addListener(map, 'click', function(event) {
      placeMarker(event.latLng);
      });
  }
  </script>

  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBSlFwDENLjlvH50LPo9uWSGv57HtWWgA&callback=initMap">
  </script>

  <?php ?>
    <input type="hidden" name="lat" id = "lat">
    <input type="hidden" name="lng" id = "lng">
    <br><br>
    <div class="submit-b">
      <button type="submit" class="submit-btn">CONFIRM</button>
    </div> 
    </form>
  <?php ?>
</body>
</html>