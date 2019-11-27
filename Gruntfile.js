module.exports = function (grunt) {

    grunt.initConfig({

        jshint: {
            files: ['Gruntfile.js', 'js/**/*.js']
        },

        concat: {
            js: {
                src: [
                    "js/main.js",
                    "js/locales/fileinput.js",
                    "js/locales/pt.js",
                ],
                dest: "frontend/web/js/main.js"
            }
        },

        uglify: {
            dist: {
                src: ['<%= concat.js.dest %>'],
                dest: 'frontend/web/js/main.min.js'
            }
        },

        watch: {
            files: '<%= jshint.files %>',
            tasks: 'jshint'
        }
    });
    // Carrega os plugins que proveem as tarefas especificadas no package.json.
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Tarefa padrão que será executada se o Grunt for chamado sem parâmetros.
    grunt.registerTask('default', ['jshint', 'concat', 'uglify']);
//
// };
};



