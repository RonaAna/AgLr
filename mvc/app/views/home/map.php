<?php
/**
 * Created by PhpStorm.
 * User: Ana-Maria
 * Date: 08.06.2018
 * Time: 22:14
 */?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="initial-scale=1.0", user-scalable="no">
    <meta charset="utf-8">
</head>
<html><body>
<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
   // function myMap() {
   //     var mapProp= {
   //         center:new google.maps.LatLng(47.173855, 27.574872),
   //         zoom:10,
   //     };
   //     var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
   // }
    function initMap() {
        var myLatLong =
            <?php
            echo "{lat:47.173855, lng:27.574872}";
            ?>

        var map = new google.maps.Map(document.getElementById('map')), {
            zoom: 12,
            center: myLatLong
        });


        <?php

        echo "
        var marker = new google.maps.Marker({
            position: {lat: $field->Latitude, lng: $field->Longitude },
            map: map,
            title: 'Your precious land'
        });";?>

        map.addListener('center_changed', function() {
               // 3 seconds after the center of the map has changed, pan back to the
               // marker.
               window.setTimeout(function() {
                   map.panTo(marker.getPosition());
               }, 3000);
           });

           marker.addListener('click', function() {
               map.setZoom(8);
               map.setCenter(marker.getPosition());
           });


    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV_6VE4X-HjAYqLgYi1S9Qv4BixerKAwc&callback=initMap"></script>

<?php

echo "
        var marker = new google.maps.Marker({
            position: {lat: $field->Latitude, lng: $field->Longitude },
            map: map,
            title: 'Your precious land'
        });";?></body>
</html>
