/* global define, app, Backbone, _ */
define([
    'app/config',

    'dojo/text!../templates/bottomBarTemplate.html'
  ],

  function(
    config,

    viewTemplate

  ) {
    var bottomBar = Backbone.View.extend({

      events: {},

      initialize: function() {
        this.render();
      },

      render: function() {

        var template = _.template(viewTemplate);
        var options = {
          title: config.applicationTitle
        };

        // console.log(this.$el);
        this.$el.html(template(options));
        this.startup();
      },

      startup: function() {
        this.initComponents();
      },

      initComponents: function() {

      }

    });
    return bottomBar;
  });