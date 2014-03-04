module.exports = (grunt) ->
	grunt.initConfig
		pkg: grunt.file.readJSON("package.json")

	############################ Assets ############################

	##
	# Assets: clean up environment
	##
		clean:
			temporary:
				src: ["Temporary"]

	##
	# Assets: copy some files to the distribution directory
	##
		copy:
			fonts:
				files: [
					# includes files within path
					expand: true
					flatten: true
					src: [
						"Resources/Public/Components/bootstrap/fonts/*"
						"Resources/Public/Components/font-awesome/fonts/*"
					]
					dest: "Resources/Public/Distribution/Fonts/"
					filter: "isFile"
				]
			images:
				files: [
					# includes files within path
					expand: true
					flatten: true
					src: [
						"Temporary/Build/Images/jquerycolorbox/res/css/images/*"
					]
					dest: "Resources/Public/Distribution/Images/"
					filter: "isFile"
				]

	##
	# Assets: optimize assets for the web
	##
		pngmin:
			src: [
				'../jquerycolorbox/res/css/images/*.png'
			],
			dest: 'Temporary/Build/Images/'

		gifmin:
			src: [
				'../jquerycolorbox/res/css/images/*.gif'
			],
			dest: 'Temporary/Build/Images/'

		jpgmin:
			src: [
				'../jquerycolorbox/res/css/images/*.jpg'
			],
			dest: 'Temporary/Build/Images/'

	############################ StyleSheets ############################

	##
	# StyleSheet: importation of "external" stylesheets form third party extensions.
	##
		import:
			jquerycolorbox:
				files:
					"Temporary/Source/colorbox.css": "../jquerycolorbox/res/css/*.css"
				options:
					replacements: [
						pattern: 'images/',
						replacement: '../Images/'
					]

	##
	# StyleSheet: compiling to CSS
	##
		sass: # Task
			dist: # Target
				options: # Target options
				# output_style = expanded or nested or compact or compressed
					style: "expanded"

				files:
				# must comme last in the concatation process
					"Temporary/Source/zzz_main.css": "Resources/Public/StyleSheets/Sass/main.scss" # "destination": "source"

	########## concat css + js ############
		concat:
			css:
				src: [
					"Temporary/Source/*.css",
				],
				dest: "Temporary/Build/site.css",
			options:
				separator: ";"
			js:
				src: [
					"Resources/Public/Components/jquery/jquery.min.js"
					"Resources/Public/Components/modernizr/modernizr.js"
					"Resources/Public/Components/bootstrap/dist/js/bootstrap.min.js"
					"Temporary/main.min.js"
				]
				dest: "Resources/Public/Distribution/JavaScript/site.min.js"

	##
	# StyleSheet: minification of CSS
	##
		cssmin:
			options: {}
			release:
				files:
					"Resources/Public/Distribution/StyleSheets/site.min.css": [
						"Temporary/Build/*"
					]



	########## uglify js ############
		uglify:
			options:
				banner: "/*! <%= pkg.name %> <%= grunt.template.today(\"dd-mm-yyyy\") %> */\n"
			dist:
				files:
					"Temporary/main.min.js": ["<%= jshint.files %>"]

		jshint:
			files: [
				"Resources/Public/JavaScript/main.js"
				"Resources/Public/JavaScript/plugins.js"
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


	########## Watcher ############
		watch:
			css:
				files: ["Resources/Public/StyleSheets/Sass/*.scss"]
				tasks: ["css"]
			js:
				files: ["<%= jshint.files %>"]
				tasks: ["js"]


	########## Help ############
	grunt.registerTask "help", "Just display some helping output.", () ->
		grunt.log.writeln "Usage:"
		grunt.log.writeln ""
		grunt.log.writeln "- grunt watch          : watch your file and compile as you edit"
		grunt.log.writeln "- grunt release        : release your assets ready to be deployed"
		grunt.log.writeln "- grunt release-css    : only release your css files"
		grunt.log.writeln "- grunt release-js     : only release your js files"
		grunt.log.writeln "- grunt release-images : only release images"
		grunt.log.writeln ""
		grunt.log.writeln "Use grunt --help for a more verbose description of this grunt."
		return

	grunt.loadNpmTasks "grunt-contrib-uglify"
	grunt.loadNpmTasks "grunt-contrib-jshint"
	grunt.loadNpmTasks "grunt-contrib-watch"
	grunt.loadNpmTasks "grunt-contrib-concat"
	grunt.loadNpmTasks "grunt-contrib-sass";
	grunt.loadNpmTasks "grunt-contrib-cssmin"
	grunt.loadNpmTasks "grunt-contrib-copy"
	grunt.loadNpmTasks "grunt-contrib-clean"
	grunt.loadNpmTasks "grunt-string-replace"
	grunt.loadNpmTasks "grunt-imagine"

	grunt.task.renameTask("string-replace", "import")

	# https: / /github.com/ asciidisco / grunt - imagine
	#grunt.loadNpmTasks("grunt-imagine")

	#	grunt.registerTask("test", ["jshint", "qunit"]);
	grunt.registerTask "test", ["jshint"]
	#grunt.registerTask "css", ["sass", "concat:css", "cssmin"]
	grunt.registerTask "js", ["jshint", "uglify", "concat:js"]
	grunt.registerTask "release", ["release-js", "release-css", "release-images"] # release ? build?
	grunt.registerTask "release-js", ["js"]
	grunt.registerTask "release-css", ["clean", "import", "sass", "concat:css", "cssmin"]
	grunt.registerTask "release-images", ["pngmin", "gifmin", "jpgmin","copy"]
	grunt.registerTask "r-css", ["release-css"]
	grunt.registerTask "r-js", ["release-js"]
	grunt.registerTask "r-images", ["release-images"]

	#	grunt.registerTask("default", ["jshint", "qunit", "concat", "uglify"]);
	grunt.registerTask "default", ["help"]
	return