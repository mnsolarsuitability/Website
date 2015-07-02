/* global define, app, Backbone, _ */
define([
    'app/config',

    'components/report/views/resultsView',
    'components/report/controller/reportController',

    'dojo/text!../templates/reportTemplate.html'
  ],

  function(
    config,

    Results, reportController,

    reportTemplate

  ) {
    var report = Backbone.View.extend({

      events: {},

      initialize: function() {
        this.render();
      },

      render: function() {

        var template = _.template(reportTemplate);
        var options = {
          title: config.applicationTitle
        };

        this.$el.html(template(options));
        this.startup();
      },

      startup: function() {
        this.initComponents();
      },

      initComponents: function() {

        $('#siteName').on('keyup', function(){
          app.query.siteName = $(this).val();
        });

        $('#siteNotes').on('keyup', function(){
          app.query.siteNotes = $(this).val();
        });

        $('.printButton').on('click', function(){
          reportController.printToPdf();
        });

        // results template
        this.results = new Results({
          el: $('.reportResults-container'),
        });

      },

    });
    return report;
  });