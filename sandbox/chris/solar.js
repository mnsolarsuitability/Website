// JavaScript Document

$(window).load(function () {
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
		var layer;
		var layerflag = 0;
	
    // Initialize Google Geocoder and API key
	var geocoder;
	
	// MN Solar Suitability API key
	//gapi.client.setApiKey('AIzaSyCI5rFXoNNM-IGDP-BZ1opjXTtB9wZalEI');
	
	// Chris' API Key
	gapi.client.setApiKey('AIzaSyChnPHuHTelEGwa6vI9DAFGWCraqrumUMc');
	
	$('#searchGo').on('click', function() {
	    codeAddress();
		
		});
	
	// Hide some divs
	$('#root').hide();
	$('#layerTest1').hide();
	$('#layerTest2').hide();
	$('#layerTest3').hide();
	$('#resultsButton').hide();
	//$('#r').hide();
	$('#resultsSmall').hide();
	$("#resultsBig").hide();
	$("#resultsBLAH").hide();
	$("#loader").hide();
	
	$(function(){
        $(window).resize(function(){
            placeFooter();
			placeResults();
        });
        placeFooter();
		//placeResults();
		
		
        // hide it before it's positioned
        $('#bottomBar').css('display','inline');
    });

    function placeFooter() {  
        var windHeight = $(window).height();
        var footerHeight = $('#bottomBar').height();
        var offset = parseInt(windHeight) - parseInt(footerHeight);
        $('#bottomBar').css('top',offset);
    };
	
	function placeResults() {  
        var windHeight = $(window).height();
        var footerHeight = $('#bottomBar').height();
		var resultsHeight = $('#resultsSmall').height();
        var offset = parseInt(windHeight) - (parseInt(footerHeight)+parseInt(resultsHeight));
        $('#resultsSmall').css('top',offset);
    };
	
	/*function placeResultsTab() {  
	    $('#rTab').show();
        var resultsWidth = $('#r').width();
		
		// .height() due to rTab rotation
        var resultsTabWidth = $('#rTab').height();
		
		//console.log('rWidth : ' + resultsWidth);
		//console.log('rTabWidth : ' + resultsTabWidth);
		var offset = parseInt(resultsWidth) + 100;
		//console.log('Offset :' + offset);
        $('#rTab').css('bottom',offset);
    };*/
	
	// Collapse accordion every time dropdown is shown
    $('.dropdown-accordion').on('show.bs.dropdown', function (event) {
      var accordion = $(this).find($(this).data('accordion'));
      accordion.find('.panel-collapse.in').collapse('hide');
      });

    // Prevent dropdown to be closed when we click on an accordion link
    $('.dropdown-accordion').on('click', 'a[data-toggle="collapse"]', function (event) {
      event.preventDefault();
      event.stopPropagation();
      $($(this).data('parent')).find('.panel-collapse.in').collapse('hide');
      $($(this).attr('href')).collapse('show');
      });
	
	function buttonClassRemove(){
	    $("#solarButton").removeClass("activeButton");
		$("#aerialButton").removeClass("activeButton");
		$("#streetButton").removeClass("activeButton");
	};

	$("#bookmarkLocation").on('click', function(){
		console.log("BOOKMARKED!");

		// COOKIE TEST
		lat = "Latitude :" + ptLat;
		document.cookie=lat;

		var x = document.cookie;

		console.log("Cookie :" + x);

		// GET POINT LOCATION
		// IF NO POINT, ERROR
		// ELSE WRITE BOOKMARK
		// ADD TO BOOKMARK
	});


	
	$("#solarButton").on('click',function(){
	    buttonClassRemove();
		$(this).addClass("activeButton");
		toggleBasemapView();
		solarLayer.show();
		});
	
	$("#aerialButton").on('click',function(){
	    buttonClassRemove();
		$(this).addClass("activeButton");
		toggleBasemapView();
		aerialLayer.show();
		});
	
	$("#streetButton").on('click',function(){
	    buttonClassRemove();
		$(this).addClass("activeButton");
		toggleBasemapView();
		streetLayer.show();
		});
		
	$("#resultsBLAH").on('click',function(){
	    placeResults();
	  //$('#r').toggle();
	    $('#resultsSmall').toggle();
	  });
	  
	$("#resultsHeader").on('click', function(){
	    $("#resultsBig").toggle();
	  });
		
    function establishMapCenter() {
        if (navigator.geolocation) {
 
			navigator.geolocation.getCurrentPosition(function (pos) {
				var crd = pos.coords;
				console.log('Your current position is:');
				console.log('Latitude : ' + crd.latitude);
				console.log('Longitude: ' + crd.longitude);
				console.log('More or less ' + crd.accuracy + ' meters.');
				var center = [crd.longitude, crd.latitude];
				createMap(center);
			});

		} else {
			alert("Browser doesn't support Geolocation.");
			var center = [-90.243322, 40.971795];
			//createMap(center);
		}
}

		function createMap(centerPoint) {
			//console.log(center + ' seems to work');

			map = new Map("map", {
				basemap: "solar",
				//test solar tile center
				center: centerPoint,
				//center: [-95.4175, 44.6169],
				zoom: 12,
				// Blegen center
				//center: [-93.243322, 44.971795],
				showAttribution: false,
				
				});
		}

		//establishMapCenter()

		// Creates sticky bottom nav/footer bar
		function getWindowWidth() {
			var windowWidth = 0;
			if (typeof(window.innerWidth) == 'number') {
				windowWidth = window.innerWidth;
			}
			else {
				if (document.documentElement && document.documentElement.clientWidth) {
					windowWidth = document.documentElement.clientWidth;
				}
				else {
					if (document.body && document.body.clientWidth) {
						windowWidth = document.body.clientWidth;
					}
				}
			}
			return windowWidth;
		}
		
		/*if ($('#r').is(':empty')){
		  $('#rTab').hide();
		  $('#r').hide();
        };*/
		
        /*$('#map').on('click', function () {
			console.log('Used map.onclick');
			//$('#r.selector:hidden').toggle('slide');
			//$('#r').show();
			//$('#rTab').show();
			//$("#rTab").fadeOut('slow');
        });*/
		
		/*$('#r').on('click', function () {
            $(this).toggle( "slide" );
			$('.sideNav').fadeIn('fast');
			moveTab();
        });*/
		
		$('#viewButton1').on('click', function(){
		    console.log('SAW VIEW1 CLICK');
		});
		
		$('#viewButton2').on('click', function(){
		    console.log('SAW VIEW2 CLICK');
		});
		
		$('#viewButton3').on('click', function(){
		    console.log('SAW VIEW3 CLICK');
		});
		
		function moveTab(){
		    document.getElementById("rTab").style.left = 0;
		}
		
		$('.dropdown-menu layerCheck').click(function(e) {
		    console.log("Trying to stop prop");
            e.stopPropagation();
        });
		
		$('input').click(function (e) { e.stopPropagation(); });
		
		/*$('#rTab').on('click', function () {
			if ($('#r').is(':hidden')){
			    $('#r').toggle( "slide" );
				};
        });*/
		
		/*$('#statsTab').on('click', function () {
			displayResults();
			$('r').fadeOut('fast');
        });
		
		$('.tableCanvas').on('click', function () {
		    //$("#splashTab").fadeOut('fast');
			//$("#rTab").fadeOut('fast');
			$(this).fadeOut('slow');
			$('.sideNav').fadeIn('fast');
        });
		
		$('#splashTab').on('click', function () {
		    //$("#splashTab").fadeOut('fast');
			//$("#rTab").fadeOut('fast');
			$('#SplashScreen').toggle( "slide" );
			//$('.sideNav').fadeOut('fast');
        });/
		
		// Draw vector layers
		$('#layer0CheckBox').on('click', function () {
		    console.log('Clicked Layer 1!');
			if ($('#layerTest1').is(':hidden')){
			    document.getElementById('layerTest1').innerHTML = "Counties";
			    $('#layerTest1').show();
			}else{
			    $('#layerTest1').hide();
			};
		});
		
		$('#layer1CheckBox').on('click', function () {
		    console.log('Clicked Layer 2!');
			if ($('#layerTest2').is(':hidden')){
			    document.getElementById('layerTest2').innerHTML = "EUSA";
			    $('#layerTest2').show();
			}else{
			    $('#layerTest2').hide();
			};
		});
		
		$('#layer2CheckBox').on('click', function () {
		    console.log('Clicked Layer 3!');
			if ($('#layerTest3').is(':hidden')){
			    document.getElementById('layerTest3').innerHTML = "Tiles";
			    $('#layerTest3').show();
			}else{
			    $('#layerTest3').hide();
			};
		});*/
		
		

        // Setup World Imagery Basemap
        esriConfig.defaults.map.basemaps.solar = {
            baseMapLayers: [{
                id: 'places',
                opacity: 1,
                visibility: true,
                showAttribution: false,
                url: basemapURL
            }],
            title: "Solar"
        };
		

        // Setup solar imageservice layer
        var map = new Map("map", {
            basemap: "solar",
			center: [-93.243322, 44.971795],
			zoom: 13,
            showAttribution: false,

        })
		
		$('#searchBar').keypress(function(e) {
	    
            //Autocomplete variables
            var input = document.getElementById('searchBar');
            //var searchform = document.getElementById('form1');
            var place;
            var autocomplete = new google.maps.places.Autocomplete(input);
 
            //Add listener to detect autocomplete selection
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                place = autocomplete.getPlace();
                //console.log('PLACE  :  ' + place);
    			//console.log(JSON.parse(JSON.stringify(place)));
	    		autocompleteLng = place.geometry.location.B;
		    	autocompleteLat = place.geometry.location.k;
			    //console.log(autocompleteLat, autocompleteLng);
				var pt = new Point(autocompleteLng, autocompleteLat);
				//console.log(pt);
				map.centerAndZoom(pt, 18);
				addGraphic(pt);
				//var newlatlong = new google.maps.LatLng({lat:autocompleteLat, lng:autocompleteLong});
				//console.log(newlatlong);
                //map.setCenter(newlatlong);
                //marker.setPosition(newlatlong);
                //map.setZoom(12);
            });
 
            //Add listener to search
            input.addEventListener("change", function() {
                //var newlatlong = new google.maps.LatLng(place.geometry.location.lat(),place.geometry.location.lng());
    			//var newlatlong = new google.maps.LatLng({lat:autocompleteLat, lng:autocompleteLong});
                //map.setCenter(newlatlong);
                //marker.setPosition(newlatlong);
                //map.setZoom(12);
 
            });
     
            //Reset the inpout box on click
            input.addEventListener('click', function(){
            input.value = "";
            });

            if (e.which == 13) {
                codeAddress();
            }
	    });
		
		
		function codeAddress() {
		    swBounds = new google.maps.LatLng({lat:42, lng:-95});
		    neBounds = new google.maps.LatLng({lat:46, lng:-91});
		    extent = new google.maps.LatLngBounds(swBounds, neBounds);
	        //extent = google.maps.LatLngBounds({sw:google.maps.LatLng({lat:42, lng:-95}), ne:google.maps.LatLng({lat:46, lng:-91})});

	        geocoder = new google.maps.Geocoder();
            var address = document.getElementById("searchBar").value;
		    //console.log("Address : " + address);
             geocoder.geocode( { 'address': address, 'bounds':extent}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
					geocodeLong = results[0].geometry.location.B;
					geocodeLat = results[0].geometry.location.k;
					var pt = new Point(geocodeLong, geocodeLat);
					map.centerAndZoom(pt, 18);
					addGraphic(pt);
					beQuery(pt);
                }
				else if (status == google.maps.GeocoderStatus.ZERO_RESULTS){
				    alert('No addresses were found.')
					}
				else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT){
				    alert('Over query limit (2,500/mo)');
				
				}
				else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
        };

        var params = new ImageServiceParameters();

        // Direct call to raster function to symbolize imagery with color ramp (setting default was unreliable)
        var rasterFunction = new esri.layers.RasterFunction();
        rasterFunction.functionName = "solarColorRamp";
        rasterFunction.variableName = "Raster";
        params.renderingRule = rasterFunction;
        params.noData = 0;
		
        var solarLayer = new ArcGISImageServiceLayer(imgDisplayURL, {
            imageServiceParameters: params,
            showAttribution: false,
            opacity: 1.0
        });
		
		$('#homeButton').on('click', function() {
		    //console.log('Home button clicked');
		    //var centerPoint = new esri.geometry.Point ([-93.243322,44.971795]);
			//console.log(centerPoint);
			map.centerAt(new esri.geometry.Point ([-93.243322,44.971795]));
			console.log('Trying to center');
			});
		
		$("a#dropdownMenu.dropdown-toggle").click(function(ev) {
			$("ul#dropdownBookmarkList.dropdown-menu").hide();
			$("ul#dropdownMenuList.dropdown-menu").toggle();
            //$("a.dropdown-toggle").dropdown("toggle");
            return false;
          });
		  
		$("a#dropdownBookmark.dropdown-toggle").click(function(ev) {
		  $("ul#dropdownMenuList.dropdown-menu").hide();
		  $("ul#dropdownBookmarkList.dropdown-menu").toggle();
            return false;
          });
          /*$("ul.dropdown-menu a").click(function(ev) {
              $("a.dropdown-toggle").dropdown("toggle");
              return false;
          });*/
		  
		$(".closeSplash").on('click', function(){
		    $("#SplashScreen").hide();
			});
		  
		$("#helpMenu").on('click', function(){
		    console.log('SAW HELP CLICK');
			$("#SplashScreen").toggle();
		});
		
		// Create aerial layer and load hidden
		var aerialLayer = new Tiled("http://server.arcgisonline.com/arcgis/rest/services/World_Imagery/MapServer");
		//http://services.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer
		aerialLayer.hide();
		
		// Create street layer and load hidden
		var streetLayer = new Tiled("http://server.arcgisonline.com/arcgis/rest/services/World_Street_Map/MapServer/");
		streetLayer.hide();
		
		// Add solar to the map
        map.addLayer(solarLayer);
		
		// Add aerial to the map
        map.addLayer(aerialLayer);
		
		// Add street to the map
        map.addLayer(streetLayer);
		
		
		function toggleBasemapView(){
		    //console.log('Saw toggleBasemapView function call');
		    solarLayer.hide();
			aerialLayer.hide();
			streetLayer.hide();			
			};


        // Setup a home button to zoom back to original extent
        /*var home = new HomeButton({
            map: map,
            visible: true,
            showPointer: true,
            scale: null,
            geolocationOptions: {
                maximumAge: 0,
                timeout: 15000,
                enableHighAccuracy: true
            }
        }, "HomeButtonOld");
        home.startup();*/


        // Setup address search geolocator
        /*var geocoder = new Geocoder({
            map: map,
            arcgisGeocoder: {
                placeholder: "Find a place",
				autoComplete: true
            }
        }, dom.byId("search"));
        geocoder.startup();*/

		

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


        // Setup a help ? that displays splash screen again
        $("#HelpMe").click(function () {
		    console.log('CLICKED HELP ME');
            //$("#r").fadeOut('fast');
            //$("#SplashScreen").fadeIn('slow');
			$("#SplashScreen").toggle('slide');
			
        });


        // Setup my current location button and geolocator
        /*geoLocate = new LocateButton({
            map: map,
            highlightLocation: true,
            symbol: pinSymbol,
            scale: 2000
        }, "LocateButton");
        geoLocate.startup();

		geocoder.on("select", showResults);*/

        $("#currentLoc").click(function () {
            if (navigator.geolocation) {
				  //$("#r").fadeOut('fast');
				  //$('#r.selector:hidden').toggle('slide');
				  $('#SplashScreen').toggle('slide');
				  //$('#SplashScreen').fadeOut('slow');
				  
                navigator.geolocation.getCurrentPosition(zoomToLocation, locationError);
                //watchId = navigator.geolocation.watchPosition(showLocation, locationError);
            } else {
                alert("Browser doesn't support Geolocation. Visit http://caniuse.com to see browser support for the Geolocation API.");
            }
        });

        function locationError(error) {
            //error occurred so stop watchPosition
            if (navigator.geolocation) {
                navigator.geolocation.clearWatch(watchId);
            }
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("Location not provided");
                    break;

                case error.POSITION_UNAVAILABLE:
                    alert("Current location not available");
                    break;

                case error.TIMEOUT:
                    alert("Timeout");
                    break;

                default:
                    alert("unknown error");
                    break;
            }
        }

        function zoomToLocation(location) {
            var pt = new Point(location.coords.longitude, location.coords.latitude);

            map.centerAndZoom(pt, 18);
			
			 var evt = {};
			 evt.mapPoint = pt;
			 console.log(pt);
			 
			 pixelQuery(evt);
        }
		
		 function zoomToCoords(x, y, zoomLevel) {
            var pt = new Point(x, y);

            map.centerAndZoom(pt, zoomLevel);
			
			 var evt = {};
			 evt.mapPoint = pt;
			 
			 pixelQuery(evt);
        }

        function showLocation(location) {
            var pt = new Point(location.coords.longitude, location.coords.latitude);

            if (!graphic) {
                addGraphic(pt);
            } else {
                graphic.setGeometry(pt); // move the graphic if it already exists
            }
            map.centerAt(pt);
        }

        function addGraphic(pt) {
			 map.graphics.clear();
            graphic = new Graphic(pt, pinSymbol);
            map.graphics.add(graphic);
        }
		
		function showResults(evt) {
			//$("#r").fadeOut('fast');
            //$("#SplashScreen").fadeOut('slow');
		    $('#SplashScreen').toggle('slide');
			map.graphics.clear();
		    var point = evt.result.feature.geometry;
			var symbol = new SimpleMarkerSymbol();
			console.log("assigned symbol");
			symbol.setStyle(SimpleMarkerSymbol.STYLE_DIAMOND);
			symbol.setColor(new Color([0,255,255]));
			var graphic = new Graphic(point, symbol);
			map.graphics.add(graphic);
			var result = "<p>Click/Zoom anywhere near your search result (<img src='/assets/img/blue_diamond.gif'>) to view solar radiation per square meter.</p><p>Struggling to find what you are looking for? Try using the basemap toggle button at left to bring up satellite imagery for further help finding the spot you wish to analyze.</p>";

                        document.getElementById('r').innerHTML = result;
                        //$("#r").fadeIn('slow');
						//$("#r").toggle('slide');
						//$('#r.selector:hidden').toggle('slide');
		}

        // Click on map to query solar imageservice, bare earth county layer, and utility service area layer
        var clicky = map.on("click", pixelQuery);

        function pixelQuery(e) {
		    //document.getElementById('r').innerHTML = '';
			//placeResults();
			$('#resultsButton').show();
			//$('#r').show();
			//placeResults();
			
			// CLEAR DIV
			$("#results").html("");
		
            //setup insolation query
            var query = new Query();
            var queryTask = new QueryTask(imgIdentifyURL);
            query.geometry = e.mapPoint;
            query.geometryType = "esriGeometryPoint";
            query.mosaicRule = "";
            //query.pixelSize = 1; 
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
            BEquery.geometry = e.mapPoint;
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

                        //var result = "<H3><strong>INSOLATION (kWh/m<sup>2</sup>)</strong></H3><p>Total per Year: " + y.toFixed(2) + warning + "<br />Avg per Day: " + v.toFixed(2) + " (" + quality + ")" + warning + "</p>" + warningMsg;

						var result = '<div class="resultsTopicTitle">INSOLATION (kWh/m2)</div><div class="resultsDisplay">Total per Year: ' + y.toFixed(2) + warning + '<br>Avg per Day: ' + v.toFixed(2) + ' (' + quality + ')' + warning + warningMsg +'</div>';
						//<div class="resultsTopicTitle">Sun Hours (hr/mo)</div><div class="resultsDisplay">Yearly Avg:<br></div>
                        //console.log("solar: ") + result;
						
                        //document.getElementById('r').innerHTML = result;
						$("#results").html(result);
                        //$("#r").fadeIn('slow');
						//$("#r").toggle('slide');
						//$('r.selector:hidden').fadeIn('fast');


						  //setup Utility Service Provider query
                        var query = new Query();
                        var queryTask = new QueryTask(eusaURL);
                        //console.log(e.mapPoint);
                        query.geometry = e.mapPoint;
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
                            //console.log(results.features[0]);
                            fullname = results.features[0].attributes["FULL_NAME"];
                            city = results.features[0].attributes["CITY"];
                            street = results.features[0].attributes["STREET"];
                            phone = results.features[0].attributes["PHONE"];
                            website = results.features[0].attributes["WEBSITE"];
                            elec_comp = results.features[0].attributes["ELEC_COMP"];
                            zip = results.features[0].attributes["ZIP"];
							
							if(quality == "Poor") {
								var getstarted = "<p>Location not optimal? Check out:<br /><a href='http://mncerts.org/solargardens' target='_blank'>Community Solar Gardens</a></p>";
							}else{
								var getstarted = "<p><a href='http://thecleanenergybuilder.com/directory#resultsType=both&page=0&pageNum=25&order=alphaTitle&proximityNum=60&proximityInput=" + zip + "&textInput=&textSearchTitle=1&textSearchDescription=1&field_established=&field_employees=&field_year=&reload=false&mapSize=large&allResults=false&tids2=&tids3=568&tids4=&tids5=&tids6=' target='_blank'>Get Started: Contact a Local Installer</a></p>";
							}

                            //var result = "<p><H3><strong>Utility Service Provider:   </strong></h3><br />" + fullname + "<br />" + street + "<br />" + city + ", MN " + zip + "<br />" + phone + "<br /><a target='_blank' href='http://" + website + "'>" + website + "</a></p><p><a href='http://www.dsireusa.org/solar/incentives/index.cfm?re=1&ee=1&spv=1&st=0&srp=0&state=MN' target='_blank'>MN Incentives/Policies for Solar</a></p>" + getstarted;
                            var result ='<div class="resultsTopicTitle">Utility Service Provider:</div><div class="resultsDisplay">' + fullname + ' ' + phone + '</div>';
							
							//console.log("EUSA: " + $("results") + result);
							   //add service utility provider to insolation results
                            //document.getElementById('r').innerHTML = document.getElementById('r').innerHTML + "<hr />" + result;
							document.getElementById('results').innerHTML = document.getElementById('results').innerHTML + result;
							//$("results").html($("results") + result);
							

                        });
                    });


                } else {
					  // clicked point is outside of the state
                    var result = "<H3><strong>INSOLATION (kWh/m<sup>2</sup>)</strong></H3><p>Total per Year: Unknown**<br />Avg per Day: Unknown**</p><p>**<span id='smText'>This point is out of the study area. Click within the State of Minnesota or try searching for something like 'Target Field'.</span></p><span class='closeSplash'>(X) CLOSE</span> </p>";
                    alert("This location is outside of the study area. Please refine your search to be limited to the state of Minnesota.");
                    //document.getElementById('r').innerHTML = result;
                    //$("#r").fadeIn('slow');
					//$("#r").toggle('slide');
					//$('#r.selector:hidden').toggle('slide');
                }
               
            });


            // removes all previous graphics (previous click)
            map.graphics.clear();

            //  This sets a new graphic using the clicked point and the symbol
            var point = e.mapPoint;
            var graphic = new Graphic(point, pinSymbol);
            map.graphics.add(graphic);
			
			// Store point lat/long
			ptLong = e.mapPoint.y
			ptLat = e.mapPoint.x

        };
		
		
		//test function for outside of study area
		function beQuery(pt){
		//setup bare earth county layer query
		    
			console.log("beQuery called");
			
            var BEquery = new Query();
            var BEQueryTask = new QueryTask(bareEarthCountyURL);
            BEquery.geometry = pt;
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
                    /*if (bareEarth === 1) {
                        var warning = "**";
                        var warningMsg = "<p>**<span id='smText'>The lidar data available for " + county + " County includes only bare earth points. Hence, this insolation value does not take shade from nearby surface features into consideration.</span></p>";
						
							if(county == "Pine") {
								var warningMsg = "<p>**<span id='smText'>The lidar data available for " + county + " County was inconsistently classified across different flight lines. Hence, insolation accuracy is variable as shade from nearby surface features may not be taken into consideration.</span></p>";
							}
                 
                    } else {
                        var warning = "";
                        var warningMsg = "";
                    }*/
		        } else{
				    setTimeout(function(){
					    alert("This location is outside of the study area. Please refine your search to be limited to the state of Minnesota.");
						
						map.centerAt(new esri.geometry.Point ([-93.243322,44.971795]));
						}, 1500);
					}
		    });
		};
		
		
		/* -----------------------------
    		beginning of solarGP tool
			---------------------------- */
		map.on("click",solarGPTool);

        gsvc = new GeometryService("http://tasks.arcgisonline.com/ArcGIS/rest/services/Geometry/GeometryServer");
		
		//Old GP service
		//var gp = new esri.tasks.Geoprocessor("http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/SolarPointQuery_hr/GPServer/SolarPointQuery_hr");
		
		//var gp = new esri.tasks.Geoprocessor("http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/SolarPointQuery_fast/GPServer/SolarPointQuery_hr");
		var gp = new esri.tasks.Geoprocessor("http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/SolarPointQuery_fast/GPServer/Script");
		

		 
		
		function solarGPTool(evt){
		    point = webMercatorUtils.webMercatorToGeographic(evt.mapPoint);
			
			//initialize query task
            queryTask = new esri.tasks.QueryTask("http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/MN_DSM/ImageServer");

            //initialize query
            tilequery = new esri.tasks.Query();
            tilequery.returnGeometry = false;
            tilequery.outFields = ["Name"];
			tilequery.geometry = evt.mapPoint;
			
			queryTask.execute(tilequery, function (results) {
				tile = (results.features[0].attributes["Name"] + '.img');
				executeGP(point, tile);
				
				});
			};
		
		function executeGP(point, tile){
			startTime = new Date().getTime();
			$("#loader").show();
			var params = {"PointX":point['x'], "PointY":point['y'], "File_Name":tile};
			console.log(JSON.stringify(params, null, 4));
			gp.execute(params, displayResults);
			}
		
		function getMonth(val){
		    switch(val){
				    case 0:
					    month = "Jan"
						break;
					case 1:
					    month = "Feb"
						break;
					case 2:
					    month = "Mar"
						break;
					case 3:
					    month = "Apr"
						break;
					case 4:
					    month = "May"
						break;
					case 5:
					    month = "Jun"
						break;
					case 6:
					    month = "Jul"
						break;
					case 7:
					    month = "Aug"
						break;
					case 8:
					    month = "Sep"
						break;
					case 9:
					    month = "Oct"
						break;
					case 10:
					    month = "Nov"
						break;
					default:
					    month = "Dec"
					};
				return month;
				}
		
		function displayResults(results, messages) {
		    //empty div so histo doesn't duplicate
			$("#resultsHisto").html("");
			$("#sunHrHisto").html("");
			
			placeResults();
			
			//show results
			$('#loader').hide();
			$('#resultsSmall').show();
			$('#resultsBLAH').show();
			
			//parse the results
			var insolResults = results[0].value.split("\n");
			var sunHrResults = results[1].value.split("\n");
			
			//remove final value (blank)
			insolResults.pop();
			sunHrResults.pop();
			
			var insolValue=[insolResults[0],insolResults[1],insolResults[2],insolResults[3],insolResults[4],insolResults[5],insolResults[6],insolResults[7],insolResults[8],insolResults[9],insolResults[10],insolResults[11]];
			var insolValueCorrected=[];
			maxInsol = 0;
			
			var sunHrValue=[sunHrResults[0],sunHrResults[1],sunHrResults[2],sunHrResults[3],sunHrResults[4],sunHrResults[5],sunHrResults[6],sunHrResults[7],sunHrResults[8],sunHrResults[9],sunHrResults[10],sunHrResults[11]];
			maxSun = 0;
			total = 0
			
			for (var i = 0; i < 12; i++){
				
				month = getMonth(i);
				
				//convert Wh to kWh
				insolValDiv1000 = insolResults[i]/1000;
				total += insolValDiv1000;
				if (insolValDiv1000 > maxInsol){
				    maxInsol = insolValDiv1000;
					}
				
				insolValueCorrected.push(insolValDiv1000);
				
				};
			
			total = 0;
			for (var i = 0; i < 12; i++){
				
				month = getMonth(i)
				
				total += parseInt(sunHrValue[i]);
				if (parseInt(sunHrValue[i]) > maxSun){
				    maxSun = parseInt(sunHrValue[i]);
					}
				};

			var data = {
			
				"month": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				"insolValue":[insolValueCorrected[0],insolValueCorrected[1],insolValueCorrected[2],insolValueCorrected[3],insolValueCorrected[4],insolValueCorrected[5],insolValueCorrected[6],insolValueCorrected[7],insolValueCorrected[8],insolValueCorrected[9],insolValueCorrected[10],insolValueCorrected[11]],
				"sunHrValue":[sunHrResults[0],sunHrResults[1],sunHrResults[2],sunHrResults[3],sunHrResults[4],sunHrResults[5],sunHrResults[6],sunHrResults[7],sunHrResults[8],sunHrResults[9],sunHrResults[10],sunHrResults[11]]
			}
			
			// query time
			endTime = new Date().getTime();
			console.log("Solar point processing took: " + ((endTime - startTime)*0.001) + " seconds.")
			
			// create histos
			   
			function draw(data, dataAttr, max, div, title) {
			
				var margin = {
						"top": 10,
						"right": 10,
						"bottom": 30,
						"left": 50
					},
					width = 440,
					height = 160;
					barWidth = 20;

				var x = d3.scale.ordinal()
					.domain(data.month.map(function(d) {
						return d.substring(0, 3);}))
					.rangeRoundBands([0, width], 0);

				var y = d3.scale.linear()
				    // SET Y AXIS HEIGHT
					.domain([0, (max + 50)])
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
					.call(xAxis);

				svgContainer.append("g")
					.attr("class", "y axis").call(yAxis)
					.append("text")
						.attr("x", (width / 1.5))             
						.attr("y", 10)
						.attr("text-anchor", "center")  
						.style("font-size", "16px") 
						//.style("padding-left", "100px")
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

                }

				draw(data,data.insolValue,maxInsol, "#resultsHisto", "Solar Insolation By Month (kWh)");
			    draw(data,data.sunHrValue,maxSun, "#sunHrHisto", "Sun Hours By Month");
			};
		
			
			
			

    });
});


