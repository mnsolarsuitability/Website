// JavaScript Document

//draw(solData, solData.insolValu, 465, "#test", "title",2,20,300,300);

function draw(data, dataAttr, max, div, title, titleOffset, titleModifier, chartWidth,chartHeight) {
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