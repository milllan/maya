module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        /**
         * String replace in files...
         * Changes version
         */
        replace: {
            frameworkVersion: {
                options: {
                    patterns: [
                        {
                            match: /define\("OU_VERSION", .+/gi,
                            replacement: 'define("OU_VERSION", "<%= pkg.version %>");'
                        }
                    ]
                },
                files: [
                    {
                        src: ['index.php'],
                        dest: 'index.php'
                    }
                ]
            },

            commentVersion: {
                options: {
                    patterns: [
                        {
                            match: /Version: .+/g,
                            replacement: 'Version: <%= pkg.version %>'
                        }
                    ]
                },
                files: [
                    {
                        src: ['index.php'],
                        dest: 'index.php'
                    }
                ]
            }
        },

        /*watch: {
            scripts: {
                files: ['**!/!*.css', '**!/!*.js', '**!/!*.php'],
                options: {
                    livereload: true,
                    spawn: false
                },
            },
        },

        uglify: {
            options: {
                report: 'min',
                preserveComments: 'some'
            },
            build: {
                expand: true,
                src: ['**!/!*.js', '!**!/!*.min.js', '!**!/node_modules/!**', '!Gruntfile.js'],
                rename : function (dest, src) {
                    var folder = src.substring(0, src.lastIndexOf('/'));
                    var filename = src.substring(src.lastIndexOf('/'), src.length);
                    filename = filename.substring(0, filename.lastIndexOf('.'));
                    return folder + filename + '.min.js';
                }
            }
        },

        cssmin: {
            options: {
                report: 'min',
                keepSpecialComments: 1,
            },
            prod: {
                expand: true,
                src: ['**!/!*.css', '!**!/!*.min.css', '!**!/node_modules/!**'],
                rename : function (dest, src) {
                    var folder = src.substring(0, src.lastIndexOf('/'));
                    var filename = src.substring(src.lastIndexOf('/'), src.length);
                    filename = filename.substring(0, filename.lastIndexOf('.'));
                    return folder + filename + '.min.css';
                }
            }
        },*/

        copy: {
            dist: {
                // src: ['*.min.js', '*.min.css', '*.php', '*.png', '*.jpg'],
                src: ['**/*', '!**/dist/**', '!Gruntfile.js', '!package.json', '!.gitignore', '!**/node_modules/**'],
                dest: 'dist/my-mayan-sign/'
            }
        },

        clean: {
            dist: ["dist/**/*"]
        },

        compress: {
            dist: {
                options: {
                    archive: 'dist/MyMayanSign.zip'
                },
                expand: true,
                cwd: 'dist/my-mayan-sign/',
                src: ['**/*'],
                dest: 'my-mayan-sign/'
            }
        }

    });

    // Load the plugin for live-reload
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-replace');

    // Default task(s).
    grunt.registerTask('default', ['uglify', 'cssmin']);

    // Minify all resources, then clean dist folder and copy all resources into it
    grunt.registerTask('prod', ['replace', 'clean', 'copy:dist', 'compress']);

};
