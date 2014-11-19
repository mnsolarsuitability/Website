<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no"/>
    <title>Test Chart</title>

    <script type='text/javascript' src='https://code.jquery.com/jquery-2.1.1.min.js'></script>

  <script type="text/javascript" src="/lib/d3/d3.min.js"></script>
  <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
</head>

<body>

<div id="test">
  Test here
</div>

<script>

var data = {
			
				"month": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				"insolValue":[1,2,3,4,5,6,6,5,4,3,2,1],
				//"sunHrValue":[sunHrResults[0],sunHrResults[1],sunHrResults[2],sunHrResults[3],sunHrResults[4],sunHrResults[5],sunHrResults[6],sunHrResults[7],sunHrResults[8],sunHrResults[9],sunHrResults[10],sunHrResults[11]]
			}

var solarMax = 6;

var params = ({
	// json object
	data:"data",
	// json category
    dataAttr:"insolValue",
    chartWidth:400,
    chartHeight:300,
    barWidth:10,
    max:solarMax,
    div:"test",
    title:"This is a title",
    titleOffset: 2,
    titleModifier: 20,

});

//function draw(data, dataAttr, max, div, title, titleOffset, titleModifier) {
function draw(params) {
    titleOffset = parseInt(titleOffset);
	var margin = {
			"top": 10,
			"right": 10,
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
			.style("font-size", "16px") 
			.text(title);
			
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
  console.log("Trying to draw!");

  draw(params);

</script>
</body>