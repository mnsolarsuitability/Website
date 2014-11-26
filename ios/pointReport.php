<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no"/>
    <title>Simple Map</title>
    <link rel="stylesheet" href="http://js.arcgis.com/3.11/esri/css/esri.css">
    <style>
      #map, #smap {
        height: 200px;
        width: 300px;
        margin: 10px 5px 10px 5px;
        padding: 0;
		display: inline-block;
      }
      body, #results {
        background-color: #FFF;
        overflow: hidden;
        font-family: "Trebuchet MS";
		width:670px;
      }
    </style>
    <script src="http://js.arcgis.com/3.11/"></script>
    <script>
	    var map;
      require([
        "esri/map",

        "esri/layers/ArcGISTiledMapServiceLayer",
        "esri/layers/ImageServiceParameters",
        "esri/layers/ArcGISImageServiceLayer",

        "esri/toolbars/draw",
        "esri/graphic",
        "esri/geometry/Point",

        "esri/symbols/SimpleMarkerSymbol",
        "esri/symbols/SimpleLineSymbol",
        "esri/symbols/SimpleFillSymbol",
    
    "esri/SpatialReference",

        "esri/geometry/screenUtils",
        "esri/urlUtils",
        "esri/config",
        "esri/request",

        "esri/dijit/Geocoder",
        "esri/dijit/HomeButton",
        "esri/dijit/LocateButton",

        "dojo/parser",
        "dojo/dom",
        "dojo/dom-construct",
        "dojo/query",
        "dojo/_base/Color",

        "dojo/on",
        "dojo/dom-class",
        "dojo/_base/json",
        "dijit/registry",

        "esri/tasks/query",
        "esri/tasks/QueryTask",
        "esri/dijit/BasemapToggle",
        "esri/InfoTemplate",
    
    "esri/geometry/webMercatorUtils",
    "esri/tasks/GeometryService",

        "dijit/layout/BorderContainer", "dijit/layout/ContentPane",
        "dijit/form/Button", "dojo/domReady!"], function (
    Map,
    Tiled, ImageServiceParameters, ArcGISImageServiceLayer,
    Draw, Graphic, Point,
    SimpleMarkerSymbol, SimpleLineSymbol, SimpleFillSymbol,
  SpatialReference,
    screenUtils, urlUtils, esriConfig, esriRequest,
    Geocoder, HomeButton, LocateButton,
    parser, dom, domConstruct, query, Color,
    on, domClass, dojoJson, registry, Query, QueryTask, BasemapToggle, InfoTemplate,
  webMercatorUtils, GeometryService) {
        parser.parse();

        smap = new Map("smap", {
          basemap: "topo",
          center: [<?php echo $_REQUEST['long']; ?>, <?php echo $_REQUEST['lat']; ?>],
          zoom: 18,
		  showAttribution: false,
        });

        var params = new ImageServiceParameters();
        params.noData = 0;
        var imageServiceLayer = new ArcGISImageServiceLayer("http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/Solar/ImageServer/", {
          imageServiceParameters: params,
        });
        smap.addLayer(imageServiceLayer);
      
       
	    map = new Map("map", {
          basemap: "hybrid",
          center: [<?php echo $_REQUEST['long']; ?>, <?php echo $_REQUEST['lat']; ?>], // longitude, latitude
          zoom: 18,
		  showAttribution: false,
        });
		
		// Create graphic(s) for display
		// Setup a pin symbol to show current insolation measurement lcoation        
        var pinSymbol = new esri.symbol.PictureMarkerSymbol({
            "angle":0,
			"xoffset":2,
			"yoffset":8,
			"type":"esriPMS",
			"url":"http://static.arcgis.com/images/Symbols/Shapes/BluePin1LargeB.png",
			"contentType":"image/png",
			"width":30,
			"height":30
        });
       
	  
		
		map.on("load", function () {
			var loc = new esri.geometry.Point ([<?php echo $_REQUEST['long']; ?>, <?php echo $_REQUEST['lat']; ?>], new esri.SpatialReference({wkid:4326}));
		
		graphic = new Graphic(loc, pinSymbol);
	
			map.graphics.add(graphic);
		});
		smap.on("load", function () {
			var loc = new esri.geometry.Point ([<?php echo $_REQUEST['long']; ?>, <?php echo $_REQUEST['lat']; ?>], new esri.SpatialReference({wkid:4326}));
		
		graphic = new Graphic(loc, pinSymbol);
		
			smap.graphics.add(graphic);

      pixelQuery(loc);

		});
      

function pixelQuery(mapPoint) {
      
      // Clear results div
      $("#results").html("");
    
            //setup insolation query
            var query = new Query();
            var queryTask = new QueryTask(imgIdentifyURL);
            query.geometry = mapPoint;
            query.geometryType = "esriGeometryPoint";
            query.mosaicRule = "";
            query.sr = 102100;
            query.imageDisplay = 1;
            query.tolerance = 1;
            query.returnGeometry = false;
            query.returnZ = false;
            query.returnM = false;
            query.f = "pjson";

            //setup bare earth county layer query
            var BEquery = new Query();
            var BEQueryTask = new QueryTask(bareEarthCountyURL);
            BEquery.geometry = mapPoint;
            BEquery.geometryType = "esriGeometryPoint";
            BEquery.outFields = ["bare_earth","COUNTYNAME"];
            BEquery.spatialRelationship = query.SPATIAL_REL_INTERSECTS;
            BEquery.mosaicRule = "";
            BEquery.sr = 102100;
            BEquery.imageDisplay = 1;
            BEquery.tolerance = 1;
            BEquery.returnGeometry = false;
            BEquery.returnZ = false;
            BEquery.returnM = false;
            BEquery.f = "pjson";

            BEQueryTask.execute(BEquery, function (results) {
        
                //first make sure clicked point is within the state
                if (results.features && results.features.length > 0) {
          
                    bareEarth = results.features[0].attributes["bare_earth"];
                    county = results.features[0].attributes["COUNTYNAME"];

                    //then check if clicked point is within a bare earth county, if so add disclaimer
                    if (bareEarth === 1) {
                        var warning = "**";
                        var warningMsg = "<p>**<span id='smText'>The lidar data available for " + county + " County includes only bare earth points. Hence, this insolation value does not take shade from nearby surface features into consideration.</span></p>";
            
              if(county == "Pine") {
                var warningMsg = "<p>**<span id='smText'>The lidar data available for " + county + " County was inconsistently classified across different flight lines. Hence, insolation accuracy is variable as shade from nearby surface features may not be taken into consideration.</span></p>";
              }
                 
                    } else {
                        var warning = "";
                        var warningMsg = "";
                    }

                    queryTask.execute(query, function (results) {

                        var val = results.value;
                        var v = val / 1000 / 365;
                        var y = val / 1000;
                        var quality = 0;
                        switch (true) {
                            case (v > 2.7):
                                quality = "Optimal";
                                break;
                            case (v < 1.7):
                                quality = "Poor";
                                break;
                            default:
                                quality = "Good";
                                break;
                        }

            var result = '<div class="resultsTopicTitle">INSOLATION (kWh/m2)</div><div class="resultsDisplay">Total per Year: ' + y.toFixed(2) + warning + '<br>Avg per Day: ' + v.toFixed(2) + ' (' + quality + ')' + warning + warningMsg +'</div>';
            
            $("#results").html(result);

            //setup Utility Service Provider query
                        var query = new Query();
                        var queryTask = new QueryTask(eusaURL);
                        query.geometry = mapPoint;
                        query.geometryType = "esriGeometryPoint";
                        query.outFields = ["*"];
                        query.spatialRelationship = query.SPATIAL_REL_INTERSECTS;
                        query.mosaicRule = "";
                        query.sr = 102100;
                        query.imageDisplay = 1;
                        query.tolerance = 1;
                        query.returnGeometry = false;
                        query.returnZ = false;
                        query.returnM = false;
                        query.f = "pjson";

                        queryTask.execute(query, function (results) {
 
                            fullname = results.features[0].attributes["FULL_NAME"];
                            city = results.features[0].attributes["CITY"];
                            street = results.features[0].attributes["STREET"];
                            phone = results.features[0].attributes["PHONE"];
                            website = results.features[0].attributes["WEBSITE"];
                            elec_comp = results.features[0].attributes["ELEC_COMP"];
                            zip = results.features[0].attributes["ZIP"];
              
              var utility = encodeURIComponent(fullname + "_" + street + "_" + city + ", MN " +zip + "_" + phone);
              
              if(quality == "Poor") {
                var getstarted = "<p>Location not optimal? Check out:<br /><a href='http://mncerts.org/solargardens' target='_blank'>Community Solar Gardens</a></p>";
              }else{
                var getstarted = "<p><a href='http://thecleanenergybuilder.com/directory#resultsType=both&page=0&pageNum=25&order=alphaTitle&proximityNum=60&proximityInput=" + zip + "&textInput=&textSearchTitle=1&textSearchDescription=1&field_established=&field_employees=&field_year=&reload=false&mapSize=large&allResults=false&tids2=&tids3=568&tids4=&tids5=&tids6=' target='_blank'>Get Started: Contact a Local Installer</a></p>";
              }

                            var result ='<div class="resultsTopicTitle">Utility Service Provider:</div><div class="resultsDisplay">' + fullname + ' ' + phone + '</div>';

              document.getElementById('results').innerHTML = document.getElementById('results').innerHTML + result;
              //console.log(e.mapPoint);
              //point = webMercatorUtils.webMercatorToGeographic(e.mapPoint);
              //resultsiFrameURL = "http://solar.maps.umn.edu/report.php?w=" + website + "&long=" + point['x'] + "&lat=" + point['y'] + "&y="+ y.toFixed(2) + "&u=" + utility;
              //console.log(resultsiFrameURL);
                        });
                    });


                } else {
            // clicked point is outside of the state
                    var result = "<H3><strong>INSOLATION (kWh/m<sup>2</sup>)</strong></H3><p>Total per Year: Unknown**<br />Avg per Day: Unknown**</p><p>**<span id='smText'>This point is out of the study area. Click within the State of Minnesota or try searching for something like 'Target Field'.</span></p><span class='closeSplash'>(X) CLOSE</span> </p>";
                    alert("This location is outside of the study area. Please refine your search to be limited to the state of Minnesota.");
                }
               
            });
      

        };
      });
    </script>

    <!-- Required JavaScript -->

  <script type='text/javascript' src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
  <script type="text/javascript" src="/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/lib/d3/d3.min.js"></script>
  <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
  <script src="https://apis.google.com/js/client.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;libraries=places"></script>
    <script type="text/javascript">
    var basemapURL = 'http://services.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/';  //imagery basemap
    var imgDisplayURL = 'http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/Solar/ImageServer/';  //solar data for display
    var imgIdentifyURL = imgDisplayURL + 'identify';  //solar data for querying insolation
    var vectorDataURL = 'http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/solar_fgdb/MapServer/';
    var bareEarthCountyURL = vectorDataURL + '1';  //vector layer for identifying counties with only bare earth lidar
    var eusaURL = vectorDataURL + '0';  //utility service providers vector layer
  </script>

  <script type='text/javascript' src="http://js.arcgis.com/3.9/"></script>
