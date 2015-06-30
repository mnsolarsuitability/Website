/* global define, app*/

define([
  'app/config',

  'esri/graphic',
],

  function(
    config,

    Graphic

    ) {

  return {

    placePoint: function(e, mapName){
      //  This sets a new graphic using the clicked point and the symbol
      var point = e;

      var graphic = new Graphic(point, config.pinSymbol);
      mapName.graphics.add(graphic);
    },

    clearGraphics: function(graphicLayers){
      if (graphicLayers){
        //.. need to handle graphics layers, if applicable
      } else {
        // clear all map graphics
        app.map.graphics.clear();
      }
      
    }
  };
});