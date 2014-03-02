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
					'Resources/Public/Distribution/StyleSheets/site.min.css': ['Resources/Public/Distribution/StyleSheets/site.css']

	########## JS ############
		concat:
		# dist_css
			css:
				src: [
					'Temporary/main.css',
					'Resources/Public/StyleSheets/Site/rte.css'
				],
				dest: 'Resources/Public/Distribution/StyleSheets/site.css',
			options:
				separator: ';'

		# dist_js
			js:
			# src: ['src/**/*.js'],
				src: [
					'Resources/Public/Components/jquery/jquery.min.js'
					'Resources/Public/Components/bootstrap/dist/js/bootstrap.min.js'
					'Temporary/main.min.js'
				]
				dest: 'Resources/Public/Distribution/JavaScript/site.min.js'

		uglify:
			options:
				banner: "/*! <%= pkg.name %> <%= grunt.template.today(\"dd-mm-yyyy\") %> */\n"

			dist:
				files:
				# target : [source]
				#					'Resources/Public/JavaScript/Site/site.min.js': ['<%= concat.dist.dest %>']
					'Temporary/main.min.js': [
						'Resources/Public/JavaScript/Site/main.js'
						'Resources/Public/JavaScript/Site/plugins.js'
					]

		jshint:
			files: [
				'Resources/Public/JavaScript/Site/main.js'
				'Resources/Public/JavaScript/Site/plugins.js'
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
					{expand: true, flatten: true, src: ['Resources/Public/Components/bootstrap/fonts/*'], dest: 'Resources/Public/Distribution/Fonts/', filter: 'isFile'}
				]

	########## Watcher ############
		watch:
			css:
				files: ['Resources/Public/StyleSheets/Sass/*.scss']
				tasks: ['css']
			js:
				files: ["<%= jshint.files %>"]
				tasks: ['js']


	grunt.loadNpmTasks 'grunt-contrib-uglify'
	grunt.loadNpmTasks 'grunt-contrib-jshint'
	grunt.loadNpmTasks 'grunt-contrib-watch'
	grunt.loadNpmTasks 'grunt-contrib-concat'
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-copy');

	# https: / /github.com/ asciidisco / grunt - imagine
	#grunt.loadNpmTasks('grunt-imagine')

	#	grunt.registerTask('test', ['jshint', 'qunit']);
	grunt.registerTask "test", ['jshint']
	grunt.registerTask "css", ['sass', 'concat:css', 'cssmin']
	grunt.registerTask "js", ['jshint', 'uglify', 'concat:js']
	grunt.registerTask "package", ['copy', 'css', 'js']

	#	grunt.registerTask('default', ['jshint', 'qunit', 'concat', 'uglify']);
	grunt.registerTask 'default', [
		'concat'
		'uglify'
	]
	return