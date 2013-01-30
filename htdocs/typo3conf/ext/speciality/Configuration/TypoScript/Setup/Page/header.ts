###################################################
# Page header
###################################################

page = PAGE
page {

	# @todo remove me if favicon.ico is placed at the root
	#shortcutIcon = EXT:speciality/Resources/Public/Icons/favicon.ico

	includeCSS {
		bootstrap = EXT:speciality/Resources/Public/Style/bootstrap.min.css
		bootstrap-responsive = EXT:speciality/Resources/Public/Style/bootstrap-responsive.min.css
		main = EXT:speciality/Resources/Public/Style/main.css
	}

	includeJS {
		#jquery = //ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js
	    #jquery.external = 1
	    #jquery.compress = 0
	    #jquery.forceOnTop = 1

	    jquery = EXT:speciality/Resources/Public/JavaScript/Libraries/jquery-1.9.0.min.js
		modernizr = EXT:speciality/Resources/Public/JavaScript/Libraries/modernizr-2.6.2-respond-1.1.0.min.js
	}

	includeJSFooter {
		bootstrap = EXT:speciality/Resources/Public/JavaScript/Libraries/bootstrap.min.js
		plugin = EXT:speciality/Resources/Public/JavaScript/plugins.js
		script = EXT:speciality/Resources/Public/JavaScript/main.js
	}

	jsFooterInline.10 = TEXT
	jsFooterInline.10.value (

	var _gaq = [
		['_setAccount', 'UA-XXXXX-X'],
		['_trackPageview']
	];
	(function (d, t) {
		var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
		g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g, s)
	}(document, 'script'));

)

	headerData {

		20 = TEXT
		20.value (
		)

		# Facebook OpenGraph
		#27 = TEXT
		#27.data =  field : subtitle // field : title
		#27.wrap = <meta property="og:title" content="|&nbsp;&#124; {$config.productName}">

		#28 = TEXT
		#28.data = field : description
		#28.wrap = <meta property="og:description" content="|">
	}

	# Doctype html5 for Boilerplate from Paul Irish
	config.doctype (
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="{$config.language}"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="{$config.language}"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="{$config.language}"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="{$config.language}">       <![endif]-->
<!--[if gt IE 9]><!-->
)
	config.htmlTag_setParams = lang="{$config.language}" class="no-js"><!--<![endif]--

	headTag(
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">

)
}

