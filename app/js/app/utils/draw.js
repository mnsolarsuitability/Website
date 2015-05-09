/* global define, app*/
define([
    'app/config',

    'esri/graphic'
  ],

  function(
    config,

    Graphic
  ) {

    return {

      addGraphic: function(pt) {
        app.map.graphics.clear();
        var graphic = new Graphic(pt, config.pinSymbol);
        app.map.graphics.add(graphic);
      }

    };
  });