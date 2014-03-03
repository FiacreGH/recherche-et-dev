module.exports = (grunt) ->
	grunt.initConfig
		pkg: grunt.file.readJSON('package.json')

	########## CSS ############
		sass: # Task
			dist: # Target
				options: # Target options
				# output_style = expanded or nested or compact or compressed
					style: 'expanded'

				files: # Dictionary of files
					"Temporary/main.css": 'Resources/Public/StyleSheets/Sass/main.scss' # 'destination': 'source'

		cssmin:
			combine:
				files:
					'Resources/Public/Distribution/StyleSheets/site.min.css': [
						'Temporary/site.css'
					]

	########## JS ############
		concat:
		# dist_css
			css:
				src: [
					'Temporary/main.css',
					'Resources/Public/StyleSheets/Site/rte.css'
					'../jquerycolorbox/res/css/colorbox.css',
				],
				dest: 'Temporary/site.css',
			options:
				separator: ';'

		# dist_js
			js:
			# src: ['src/**/*.js'],
				src: [
					'Resources/Public/Components/jquery/jquery.min.js'
					'Resources/Public/Components/modernizr/modernizr.js'
					'Resources/Public/Components/bootstrap/dist/js/bootstrap.min.js'
					'Temporary/main.min.js'
				]
				dest: 'Resources/Public/Distribution/JavaScript/site.min.js'

		uglify:
			options:
				banner: "/*! <%= pkg.name %> <%= grunt.template.today(\"dd-mm-yyyy\") %> */\n"

			dist:
				files:
					"Temporary/main.min.js": ["<%= jshint.files %>"]

		jshint:
			files: [
				'Resources/Public/JavaScript/main.js'
				'Resources/Public/JavaScript/plugins.js'
			]

			options:
			# options here to override JSHint defaults
				curly: true
				eqeqeq: true
				immed: true
				latedef: true
				newcap: true
				noarg: true
				sub: true
				undef: true
				boss: true
				eqnull: true
				browser: true
				globals:
					jQuery: true
					console: true
					module: true
					document: true

	########## Package ############
		copy:
			main:
				files: [
					# includes files within path
						expand: true
						flatten: true
						src: [
							'Resources/Public/Components/bootstrap/fonts/*'
							'Resources/Public/Components/font-awesome/fonts/*'
						]
						dest: 'Resources/Public/Distribution/Fonts/'
						filter: 'isFile'
				]

	########## Watcher ############
		watch:
			css:
				files: ['Resources/Public/StyleSheets/Sass/*.scss']
				tasks: ['css']
			js:
				files: ["<%= jshint.files %>"]
				tasks: ['js']


	########## Help ############
	grunt.registerTask "help", "Just display some helping output.", () ->
		grunt.log.writeln "Usage:"
		grunt.log.writeln ""
		grunt.log.writeln "- grunt watch   : watch your file and compile as you edit"
		grunt.log.writeln "- grunt package : package your assets ready to be deployed"
		grunt.log.writeln ""
		grunt.log.writeln "Use grunt --help for a more verbose description of this grunt."
		return

	grunt.loadNpmTasks 'grunt-contrib-uglify'
	grunt.loadNpmTasks 'grunt-contrib-jshint'
	grunt.loadNpmTasks 'grunt-contrib-watch'
	grunt.loadNpmTasks 'grunt-contrib-concat'
	grunt.loadNpmTasks 'grunt-contrib-sass';
	grunt.loadNpmTasks 'grunt-contrib-cssmin';
	grunt.loadNpmTasks 'grunt-contrib-copy';

	# https: / /github.com/ asciidisco / grunt - imagine
	#grunt.loadNpmTasks('grunt-imagine')

	#	grunt.registerTask('test', ['jshint', 'qunit']);
	grunt.registerTask "test", ['jshint']
	grunt.registerTask "css", ['sass', 'concat:css', 'cssmin']
	grunt.registerTask "js", ['jshint', 'uglify', 'concat:js']
	grunt.registerTask "package", ['copy', 'css', 'js']
	grunt.registerTask "package-js", ['copy', 'css']
	grunt.registerTask "package-css", ['copy', 'css']
	grunt.registerTask "p-css", ['package-css']
	grunt.registerTask "p-js", ['package-js']

	#	grunt.registerTask('default', ['jshint', 'qunit', 'concat', 'uglify']);
	grunt.registerTask 'default', ['help']
	return