</head>

<body <?php if($_REQUEST['p'] == 1) echo 'onLoad="javascript:window.print();"'; ?>>
<div style="margin:10px; background-color:#FFFFFF;">
<!--
<h2>Sample Report (Actual Report Coming Soon):</h2>
<img src="http://solar.maps.umn.edu/assets/img/fullReport.png" width="100%"> -->

<h2>Minnesota Solar Suitability Location Report:</h2>
<p><b>Latitude</b>: <?php echo $_REQUEST['lat']; ?> <b>Longitude: </b><?php echo $_REQUEST['long']; ?><br>
<div id="map"></div><div id="smap"></div>
<p>
<H3><strong>INSOLATION (kWh/m<sup>2</sup>):</strong></H3><p>Total per Year: <?php echo $_REQUEST['y']; ?><br />Avg per Day: <?php echo round($_REQUEST['y']/365,2); ?></p>

<?php if($_REQUEST['y'] < 1.7) {
								echo "<p>Location not optimal? Check out:<br /><a href='http://mncerts.org/solargardens' target='_blank'>Community Solar Gardens</a></p>";
							}else{
								echo "<p><a href='http://thecleanenergybuilder.com/directory#resultsType=both&page=0&pageNum=25&order=alphaTitle&proximityNum=60&proximityInput=" . substr($_REQUEST['z']) . "&textInput=&textSearchTitle=1&textSearchDescription=1&field_established=&field_employees=&field_year=&reload=false&mapSize=large&allResults=false&tids2=&tids3=568&tids4=&tids5=&tids6=' target='_blank'>Get Started: Contact a Local Installer</a></p>";
							}
