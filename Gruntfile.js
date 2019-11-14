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
      your_target: {
        files: {
          "docs/index.html": "src/index.html",
        },
      },
    },

    watch: {
      sass: {
        files: ["src/scss/**.*"],
        tasks: ["sass"],
      },

      bake: {
        files: ["src/**.html"],
        tasks: ["bake"],
      },

      livereload: {
        files: ["docs/**/*.*"],
        options: { livereload: LIVE_RELOAD_PORT },
      },
    },
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks("grunt-sass");
  grunt.loadNpmTasks("grunt-bake");
  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.loadNpmTasks("grunt-contrib-connect");

  grunt.registerTask("default", ["sass", "bake", "connect", "watch"]);
};
