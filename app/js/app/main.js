/* global define, app:true, _ */
define([
    'app/config',
    'app/views/LayoutView',

    'components/navBar/views/navbarView',
    'components/helpSplash/views/helpSplashView',
    'components/bottomBar/views/bottomBarView',

    'esri/config',
    'esri/map'

  ],

  function(

    config, Layout,

    Navbar, helpSplash, bottomBar,

    esriConfig, Map

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
        this.map = new Map('mapContainer', {
          basemap: 'topo',
          center: [config.centerLng, config.centerLat],
          showAttribution: false,
          zoom: 13
          // extent: new Extent(this.config.extent)
        });
        // Setup World Imagery Basemap
        console.log(esriConfig.defaults);
        // esriConfig.defaults.map.basemaps.solar = {
        //   baseMapLayers: [{
        //     id: 'places',
        //     opacity: 1,
        //     visibility: true,
        //     showAttribution: false,
        //     url: config.basemapUrl
        //   }],
        //   title: 'Solar'
        // };

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

        this.bottomBar = new bottomBar({
          el: this.layout.$el.find('.bottomBar-container'),
        });
      }

    };
  });