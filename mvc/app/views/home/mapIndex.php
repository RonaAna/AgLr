<?php
/**
 * Created by PhpStorm.
 * User: Ana-Maria
 * Date: 17.06.2018
 * Time: 19:30
 */?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Rectangle Events</title>
    <style>
/* Always set the map height explicitly to define the size of the div
 * element that contains the map. */
#map {
height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      // This example adds a user-editable rectangle to the map.
      // When the user changes the bounds of the rectangle,
      // an info window pops up displaying the new bounds.

      var rectangle;
      var map;
      var infoWindow;

      function initMap() {
          map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 47.1740186, lng: 27.5728553},
          zoom: 15
        });

        var bounds = {
            north: 47.192538515859276,
            south:  47.17915497975445,
            east: 27.558025079345725,
            west:  27.547126391601523
        };

        // Define the rectangle and set its editable property to true.
        rectangle = new google.maps.Rectangle({
          bounds: bounds,
          editable: true,
          draggable: true
        });

        rectangle.setMap(map);

        // Add an event listener on the rectangle.
        rectangle.addListener('bounds_changed', showNewRect);

        // Define an info window on the map.
        infoWindow = new google.maps.InfoWindow();
      }
      // Show the new coordinates for the rectangle in an info window.

      /** @this {google.maps.Rectangle} */
      function showNewRect(event) {
          var ne = rectangle.getBounds().getNorthEast();
          var sw = rectangle.getBounds().getSouthWest();

          var contentString = '<b>Rectangle moved.</b><br>' +
              'New north-east corner: ' + ne.lat() + ', ' + ne.lng() + '<br>' +
              'New south-west corner: ' + sw.lat() + ', ' + sw.lng();

          // Set the info window's content and position.
          infoWindow.setContent(contentString);
          infoWindow.setPosition(ne);

          infoWindow.open(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV_6VE4X-HjAYqLgYi1S9Qv4BixerKAwc&callback=initMap">
    </script>
  </body>
</html>