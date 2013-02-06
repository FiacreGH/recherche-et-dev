###################################################
# Page header
###################################################

page = PAGE
page {

	headerData {

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

