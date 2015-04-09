<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Single marker</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.css' rel='stylesheet' />
<style>
  body { margin:0; padding:0; }
  #map { position:absolute; top:0; bottom:0; width:100%; }
</style>
</head>
<body>
<div id='map'></div>

<script>
L.mapbox.accessToken = 'pk.eyJ1IjoibWFwYm94IiwiYSI6IlhHVkZmaW8ifQ.hAMX5hSW-QnTeRCMAy9A8Q';
var map = L.mapbox.map('map', 'examples.map-igb471ik')
    .setView([<?php echo $_REQUEST['lat']; ?>, <?php echo $_REQUEST['long']; ?>], 16);

L.mapbox.featureLayer({
    // this feature is in the GeoJSON format: see geojson.org
    // for the full specification
    type: 'Feature',
    geometry: {
        type: 'Point',
        // coordinates here are in longitude, latitude order because
        // x, y is the standard for GeoJSON and many formats
        coordinates: [
          <?php echo $_REQUEST['long']; ?>,
          <?php echo $_REQUEST['lat']; ?> 
        ]
    },
    properties: {
        'marker-size': 'medium',
        'marker-color': '#006bfc'
    }
}).addTo(map);
</script>
</body>
</html>