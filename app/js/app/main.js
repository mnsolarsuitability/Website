/* global define, app:true, _ */
define([
    'app/config',
    'app/views/LayoutView',

    'components/navBar/views/navbarView',
    'components/helpSplash/views/helpSplashView',
    'components/loadSplash/views/loadSplashView',
    'components/resultsSmall/views/resultsSmallView',
    'components/bottomBar/views/bottomBarView',

    'components/query/controller/queryController',

    'esri/basemaps',
    'esri/config',
    'esri/layers/ArcGISTiledMapServiceLayer',
    'esri/layers/ArcGISImageServiceLayer',
    'esri/layers/ImageServiceParameters',
    'esri/layers/RasterFunction',
    'esri/map'

  ],

  function(

    config, Layout,

    Navbar, helpSplash, loadSplash, resultsSmall, bottomBar,

    query,

    esriBasemaps, esriConfig, TiledLayer, ImageLayer, ImageParams, RasterFunction, Map

  ) {

    return {

      startup: function() {
        console.log('starting');
        app = this;
        this.initDojo();
      },

      initDojo: function() {
        this.initLayout();
      },

      /**
       * Initialize the application layout by inserting top level nodes into the DOM
       * @return { N/A }
       */
      initLayout: function() {
        this.layout = new Layout({
          el: $('body')
        });

        this.initMap();
      },

      initMap: function() {

        // Setup World Imagery Basemap
        esriBasemaps.solar = {
          baseMapLayers: [{
            id: 'places',
            opacity: 1,
            visibility: true,
            showAttribution: false,
            url: config.basemapUrl
          }],
          title: 'Solar'
        };

        this.map = new Map('mapContainer', {
          basemap: 'solar',
          center: [config.centerLng, config.centerLat],
          showAttribution: false,
          zoom: 13
            // extent: new Extent(this.config.extent)
        });

        var params = new ImageParams();

        // Direct call to raster function to symbolize imagery with color ramp (setting default was unreliable)
        var rasterFunction = new RasterFunction();
        rasterFunction.functionName = 'solarColorRamp';
        rasterFunction.variableName = 'Raster';
        params.renderingRule = rasterFunction;
        params.noData = 0;

        var solarLayer = new ImageLayer(config.solarImageryUrl, {
          id: 'solar',
          imageServiceParameters: params,
          showAttribution: false,
          opacity: 1.0
        });

        // Create aerial layer and load hidden
        var aerialLayer = new TiledLayer(config.imagery, {
          id: 'aerial'
        });
        aerialLayer.hide();

        // Create street layer and load hidden
        var streetLayer = new TiledLayer(config.streets, {
          id: 'street'
        });
        streetLayer.hide();

        // Add solar to the map
        this.map.addLayer(solarLayer);

        // Add aerial to the map
        this.map.addLayer(aerialLayer);

        // Add street to the map
        this.map.addLayer(streetLayer);


        // // Read URL Parameters
        // function getParameterByName(name) {
        //   name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        //   var regex = new RegExp('[\\?&]' + name + '=([^&#]*)'),
        //     results = regex.exec(location.search);
        //   return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        // }

        // // // If coords supplied via param, zoom to them
        // if (getParameterByName('long') < -75 && getParameterByName('lat') > 35) {

        //   var map = new Map('mapContainer', {
        //     basemap: 'solar',
        //     center: [getParameterByName('long'), getParameterByName('lat')],
        //     showAttribution: false,
        //     zoom: 13
        //   });

        // //   setTimeout(function() {
        // //     zoomToCoords(getParameterByName('long'), getParameterByName('lat'), 15);
        // //   }, 4000);

        // //   // if getParameterByName('q') = 1 then call solar query here

        // //   if (getParameterByName('q') == 1) {

        // //     var pt = new Point(getParameterByName('long'), getParameterByName('lat'));

        // //     pixelQuery(pt);

        // //   }

        // } else {

        // Setup solar imageservice layer
        // var map = new Map('mapContainer', {
        //   basemap: 'solar',
        //   center: [-93.243322, 44.971795],
        //   showAttribution: false,
        //   zoom: 13
        // });
        // }


        this.initComponents();
      },

      initComponents: function() {
        this.navbar = new Navbar({
          el: this.layout.$el.find('.navbar-container'),
          // map: this.map,
          // layerLookup: this.layerLookup,
          // layerController: this.layerController,
          // basemap: this.basemap
        });

        this.helpSplash = new helpSplash({
          el: this.layout.$el.find('.helpContainer'),
        });

        this.loadSplash = new loadSplash({
          el: this.layout.$el.find('.loader-container'),
        });

        this.bottomBar = new bottomBar({
          el: this.layout.$el.find('.bottomBar-container'),
        });

        this.resultsSmall = new resultsSmall({
          el: this.layout.$el.find('.resultsSmall-container'),
        });

        this.mapController();
      },

      mapController: function() {
        app.map.on('click', function(e) {
          query.pixelQuery(e);
        });
      }

    };
  });