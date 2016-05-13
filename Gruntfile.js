module.exports = function(grunt) {

  var config = {
    bower_path: 'bower_components',
    build_path: '.build',

    assets_less: 'resources/assets/less',
    assets_js: 'resources/assets/js',

    css: 'public/css',
    js: 'public/js',
    images: 'public/img',
    fonts: 'public/fonts',
  };

  /*
      Concat: pull in files from Bower and various other places, put into build_path
      Copy:
      Uglify: Compress/minify every JS file in build_path into a .min.js in the public folder
      Less: Compile less into css in build_path
      CSSMin: Minify every CSS file in build_path into a .min.css in the public folder
      Clean: Remove build_path
  */

  grunt.registerTask('default', [ 'concat', 'copy', 'uglify', 'less', 'cssmin', 'clean' ]);

  grunt.registerTask('css', [ 'copy:css', 'less', 'cssmin', 'clean' ]);

  grunt.registerTask('js', [ 'concat', 'copy:js', 'uglify', 'clean' ]);

  grunt.initConfig({
    config: config,

    concat: {
      options: {
        separator: ';'
      },

      app: {
        src: [
          '<%= config.assets_js %>/*.js'
        ],
        dest: '<%= config.build_path %>/app.js'
      },

      bootstrap: {
        src: [
          '<%= config.bower_path %>/bootstrap/js/alert.js',
          '<%= config.bower_path %>/bootstrap/js/button.js',
          '<%= config.bower_path %>/bootstrap/js/collapse.js',
          '<%= config.bower_path %>/bootstrap/js/dropdown.js',
          '<%= config.bower_path %>/bootstrap/js/modal.js',
          '<%= config.bower_path %>/bootstrap/js/tooltip.js',
          '<%= config.bower_path %>/bootstrap/js/popover.js',
          '<%= config.bower_path %>/bootstrap/js/tab.js',
          '<%= config.bower_path %>/bootstrap/js/transition.js'
        ],
        dest: '<%= config.build_path %>/bootstrap.js'
      },

      momentjs: {
        src: [
          '<%= config.bower_path %>/moment/moment.js',
          '<%= config.bower_path %>/moment-duration-format/lib/moment-duration-format.js',
        ],
        dest: '<%= config.build_path %>/moment.js'
      }
    },


    copy: {
      js: {
       files: [{
         src: '<%= config.bower_path %>/jquery/dist/jquery.min.js',
         dest: '<%= config.js %>/jquery.min.js'
       },
       {
         src: '<%= config.bower_path %>/datatables/media/js/jquery.dataTables.min.js',
         dest: '<%= config.js %>/jquery.datatables.min.js'
       },
       {
         src: '<%= config.bower_path %>/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js',
         dest: '<%= config.js %>/datatables-bootstrap.min.js'
       },
       {
         src: '<%= config.bower_path %>/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js',
         dest: '<%= config.js %>/bootstrap-editable.min.js'
       },
       {
         src: '<%= config.bower_path %>/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js',
         dest: '<%= config.js %>/bootstrap-slider.min.js'
       },
       {
         src: '<%= config.bower_path %>/fullcalendar/dist/fullcalendar.min.js',
         dest: '<%= config.js %>/fullcalendar.min.js'
       },
       {
         src: '<%= config.bower_path %>/bootstrap-datepicker/dist/bootstrap-datepicker.min.js',
         dest: '<%= config.js %>/bootstrap-datepicker.min.js'
       }]
      },
      css: {
       files: [{
         src: '<%= config.bower_path %>/font-awesome/css/font-awesome.min.css',
         dest: '<%= config.css %>/font-awesome.min.css'
       },
       {
         src: '<%= config.bower_path %>/datatables/media/css/jquery.dataTables.min.css',
         dest: '<%= config.css %>/jquery.datatables.min.css'
       },
       {
         src: '<%= config.bower_path %>/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css',
         dest: '<%= config.build_path %>/datatables-bootstrap.css'
       },
       {
         src: '<%= config.bower_path %>/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css',
         dest: '<%= config.build_path %>/bootstrap-editable.css'
       },
       {
         src: '<%= config.bower_path %>/seiyria-bootstrap-slider/dist/css/bootstrap-slider.css',
         dest: '<%= config.build_path %>/bootstrap-slider.css'
       },
       {
         src: '<%= config.bower_path %>/fullcalendar/dist/fullcalendar.min.css',
         dest: '<%= config.build_path %>/fullcalendar.css'
       },
       {
         src: '<%= config.bower_path %>/bootstrap-datepicker/dist/bootstrap-datepicker3.min.css',
         dest: '<%= config.build_path %>/bootstrap-datepicker3.css'
       }]
      },
      fonts: {
       files: [{
         expand: true,
         cwd: '<%= config.bower_path %>/font-awesome/fonts',
         src: '*',
         dest: '<%= config.fonts %>'
       }]
      }
    },


    uglify: {
      options: {
        compress: true,
        mangle: false,
        warnings: false,
        preserveComments: 'some'
      },
      build: {
        files: [{
            expand: true,
            cwd: '<%= config.build_path %>',
            src: '**/*.js',
            dest: '<%= config.js %>',
            ext: '.min.js'
        }]
      }
    },


    less: {
      app: {
        files: {
          "<%= config.build_path %>/app.css": "<%= config.assets_less %>/app.less"
        }
      },
      bootstrap: {
        files: {
          "<%= config.build_path %>/bootstrap.css": "<%= config.assets_less %>/bootstrap.less"
        }
      },
      theme: {
        files: {
          "<%= config.build_path %>/whoops.css": "<%= config.assets_less %>/whoops.less"
        }
      }
    },


    cssmin: {
      minify: {
        expand: true,
        cwd: '<%= config.build_path %>/',
        src: ['*.css', '!*.min.css'],
        dest: '<%= config.css %>/',
        ext: '.min.css'
      }
    },


    watch: {

      js: {
        files: [
            '<%= config.assets_js %>/*.js',
            '!<%= config.assets_js %>/*.min.js'
        ],
        tasks: ['concat', 'uglify', 'clean'],
        options: {
          //livereload: true,
        }
      },

      css: {
        files: ['<%= config.assets_less %>/*.less'],
        tasks: ['less', 'cssmin', 'clean'],
        options: {
          //livereload: true,
        }
      }
    },

    clean: {
      build: {
        src: [ '<%= config.build_path %>' ]
      },
    },

  });

  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-watch');

};