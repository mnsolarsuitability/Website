module.exports = function(grunt) {

  // Load grunt tasks automatically
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({

    copy: {
      main: {
      },
      release:{
        files: [
          {
            cwd: 'js',
            src: ['**'],
            dest: 'release/js',
            expand: true
          },
          {
            cwd: 'lib',
            src: ['**'],
            dest: 'release/lib',
            expand: true
          },
          {
            cwd: 'styles',
            src: ['*.css'],
            dest: 'release/styles',
            expand: true
          },
          {
            expand: true,
            src: 'index.html',
            dest: 'release',
          }
        ]
      },
      bower: {
        files: [{
          expand: true,
          src: [
            'bower_components/backbone/backbone.js',
            'bower_components/bootstrap-sass-twbs/assets/javascripts/bootstrap.min.js',
            'bower_components/colpick/js/colpick.js',
            'bower_components/jquery/dist/jquery.min.js',
            'bower_components/jquery/dist/jquery.min.map',
            'bower_components/modernizr/modernizr.js',
            'bower_components/underscore/underscore-min.js',
            'bower_components/underscore/underscore-min.map'
          ],
          dest: './lib',
          flatten: true
        }]
      },
      style: {
        files: [{
          expand: true,
          src: [
            'bower_components/bootstrap/dist/css/bootstrap.min.css',
            'bower_components/colpick/css/colpick.css',
            'bower_components/fontawesome/css/font-awesome.min.css',
          ],
          dest: 'styles',
          flatten: true
        },
        {
          cwd: 'bower_components/bootstrap/fonts/',
          src: ['**'],
          dest: 'fonts',
          expand: true
        },
        {
          cwd: 'bower_components/fontawesome/fonts/',
          src: ['**'],
          dest: 'fonts',
          expand: true
        }
      ]}
    },

    clean: ['release'],

    shell: {
      bowerInstall: {
        command: 'bower install'
      }
    },

    watch: {
      css: {
        files: ['styles/*.scss'],
        tasks: ['sass']
      }
    },

    sass: {
      dist: {
        files: {
          'styles/main.css': 'styles/main.scss'
        }
      }
    },

    esri_slurp: {
      options: {
        version: '3.13'
      },
      dev: {
        options: {
          // NOTE: issue w/ beautify on Win:
          // https://github.com/steveoh/grunt-esri-slurp/issues/31
          beautify: false
        },
        dest: 'lib/esri'
      }
    },

    comments: {
      js: {
        options: {
          singleline: true,
          multiline: false
        },
        src: [ 'release/app/*.js' ]
      },
      html: {
        options: {
          singleline: true,
          multiline: true
        },
        src: [ 'release/*.html' ]
      }
    },

    uncss: {
      dist: {
        files: {
          'styles/main.css': ['**/*.html']
        }
      }
    }
  });

  grunt.registerTask('init',['clean', 'shell:bowerInstall', 'copy:bower', 'copy:style', 'copy']);
  grunt.registerTask('build',['clean', 'shell:bowerInstall', 'copy'])
};