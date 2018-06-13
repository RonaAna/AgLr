<?php
/**
 * Created by PhpStorm.
 * User: Ana-Maria
 * Date: 08.06.2018
 * Time: 22:14
 */?>

<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
    function myMap() {
        var mapProp= {
            center:new google.maps.LatLng(51.508742,-0.120850),
            zoom:5,
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV_6VE4X-HjAYqLgYi1S9Qv4BixerKAwc&callback=myMap"></script>