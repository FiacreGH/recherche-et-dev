###################################################
# Config
###################################################

config {

	# If set, the stdWrap property “prefixComment” will be disabled, thus preventing any revealing and space-consuming comments in the HTML source code.
	disablePrefixComment = 1

	# If set, the inline styles TYPO3 controls in the core are written to a file
	inlineStyle2TempFile = 1

	# All javascript (includes and inline) will be moved to the bottom of the html document
	moveJsFromHeaderToFooter = 0

	# If set, the default JavaScript in the header will be removed (blurLink function and browser detection variables)
	removeDefaultJS = 1

	# If set inline or externalized (see removeDefaultJS above) JavaScript will be minified.
	# Minification will remove all excess space and cause faster page loading.
	minifyJS = 1

	#
	minifyCss = 0

	#
	concatenateJsAndCss = 0

	# Add L and print values to all links in TYPO3.
	linkVars = L, print

	# Charset, should always be utf-8
	renderCharset = utf-8

	#
	metaCharset = utf-8

	# Setting up the language variable "L" to be passed along with links
	linkVars = L(int), print

	# html5? Yeah!
	doctype = html_5

	# XML? Not that!
	xmlprologue = none

	#
	prefixLocalAnchors = all

	# The <base> tag in the header of the document which is used by RealURL
	# Not set for the time being to stay portable
	#baseURL = http://{$config.domain}/

	# For pages
	index_enable = {$config.index_enable}

	# For documents
	index_externals = {$config.index_externals}

	#
	index_metatags = 0

	# If set, then every “typolink” is checked whether it's linking to a page within the current rootline of the site.
    typolinkCheckRootline = 1

    # This option enables to create links across domains using current domain's linking scheme.
    typolinkEnableLinksAcrossDomains = 1

    # Spam protection
    spamProtectEmailAddresses = ascii

    #
	spamProtectEmailAddresses_atSubst = (at)

	#
	spamProtectEmailAddresses_lastDotSubst = (dot)

    # Enable RealURL
    tx_realurl_enable = 1

    #
    sendCacheHeaders = 1

    #
	content_from_pid_allowOutsideDomain = 1

	#
	pageTitleFirst = 0


	# If this value is set, then all relative links in TypoScript are prepended with this string.
	# Used to convert relative paths to absolute paths.
	absRefPrefix = /

	#
	#headerComment = Integration and development - http://example.com/
}
