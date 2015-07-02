/* global define, app, jsPDF*/
define([
  'app/config',

  'components/map/controller/mapController',
  'components/report/controller/imageUri',

  'esri/map',
  'esri/basemaps',

],

  function(
    config,

    mapController, imageUri,

    Map, esriBasemaps
    ) {

  return {

    buildReport: function(){
      // init layout
      this.layoutReport();

      // set values for lat/lng
      $('#reportLat').text(app.query.point.y);
      $('#reportLng').text(app.query.point.x);

      this.buildResults();
      this.buildMap('reportSolarMap', 'reportSolarMap-container', 'solar');
      this.buildMap('reportAerialMap','reportAerialMap-container', 'hybrid');

      // console.log($('#results').html());
    },

    layoutReport: function(){
    },

    buildResults: function(){
      // Set solar values
      $('#reportTotalPerYear').html(
        parseFloat(app.query.totalPerYear).toFixed(2) + ' kWh/m<sup>2</sup>'
      );
      $('#reportAveragePerDay').html(
        parseFloat(app.query.averagePerDay).toFixed(2) + ' kWh/m<sup>2</sup>'
      );

      // Set get started link
      var getStarted = '<a href="http://thecleanenergybuilder.com/directory#resultsType=both&page=0&pageNum=25&order=alphaTitle&proximityNum=60&proximityInput=' + app.query.utilityCompany.zip + '&textInput=&textSearchTitle=1&textSearchDescription=1&field_established=&field_employees=&field_year=&reload=false&mapSize=large&allResults=false&tids2=&tids3=568&tids4=&tids5=&tids6=" target="_blank">Contact a Local Installer</a>';
      $('#reportGetStarted').html(getStarted);

      // Set utilities
      $('#reportUtilityName').text(app.query.utilityCompany.fullName);
      $('#reportUtilityStreet').text(app.query.utilityCompany.street);
      $('#reportUtilityCityStateZip').text(app.query.utilityCompany.city + ', MN ' + app.query.utilityCompany.zip);
      $('#reportUtilityPhone').text(app.query.utilityCompany.phone);
    },

    buildMap: function(mapName, el, basemap){

      // esriBasemaps.solar = {
      //     baseMapLayers: [{
      //       id: 'places',
      //       opacity: 1,
      //       visibility: true,
      //       showAttribution: false,
      //       url: config.basemapUrl
      //     }],
      //     title: 'Solar'
      //   };

      app[mapName] = new Map(el, {
        basemap: basemap,
        center: [app.query.point.x, app.query.point.y],
        showAttribution: false,
        zoom: 13
          // extent: new Extent(this.config.extent)
      });

      app[mapName].on('load', function(){
        mapController.placePoint(app.query.point, app[mapName]);
      });

    },






    printToPdf: function(){
      console.log('printtopdf');

      /* orientation, units, format*/
      var doc = new jsPDF(undefined, 'in', undefined);
      // doc.text(20, 20, 'Hello world!');
      // doc.text(20, 30, 'This is client-side Javascript, pumping out a PDF.');
      // doc.addPage();
      // doc.text(20, 20, 'Do you like that?');
      
      // // Save the PDF
      // doc.save('Test.pdf');
      

      /* USED TO SKIP A EL */
      var specialElementHandlers = {
        // '#skipMe': function(element, renderer){
        //   return true;
        // }
      };

      var html = $('.modal-content').html();
      
      /* NEEDS ADDITIONAL LIBRARIES */
      // doc.addHTML(html, function(){
      //   doc.save('test.pdf');
      // })
      
      /* ONLY TAKES TEXT */
      // doc.fromHTML(
      //   $('.modal-content').get(0),  // source
      //   15,                       // xcoord
      //   15,                       // y coord
      //   {
      //     'width': 800,             // max width of content on PDF
      //     'elementHandlers': specialElementHandlers
      //   }
      // );
      
      var solarLogo = imageUri.solarLogo;
      
      
      doc.addImage(
        solarLogo,    // source
        'JPEG',       // type
        0.25,           // x coord
        0.25,           // y coord
        1,           // width
        1           // height
      );

      doc.setFontSize(18);
      doc.text(
        1.5,                     // x coord
        0.5,                     // y coord
        'Minnesota Solar Suitability Location Report'  // value
      );

      doc.setLineWidth(0.0005);
      doc.line(
        0, 1.5,
        8.5, 1.5
      );

      // doc.rect(
      //   0,    // x coord
      //   5,    // y coord
      //   8.5,    // width
      //   0.1   // height
      //   // style
      // );

      doc.save('test.pdf');
    }

  };
});