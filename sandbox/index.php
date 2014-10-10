<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>MN Solar Suitability Analysis App</title>
<link rel="shortcut icon" href="/solar/images/favicon.ico" />
<link rel="stylesheet" type="text/css" href="http://js.arcgis.com/3.9/js/esri/css/esri.css">
<link href="../solar.css" rel="stylesheet" type="text/css">

<!-- Google Analytics Tracking Snippet -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-36981530-2', 'auto');
  ga('send', 'pageview');
</script>

</head>
<body>
<div id="SplashScreen">
  <h3>WELCOME</h3>
  <p>Tap anywhere on this map of Minnesota to view solar radiation per square meter, or tap the <img src="/solar/images/locate_button.jpg" height="30px"/> icon to measure insolation at your current location. </p>
  <div id="colorRamp"> <strong>LEGEND:</strong> <img src="/solar/images/ramp_v2.png" style="padding-top:8px;max-width:250px;"/><br />
  </div>
  <div id="website">
    <p><strong>LEARN MORE:</strong><br />
      <a href="http://solarp.uspatial.umn.edu" style="color:#ff7400">solarp.uspatial.umn.edu</a> </p>
    <p> <br />
      <span id='closeSplash'>(X) CLOSE</span> </p>
  </div>
</div>
<div id="search"></div>
<div id="r"></div>
<div id="HomeButton"></div>
<div id='currentLoc'>&nbsp;</div>
<div id="BasemapToggle"></div>
<div id="HelpMe">?</div>
<div id="map" data-dojo-type="dijit/layout/ContentPane" data-dojo-props="region:'center'"> <a href="http://solarp.uspatial.umn.edu" target="_blank"><img src="/solar/images/UMN_M_white.gif" alt="University of Minnesota" id="umnLogo" /></a> </div>
<script type="text/javascript">
var basemapURL = 'http://services.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/';  //imagery basemap

<?php if($_REQUEST['IS'] == "new"){ ?>
var imgDisplayURL = 'http://gis.uspatial.umn.edu/arcgis/rest/services/solar/Solar/ImageServer/';  //solar data for display
var imgIdentifyURL = imgDisplayURL + 'identify';  //solar data for querying insolation
var vectorDataURL = 'http://gis.uspatial.umn.edu/arcgis/rest/services/solar/solar_vector/MapServer/';
var bareEarthCountyURL = vectorDataURL + '1';  //vector layer for identifying counties with only bare earth lidar
var eusaURL = vectorDataURL + '2';  //utility service providers vector layer
<?php } else { ?>
var imgDisplayURL = 'http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/SolarP_ISv2/ImageServer';  //solar data for display
var imgIdentifyURL = 'http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/SolarP_IS/ImageServer/identify';  //solar data for querying insolation
var bareEarthCountyURL = 'http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/solar_fgdb/MapServer/1';  //vector layer for identifying counties with only bare earth lidar
var eusaURL = 'http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/solar_fgdb/MapServer/0';  //utility service providers vector layer
<?php } ?>
</script>
<script type='text/javascript' src='http://code.jquery.com/jquery-2.0.2.js'></script> 
<script type='text/javascript' src="http://js.arcgis.com/3.9/"></script> 
<script type='text/javascript' src="../solar.js"></script>
</body>
</html>
