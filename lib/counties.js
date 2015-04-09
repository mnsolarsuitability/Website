$(function () {
    console.log('Loading map!');

    function popUp(f, l) {

        var popUpText = ""
        reprocessCounties = ["Crow Wing", "Pine", "Stearns", "Wright"];
        badCounties = ["Chisago", "McLeod", "Rice"];

        if (f.properties) {
            popUpText = "Blank";

            if (reprocessCounties.indexOf(f.properties["COUNTYNAME"]) > -1) {
                popUpText = f.properties["COUNTYNAME"] + " County is currently being reprocessed.";
            } else if (badCounties.indexOf(f.properties["COUNTYNAME"]) > -1){
                popUpText = f.properties["COUNTYNAME"] + " County requires new data.";
            } else {
                popUpText = f.properties["COUNTYNAME"] + " County is complete.";
            }

            l.bindPopup(popUpText);
        }
    }
	
	function popUp2(f, l) {
	    console.log("POPUP2");

        var popUpText = ""

		popUpText = f.properties.FULL_NAME;
        /*if (f.properties) {
            popUpText = "Blank";

            if (reprocessCounties.indexOf(f.properties["COUNTYNAME"]) > -1) {
                popUpText = f.properties["COUNTYNAME"] + " County is currently being reprocessed.";
            } else if (badCounties.indexOf(f.properties["COUNTYNAME"]) > -1){
                popUpText = f.properties["COUNTYNAME"] + " County requires new data.";
            } else {
                popUpText = f.properties["COUNTYNAME"] + " County is complete.";
            }*/

            //l.bindPopup(popUpText);
        //}
		l.bindPopup(popUpText);
    }

    $("body").on("shown.bs.tab", "#mapResize", function() {
            console.log("Changing size");
            //ap.invalidateSize(false);
            L.Util.requestAnimFrame(map.invalidateSize,map,!1,map._container);
        });

    /*$("body").on('shown','#currentIssues', function() { 
      L.Util.requestAnimFrame(map.invalidateSize,map,!1,map._container);
      });*/

    var myStyle = {
        "color": "#ff7800",
            "weight": 5,
            "opacity": 0.65
    };

    var sym = {
        type: "single", // Defines the symbology as a single type of representation for all features
        vectorOptions: { // Leaflet Path options for all features
            fillColor: "#46461f",
            fillOpacity: 0.5,
            weight: 1,
            color: "#ff7800"
        }
    };
	
    var map = L.map('map', {
        center: [46.5, -93.326667],
        zoom: 7
    });

    bareEarth = ["Crow Wing", "Pine", "Stearns", "Wright", "Chisago", "McLeod", "Rice"];
    var geojsonLayer = new L.GeoJSON.AJAX("/assets/docs/countieswgs84.geojson", {

        onEachFeature: popUp,
        style: function (feature) {
			
			if ((bareEarth.indexOf(feature.properties["COUNTYNAME"])) >= 0) {
				switch (feature.properties["COUNTYNAME"]) {
                case "Crow Wing":
                case "Pine":
                case "Stearns":
                case "Wright":
                    return {
                        color: "#00ff00",
                        weight: 1.5
                    };

                case "Chisago":
                case "McLeod":
                case "Rice":
                    return {
                        color: "#ff0000",
                        weight: 1.5
                    };
                default:
				    console.log("Default");
                    return {
                        color: "ffffff",
                        weight: 1.5
                    };
                }
			
			}
			
			else{
			    return {
                        color: "#000000",
                        weight: 1.5,
						opacity: 0.3,
                    };
				};
            
        }
    }).addTo(map);
	
	/*var eusaLayer = new L.GeoJSON.AJAX("/assets/docs/eusawgs84.geojson", {

        onEachFeature: popUp2,
		
		/*function(feature) {
							console.log(feature.properties.FULL_NAME)
							},
		style: function(feature){
		        return {
                        color: "#000000",
                        weight: 1.5,
						opacity: 0.3,
						}
                    }
        
    }).addTo(map);*/

    satellite = L.esri.basemapLayer("Imagery");
    //grayscale = L.esri.basemapLayer("Gray")
    var basemap = new L.tileLayer('http://{s}.tiles.mapbox.com/v3/cmartin616.k305o0o5/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
        maxZoom: 18
    }).addTo(map);

    var baseLayers = {
        "Streets": basemap,
            "Satellite Imagery": satellite
    };
	
    var overlays = {
        "County Status": geojsonLayer,
		"Elec. Util. Serv. Areas": eusaLayer
    };

    L.control.layers(baseLayers, overlays).addTo(map);

    // LEGEND
        var legend = L.control({position: 'bottomright'});

        legend.onAdd = function (map) {
        var div = L.DomUtil.create('div', 'info legend');

            div.innerHTML +=
            '<img src="/assets/img/reprocess_legend.png" alt="legend" width="175" height="175">';

        return div;
        };

        legend.addTo(map);


    /*var legend = L.control({
        position: 'bottomleft'
    });

    legend.onAdd = function (map) {

    var div = L.DomUtil.create('div', 'info legend'),
        categories = [1, 2],
        labels = [];

    // loop through our density intervals and generate a label with a colored square for each interval
    for (var i = 0; i < geojsonLayer.length; i++) {
        div.innerHTML +=
            '<i style="background:' + getColor(categories[i] + 1) + '"></i> ' +
            categories[i] + (categories[i + 1] ? '&ndash;' + categories[i + 1] + '<br>' : '+');
    }

    return div;
};*/

    //legend.addTo(map);


});