/* --------------------------------
  OLD CODE
  ---------------------------------*/
  
				/*var margin = {
						"top": 10,
						"right": 10,
						"bottom": 30,
						"left": 50
					},
					width = 440,
					height = 160;
					barWidth = 20;

				var x = d3.scale.ordinal()
					.domain(data.month.map(function(d) {
						return d.substring(0, 3);}))
					.rangeRoundBands([0, width], 0);

				var y = d3.scale.linear()
				    // SET Y AXIS HEIGHT
					.domain([0, (maxInsol + 50)])
					
					//ROUND - (Math.ceil(maxInsol/100)*100)])
					
					//maxResults])
					.range([height, 0]);

				var xAxis = d3.svg.axis().scale(x).orient("bottom");

				var yAxis = d3.svg.axis().scale(y).orient("left");

				var svgContainer = d3.select("#resultsHisto").append("svg")
					.attr("class", "chart")
					.attr("width", width + margin.left + margin.right)
					.attr("height", height + margin.top + margin.bottom).append("g")
						.attr("transform", "translate(" + margin.left + "," + margin.right + ")");
				
				// CREATE TOOL TIP
				var tip = d3.tip()
				  .attr('class', 'd3-tip')
				  .offset([-10, 0])
				  .html(function(d) {
					return "<strong>Value:</strong> <span style='color:red'>" + d.toFixed(2) + "</span>";
				  })

				svgContainer.call(tip);

				svgContainer.append("g")
					.attr("class", "x axis")
					.attr("transform", "translate( 0," + height + ")")
					.call(xAxis);

				svgContainer.append("g")
					.attr("class", "y axis").call(yAxis)
					//.append("text")
						//.attr("transform", "rotate(-90)")
						//.attr("y", 6)
						//.attr("dy", ".71em")
						//.style("text-anchor", "end")
						//.text("Solar Value")
					.append("text")
						.attr("x", (width / 1.5))             
						.attr("y", 10)
//						- (margin.top/8))
						.attr("text-anchor", "right")  
						.style("font-size", "16px") 
						.style("padding-left", "100px")
						//.style("text-decoration", "underline")  
						.text("Solar Insolation By Month (kWh)");
						
				svgContainer.selectAll(".bar").data(data.insolValue).enter().append("rect")
					.attr("class", "bar")
					.attr("x", function(d, i) {
						return i * x.rangeBand() + (x.rangeBand()/2) -(barWidth/2);
					})
					.attr("y", function(d) {
						return y(d);
					})
					.attr("width", barWidth)
					//function(){
						//return x.rangeBand();
					//})
					.attr("height", function(d) {
						return height -y(d);
					})
					.on('mouseover', tip.show)
					.on('mouseout', tip.hide)
					
				//$('.tableCanvas').toggle('slide');
                //}

				// DRAW SOLAR HRS
				var margin = {
						"top": 10,
						"right": 10,
						"bottom": 30,
						"left": 50
					},
					width = 440,
					height = 160;
					barWidth = 20;

				var x = d3.scale.ordinal()
					.domain(data.month.map(function(d) {
						return d.substring(0, 3);}))
					.rangeRoundBands([0, width], 0);

				var y = d3.scale.linear()
				    // SET Y AXIS HEIGHT
					.domain([0, (maxSun + 100)])
					.range([height, 0]);

				var xAxis = d3.svg.axis().scale(x).orient("bottom");

				var yAxis = d3.svg.axis().scale(y).orient("left");

				var svgContainer = d3.select("#sunHrHisto").append("svg")
					.attr("class", "chart")
					.attr("width", width + margin.left + margin.right)
					.attr("height", height + margin.top + margin.bottom).append("g")
						.attr("transform", "translate(" + margin.left + "," + margin.right + ")");
				
				// CREATE TOOL TIP
				var tip = d3.tip()
				  .attr('class', 'd3-tip')
				  .offset([-10, 0])
				  .html(function(d) {
					return "<strong>Value:</strong> <span style='color:red'>" + d.toFixed(2) + "</span>";
				  })

				svgContainer.call(tip);

				svgContainer.append("g")
					.attr("class", "x axis")
					.attr("transform", "translate( 0," + height + ")")
					.call(xAxis);

				svgContainer.append("g")
					.attr("class", "y axis").call(yAxis)
					.append("text")
						.attr("x", (width / 2))             
						.attr("y", 10)
						.attr("text-anchor", "middle")  
						.style("font-size", "16px") 
						.style("text-decoration", "underline")  
						.text("Sun Hours By Month");
						
				svgContainer.selectAll(".bar").data(data.sunHrValue).enter().append("rect")
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
					
				//$('.tableCanvas').toggle('slide');
                }
			//}

			};*/