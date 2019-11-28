const sass = require("node-sass");

const SERVER_PORT = 3000;
const LIVE_RELOAD_PORT = 35729;

module.exports = function(grunt) {
  grunt.initConfig({
    connect: {
      server: {
        options: {
          port: SERVER_PORT,
          hostname: "localhost",
          base: "docs",
          livereload: LIVE_RELOAD_PORT,
          open: true,
        },
      },
    },

    uglify: {
      js: {
        files: {
          "docs/theme.min.js": ["src/js/*.js"],
        },
      },
    },

    sass: {
      options: {
        implementation: sass,
        outputStyle: "compressed",
      },
      dist: {
        files: {
          "docs/styles.css": "src/scss/styles.scss",
        },
      },
    },

    bake: {
      home: {
        options: {
          content: require('./src/data/home.js'),
        },
        files: {
          "docs/index.html": "src/html/home.html",
        },
      },

      standard: {
        files: {
          "docs/standard.html": "src/html/standard.html",
        },
      },
    },

    copy: {
      assets: {
        files: [{ expand: true, cwd: "src", src: "assets/**", dest: "docs/" }],
      },
    },

    watch: {
      data: {
        files: ["src/data/**.*"],
        tasks: ["bake"],
      },

      js: {
        files: ["src/js/**.*"],
        tasks: ["uglify"],
      },

      sass: {
        files: ["src/scss/**.*"],
        tasks: ["sass"],
      },

      bake: {
        files: ["src/html/**/*.html"],
        tasks: ["bake"],
      },

      assets: {
        files: ["src/assets/**/*.*"],
        tasks: ["copy"],
      },

      livereload: {
        files: ["docs/**/*.*"],
        options: { livereload: LIVE_RELOAD_PORT },
      },
    },
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks("grunt-contrib-uglify-es");
  grunt.loadNpmTasks("grunt-sass");
  grunt.loadNpmTasks("grunt-bake");
  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.loadNpmTasks("grunt-contrib-connect");
  grunt.loadNpmTasks("grunt-contrib-copy");

  grunt.registerTask("default", ["uglify", "sass", "bake", "copy", "connect", "watch"]);
};
