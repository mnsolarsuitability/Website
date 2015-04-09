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
      body {
        background-color: #FFF;
        overflow: hidden;
        font-family: "Trebuchet MS";
		width:670px;
		height:800px;
      }
    </style>
    <script src="http://js.arcgis.com/3.11/"></script>
    <script type="text/javascript" src="/lib/d3/d3.min.js"></script>
  <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
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
	  
	  
	  
	  
	  
	  function draw(data, dataAttr, max, div, title, titleOffset, titleModifier, chartWidth,chartHeight) {
		  
		  console.log("hiiii" + data);
	var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    titleOffset = parseInt(titleOffset);
	var margin = {
			"top": 0,
			"right": 5,
			"bottom": 50,
			"left": 30
		},
		width = chartWidth,
		height = chartHeight;
		barWidth = 20;

	var x = d3.scale.ordinal()
		.domain(months.map(function(d) {
			return d.substring(0, 3);}))
		.rangeRoundBands([0, width/2], 0);

	var y = d3.scale.linear()
	    // SET Y AXIS HEIGHT
		.domain([0, (max)])
		.range([height, 0]);

	var xAxis = d3.svg.axis()
	    .scale(x)
		.orient("bottom");

	var yAxis = d3.svg.axis()
	    .scale(y)
		.orient("left");

	var svgContainer = d3.select(div).append("svg")
		.attr("class", "chart")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom).append("g")
			.attr("transform", "translate(" + margin.left + "," + margin.right + ")");
	
	// CREATE TOOL TIP
	var tip = d3.tip()
	  .attr('class', 'd3-tip')
	  .offset([-10, 0])
	  .html(function(d) {
		return "<strong>Value:</strong> <span style='color:red'>" + parseFloat(d).toFixed(2) + "</span>";
		
	  })

	svgContainer.call(tip);

	svgContainer.append("g")
		.attr("class", "x axis")
		.attr("transform", "translate( 0," + height + ")")
		.call(xAxis)
		.selectAll("text")  
          .style("text-anchor", "end")
          .attr("dx", "-.8em")
          .attr("dy", ".15em")
          .attr("transform", function(d) {
              return "rotate(-65)" 
          });

	svgContainer.append("g")
		.attr("class", "y axis").call(yAxis)
		.append("text")
			.attr("x", (width / titleOffset + titleModifier))             
			.attr("y", 10)
			.attr("text-anchor", "center")  
			.style("font-size", "13px");
			//.text(title); 
			
	svgContainer.selectAll(".bar").data(dataAttr).enter().append("rect")
		.attr("class", "bar")
		.attr("x", function(d, i) {
			return i * x.rangeBand() + (x.rangeBand()/2) -(barWidth/2);
		})
		.attr("y", function(d) {
			return y(d);
		})
		.attr("width", barWidth)
		.attr("height", function(d) {
			return height -y(d);
		})
		.on('mouseover', tip.show)
		.on('mouseout', tip.hide)

 };
	  
	  
	  });  
	  
    </script>
</head>

<body <?php if($_REQUEST['p'] == 1) echo 'onLoad="javascript:window.print();"'; ?>>
<div style="margin:10px; background-color:#FFFFFF;">
<!--
<h2>Sample Report (Actual Report Coming Soon):</h2>
<img src="http://solar.maps.umn.edu/assets/img/fullReport.png" width="100%"> -->

<h2><img style="float:left; padding-right:10px;" src="assets/img/solar-app-transparent220x235.png" width="62" height="65" alt="MN Solar Logo"/>Minnesota Solar Suitability Location Report</h2>
<p><b>Latitude</b>: <?php echo $_REQUEST['lat']; ?> <b>Longitude: </b><?php echo $_REQUEST['long']; ?><br>
<div id="map"></div><div id="smap"></div>
<p>
<H3><strong>INSOLATION (kWh/m<sup>2</sup>):</strong></H3><p>Total per Year: <?php echo $_REQUEST['y']; ?><br />Avg per Day: <?php echo round($_REQUEST['y']/365,2); ?></p>

<?php if($_REQUEST['y'] < 1.7) {
								echo "<p>Location not optimal? Check out:<br /><a href='http://mncerts.org/solargardens' target='_blank'>Community Solar Gardens</a></p>";
							}else{
								echo "<p><a href='http://thecleanenergybuilder.com/directory#resultsType=both&page=0&pageNum=25&order=alphaTitle&proximityNum=60&proximityInput=" . substr($_REQUEST['z'],0,5) . "&textInput=&textSearchTitle=1&textSearchDescription=1&field_established=&field_employees=&field_year=&reload=false&mapSize=large&allResults=false&tids2=&tids3=568&tids4=&tids5=&tids6=' target='_blank'>Get Started: Contact a Local Installer</a></p>";
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
<div id="test"></div>
<script type="text/javascript">

var data = <?php echo $_REQUEST['m'];  ?>;

console.log(data.insolValue);
draw(data, data.insolValue, 465, "#test", "title",2,20,300,300);

</script>

</div>
</body>
</html>