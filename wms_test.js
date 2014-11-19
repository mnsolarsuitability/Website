// JavaScript Document

$(window).load(function () {
    require([
        "esri/map",

        'esri/layers/WMSLayer',
        'esri/layers/WMSLayerInfo',
        'esri/geometry/Extent',

        "esri/layers/ArcGISTiledMapServiceLayer",
        "esri/layers/ImageServiceParameters",
        "esri/layers/ArcGISImageServiceLayer",

        "esri/toolbars/draw",
        "esri/graphic",
        "esri/geometry/Point",

        "esri/symbols/SimpleMarkerSymbol",
        "esri/symbols/SimpleLineSymbol",
        "esri/symbols/SimpleFillSymbol",

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

        "dijit/layout/BorderContainer", "dijit/layout/ContentPane",
        "dijit/form/Button", "dojo/domReady!"], function (
    Map, WMSLayer, WMSLayerInfo, Extent,
    Tiled, ImageServiceParameters, ArcGISImageServiceLayer,
    Draw, Graphic, Point,
    SimpleMarkerSymbol, SimpleLineSymbol, SimpleFillSymbol,
    screenUtils, urlUtils, esriConfig, esriRequest,
    Geocoder, HomeButton, LocateButton,
    parser, dom, domConstruct, query, Color,
    on, domClass, dojoJson, registry, Query, QueryTask, BasemapToggle, InfoTemplate) {

        parser.parse();
		 var layer;
		 var layerflag = 0;

        // Show splashscreen when app loads
        $('#SplashScreen').show();
        $('#r').hide();

        // Close spashscreen when x or map is clicked
        $('#closeSplash').on('click', function () {
            $("#SplashScreen").fadeToggle('slow');
        });
        $('#map').on('click', function () {
            $('#SplashScreen').fadeOut('slow');
        });


        // Setup World Imagery Basemap
//        esriConfig.defaults.map.basemaps.solar = {
//            baseMapLayers: [{
//                id: 'places',
//                opacity: 1,
//                visibility: true,
//                showAttribution: false,
//                url: 'http://services.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/'
//            }],
//            title: "Solar"
//        };

//LK
var customExtentAndSR = new esri.geometry.Extent(477133,4979982,479365,4981176,new esri.SpatialReference({"wkid":26915}));

        // Setup solar imageservice layer
        var map = new Map("map", {
			extent: customExtentAndSR,
            //basemap: "solar",
            //center: [-93.243322, 44.971795],
            showAttribution: false
            //zoom: 13
        });


 var layer1 = new WMSLayerInfo({
          name: 'mncomp',
          title: 'Minnesota Composite Imagery',
          imageFormat: 'image/jpeg'

        });
        var resourceInfo = {
          extent: new Extent(-131108,4505093,994071,5715117, {
            wkid: 26915
          }),
          layerInfos: [layer1],
          imageFormat: 'image/jpeg'
        };
        var wmsLayer = new WMSLayer(' http://geoint.lmic.state.mn.us/cgi-bin/mncomp?', {
          resourceInfo: resourceInfo,
          visibleLayers: ['mncomp']
        });
        wmsLayer.setImageFormat("jpg");
        map.addLayers([wmsLayer]);



        var params = new ImageServiceParameters();

        // Direct call to raster function to symbolize imagery with color ramp (setting default was unreliable)
        var rasterFunction = new esri.layers.RasterFunction();
        rasterFunction.functionName = "solarColorRamp";
        rasterFunction.variableName = "Raster";
        params.renderingRule = rasterFunction;
        params.noData = 0;
//        var layer = new ArcGISImageServiceLayer("http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/SolarP_ISv2/ImageServer", {
        var layer = new ArcGISImageServiceLayer("http://gis.uspatial.umn.edu/arcgis/rest/services/solar/MN_Counties_Solar/ImageServer", {
            imageServiceParameters: params,
            showAttribution: false,
            opacity: 1.0
        });
        map.addLayer(layer);


        // Build basemap toggle button to show/hide solar layer revealing world imagegry
        var toggle = new BasemapToggle({
            map: map,
            basemap: "hybrid",
            basemaps: {
                solar: {
                    label: "Solar",
                    url: "/assets/img/solar_square.png"
                },
                hybrid: {
                    label: "Aerial",
                    url: "http://js.arcgis.com/3.7/js/esri/dijit/images/basemaps/hybrid.jpg"
                }
            }
        }, "BasemapToggle");
        toggle.startup();

        $('#BasemapToggle').on('click', function () {
            if (layerflag == 0) {
                layer.hide();
                layerflag = 1;
            } else {
                layer.show();
                layerflag = 0;
            }

        });


        // Setup a home button to zoom back to original extent
        var home = new HomeButton({
            map: map,
            visible: true,
            showPointer: true,
            scale: null,
            geolocationOptions: {
                maximumAge: 0,
                timeout: 15000,
                enableHighAccuracy: true
            }
        }, "HomeButton");
        home.startup();


        // Setup address search geolocator
        var geocoder = new Geocoder({
            map: map,
            arcgisGeocoder: {
                placeholder: "Find a place"
            }
        }, dom.byId("search"));
        geocoder.startup();



        // Setup a pin symbol to show current insolation measurement lcoation
        var pinSymbol = new esri.symbol.PictureMarkerSymbol({
            "angle": 0,
                "xoffset": 0,
                "yoffset": 12,
                "type": "esriPMS",
                "url": "http://static.arcgis.com/images/Symbols/Basic/GreenStickpin.png",
                "contentType": "image/png",
                "width": 30,
                "height": 30
        });


        // Setup a help ? that displays splash screen again
        $("#HelpMe").click(function () {
            $("#r").fadeOut('fast');
            $("#SplashScreen").fadeIn('slow');
        });


        // Setup my current location button and geolocator
        geoLocate = new LocateButton({
            map: map,
            highlightLocation: true,
            symbol: pinSymbol,
            scale: 2000
        }, "LocateButton");
        geoLocate.startup();

        $("#currentLoc").click(function () {
            if (navigator.geolocation) {
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
            addGraphic(pt);
            map.centerAndZoom(pt, 15);
            pointSolar(location.coords.longitude, location.coords.latitude, 4326);
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
            graphic = new Graphic(pt, pinSymbol);
            map.graphics.add(graphic);
        }


        // Click on map to query solar imageservice, bare earth county layer, and utility service area layer
        var clicky = map.on("click", pixelQuery);

        function pixelQuery(e) {

            //setup insolation query
            var query = new Query();
            var queryTask = new QueryTask("http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/SolarP_IS/ImageServer/identify");
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
            var BEQueryTask = new QueryTask("http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/solar_fgdb/MapServer/1");
            BEquery.geometry = e.mapPoint;
            BEquery.geometryType = "esriGeometryPoint";
            BEquery.outFields = ["*"];
            BEquery.spatialRelationship = query.SPATIAL_REL_INTERSECTS;
            BEquery.mosaicRule = "";
            BEquery.sr = 102100;
            BEquery.imageDisplay = 1;
            BEquery.tolerance = 1;
            BEquery.returnGeometry = true;
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

                        var result = "<H3><strong>INSOLATION (kWh/m<sup>2</sup>)</strong></H3><p>Total per Year: " + y.toFixed(2) + warning + "<br />Avg per Day: " + v.toFixed(2) + " (" + quality + ")" + warning + "</p>" + warningMsg;

                        document.getElementById('r').innerHTML = result;
                        $("#r").fadeIn('slow');


						  //setup Utility Service Provider query
                        var query = new Query();
                        var queryTask = new QueryTask("http://us-dspatialgis.oit.umn.edu:6080/arcgis/rest/services/solar/solar_fgdb/MapServer/0");
                        console.log(e.mapPoint);
                        query.geometry = e.mapPoint;
                        query.geometryType = "esriGeometryPoint";
                        query.outFields = ["*"];
                        query.spatialRelationship = query.SPATIAL_REL_INTERSECTS;
                        query.mosaicRule = "";
                        query.sr = 102100;
                        query.imageDisplay = 1;
                        query.tolerance = 1;
                        query.returnGeometry = true;
                        query.returnZ = false;
                        query.returnM = false;
                        query.f = "pjson";

                        queryTask.execute(query, function (results) {
                            console.log(results.features[0]);
                            fullname = results.features[0].attributes["FULL_NAME"];
                            city = results.features[0].attributes["CITY"];
                            street = results.features[0].attributes["STREET"];
                            phone = results.features[0].attributes["PHONE"];
                            website = results.features[0].attributes["WEBSITE"];
                            elec_comp = results.features[0].attributes["ELEC_COMP"];
                            zip = results.features[0].attributes["ZIP"];

                            var result = "<p><b>Utility Service Provider:   </b><br />" + fullname + "<br />" + street + "<br />" + city + ", MN " + zip + "<br />" + phone + "<br /><a target='_blank' href='http://" + website + "'>" + website + "</a></p><p><a href='http://www.dsireusa.org/solar/incentives/index.cfm?re=1&ee=1&spv=1&st=0&srp=0&state=MN' target='_blank'>MN Incentives/Policies for Solar</a></p>";

							   //add service utility provider to insolation results
                            document.getElementById('r').innerHTML = document.getElementById('r').innerHTML + "<hr />" + result;

                        });
                    });


                } else {
					  // clicked point is outside of the state
                    var result = "<H3><strong>INSOLATION (kWh/m<sup>2</sup>)</strong></H3><p>Total per Year: Unknown**<br />Avg per Day: Unknown**</p><p>**<span id='smText'>This point is out of the study area. Click within the State of Minnesota or try searching for something like 'Target Field'.</span></p>";

                    document.getElementById('r').innerHTML = result;
                    $("#r").fadeIn('slow');
                }

            });


            // removes all previous graphics (previous click)
            map.graphics.clear();

            //  This sets a new graphic using the clicked point and the symbol
            var point = e.mapPoint;
            var graphic = new Graphic(point, pinSymbol);
            map.graphics.add(graphic);

        }

    });
});