<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no"/>
    <title>Test Chart</title>

    <script type='text/javascript' src='https://code.jquery.com/jquery-2.1.1.min.js'></script>

  <script type="text/javascript" src="/lib/d3/d3.min.js"></script>
  <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>

  <style>
  body {
  	background-color:#555555;
  }

  .chart rect {
		fill: #ff7400;
	}

  </style>
</head>

<body>

<div id="test">
</div>

<script>

var solData = <?php 
	
	if(isset($_REQUEST['m'])){

			echo $_REQUEST['m']; 

		} else {

			echo '{"month":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"insolValue":[11.3074254036,21.3921353366,59.7055400827,102.41932865199999,141.49145818600002,148.15530767,148.501556312,118.281530153,73.2630635271,30.2534353161,12.995365536900001,8.251301863819998],"sunHrValue":["101.846323529","108.167546859","187.510341692","230.421472563","258.670366778","257.619971264","264.52096687","244.442617482","209.243694996","130.222019216","101.322514125","94.0420168067"]}';
	}


	?>;

console.log(solData);

var solarMax = Math.max.apply(Math, solData.insolValue);

var params = ({
	// json object
	data:solData,
	// json category
    dataAttr:solData.insolValue,
    chartWidth:340,
    chartHeight:120,
    barWidth:8,
    max:solarMax,
    div:"#test",
    title:"This is a title",
    titleOffset: 2,
    titleModifier: 20,

});

//function draw(data, dataAttr, max, div, title, titleOffset, titleModifier) {
function draw(params) {
    titleOffset = parseInt(params.titleOffset);
	var margin = {
			"top": 5,
			"right": 5,
			"bottom": 50,
			"left": 50
		},
		width = params.chartWidth,
		height = params.chartHeight;
		barWidth = params.barWidth;

	var x = d3.scale.ordinal()
		.domain(params.data.month.map(function(d) {
			return d.substring(0, 3);}))
		.rangeRoundBands([0, width/2], 0);

	var y = d3.scale.linear()
	    // SET Y AXIS HEIGHT
		.domain([0, (params.max + 50)])
		.range([height, 0]);

	var xAxis = d3.svg.axis()
	    .scale(x)
		.orient("bottom");

	var yAxis = d3.svg.axis()
	    .scale(y)
		.orient("left");

	var svgContainer = d3.select(params.div).append("svg")
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
			.attr("x", (width / params.titleOffset + params.titleModifier))             
			.attr("y", 10)
			.attr("text-anchor", "center")  
			.style("font-size", "13px");
			//.text(params.title); 
			
	svgContainer.selectAll(".bar").data(params.dataAttr).enter().append("rect")
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
  console.log("Trying to draw!");

  draw(params);

</script>
</body>