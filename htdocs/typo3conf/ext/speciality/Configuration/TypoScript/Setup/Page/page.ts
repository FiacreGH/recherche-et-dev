################
# page
################

#page >
#page = PAGE
page {
	typeNum = 0

	#1 = TEXT
	#1 {
	#	data = field : description
	#	data.isTrue = 1
	#	wrap = <p class="visuallyhidden">|</p>
	#}

	10 = USER
	10.userFunc = tx_extbase_core_bootstrap->run
	10.extensionName = Fluidpages
	10.pluginName = Page

	# JS for Footer
	2000 = TEXT
	2000.value (
	)

	# body-tag
	bodyTag >
	bodyTagCObject = TEXT
	bodyTagCObject.field = uid
	bodyTagCObject.wrap = <body class="page-|">
    adminPanelStyles = 0
}

# remove class bodytext
#lib.parseFunc_RTE.nonTypoTagStdWrap.encapsLines.addAttributes.P.class >
