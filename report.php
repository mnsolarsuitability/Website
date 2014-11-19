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
        margin: 20px 10px 20px 20px;
        padding: 0;
		 display: inline-block;
      }
      body {
        background-color: #FFF;
        overflow: hidden;
        font-family: "Trebuchet MS";
      }
    </style>
    <script src="http://js.arcgis.com/3.11/"></script>
    <script>
	    var map;
      require([
        "esri/map", "esri/layers/GraphicsLayer", "esri/layers/ArcGISImageServiceLayer", 
        "esri/layers/ImageServiceParameters", "esri/geometry/Point",
        "esri/symbols/PictureMarkerSymbol", "esri/symbols/SimpleMarkerSymbol", "esri/graphic", "dojo/parser", "dojo/domReady!"
      ], function(
        Map, GraphicsLayer, ArcGISImageServiceLayer, Point, PictureMarkerSymbol, SimpleMarkerSymbol,
        ImageServiceParameters, Graphic, parser
      ) {
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
		});
      });
    </script>
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
</div>
</body>
</html>