?>
</p>

<p><b>Utility Service Proider:</b><br>
<?php echo str_replace("_","<br>",$_REQUEST['u'])."<br>"; ?> 
<a href="http://<?php echo $_REQUEST['w']; ?>" target="_blank"><?php echo $_REQUEST['w']; ?><a/>
</p>
<?php if($_REQUEST['p'] == "") { ?>
<p>
<a href="<?php echo $_SERVER['REQUEST_URI']."&p=1"; ?>">
<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"

	 width="26px" height="25px" viewBox="0 0 16 15" enable-background="new 0 0 16 15" xml:space="preserve">

<g>

	<path d="M4,12v3h8v-3v-2H4V12z M5,11h6v1H5V11z M5,13h6v1H5V13z"/>

	<polygon points="12,3 12,0 4,0 4,3 4,5 12,5 	"/>

	<path d="M14,3h-1v2v1H3V5V3H2C1,3,0,4,0,5v5c0,1,1,2,2,2h1v-2V9h10v1v2h1c1,0,2-1,2-2V5C16,4,15,3,14,3z"/>

</g>

</svg></a>
</p>
<?php } ?>
<script type="text/javascript">

//var data = <?php echo $_REQUEST['m'];  ?>;

//console.log(data.insolValue);

</script>
</div>
<div id="results"></div>
</body>
</html>