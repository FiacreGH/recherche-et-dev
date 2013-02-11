/**
* Rich Text Editor Setup
*
* @author Jean-David Gadina <macmade@gadlab.net>
* @author Fabien Udriot <fabien.udriot@ecodev.ch>
* @version 3.1
*/

## RTE Links
RTE.default {
	classesAnchor := addToList(more)
	classesAnchor := addToList(button contact-button)
	classesAnchor := addToList(button contact-button button-red)
	classesAnchor := addToList(list-items)
	classesAnchor := addToList(pdf-download)
}

RTE {
	// Classes definition
	classes >

	// Anchor classes definition
	classesAnchor >
	classesAnchor {

		// Extenral
		externalLink {
			type = url
			altText = LLL:EXT:rtehtmlarea/htmlarea/plugins/TYPO3Browsers/locallang.xml:external_link_altText
		}

		// External in new window
		externalLinkInNewWindow {
			class = external-link-new-window
			type = url
			altText = LLL:EXT:rtehtmlarea/htmlarea/plugins/TYPO3Browsers/locallang.xml:external_link_new_window_altText
		}

		// Internal
		internalLink {
			class = internal-link
			type = page
			altText = LLL:EXT:rtehtmlarea/htmlarea/plugins/TYPO3Browsers/locallang.xml:internal_link_altText
		}

		// Internal in new window
		internalLinkInNewWindow {
			class = internal-link-new-window
			type = page
			altText = LLL:EXT:rtehtmlarea/htmlarea/plugins/TYPO3Browsers/locallang.xml:internal_link_new_window_altText
		}

		// Download
		download {
			class = download
			type = file
			altText = LLL:EXT:rtehtmlarea/htmlarea/plugins/TYPO3Browsers/locallang.xml:download_altText
		}

		// Mail
		mail {
			class = mail
			type = mail
			altText = LLL:EXT:rtehtmlarea/htmlarea/plugins/TYPO3Browsers/locallang.xml:mail_altText
		}
	}

	// Default RTE configuration (all tables)
	default {

		// Disable RTE
		disable = 0

		// Available classes for HTML elements
		#classesParagraph >
		classesTable >
		classesTD >
		classesLinks >
		# NOTE - BUG : *devrait* vider les styles du selectbox mais ce n'est pas le cas (cf. au font du TS)
		classesCharacter >
		classesAnchor >
		classesImage >

		classesCharacter = underline,strikethrough,mono,file,directory,read-more,read-more-text
		ignoreMainStyleOverride = 1

		// Anchor classes
		classesAnchor = external-link,external-link-new-window,internal-link,internal-link-new-window,download,mail

		// Default anchor classes
		classesAnchor.default {
			page = internal-link
			url = external-link-new-window
			file = download
			mail = mail
		}

		// Show tags from content CSS
		// -> works with external CSS
		showTagFreeClasses = 1

		// Disable examples styles
		disablePCexamples = 1

		// Disable Typo3 specific browsers
		disableTYPO3Browsers = 0

		// Tab elements to remove in the picture popup
		blindImageOptions >

		// Default target for links
		defaultLinkTarget = _top

		// Tab elements to remove in the link popup, remove tab file: "browse_links"
		blindLinkOptions >

		// Buttons to show
		showButtons = *

		// Buttons to hide
		hideButtons = textstylelabel, fontstyle, fontsize, strikethrough, subscript, superscript, textindicator, indent, outdent, emoticon, user, insertcharacter, lefttoright, righttoleft, acronym, inserttag, spellcheck, toggleborders

		// Toolbar order
		# After "ecoimages, bar, image"
		toolbarOrder = formatblock, blockstyle, textstyle, linebreak, bold, italic, underline, bar, textcolor, bgcolor, bar, orderedlist, unorderedlist, bar, left, center, right, justifyfull, linebreak, copy, cut, paste, bar, undo, redo, bar, findreplace, removeformat, bar, link, unlink, bar, image, ecoimages, ecodocuments, bar, table, bar, line, bar, insertparagraphbefore, insertparagraphafter, bar, chMode, showhelp, about, linebreak, tableproperties, rowproperties, rowinsertabove, rowinsertunder, rowdelete, rowsplit, columninsertbefore, columninsertafter, columndelete, columnsplit, cellproperties, cellinsertbefore, cellinsertafter, celldelete, cellsplit, cellmerge

		// Group buttons (Mozilla only)
		keepButtonGroupTogether = 1

		RTEHeightOverride = 600

		// Hide table operations
		hideTableOperationsInToolbar = 1

		//deprecated - Show toggle borders item even if table operations are disabled
		keepToggleBordersInToolbar = 0

		//If set, the toggleborders button will be kept in the tool bar even if property hideTableOperationsInToolbar is set.
		buttons.toggleborders.keepInToolbar = 1

		//hide / show HTML tag
		buttons.formatblock.orderItems = p, h1, h2, h3

		//If set, and if the toggleborders button is enabled, the table borders will be toggled on when a new table is created.
		buttons.toggleborders.setOnTableCreation = 1

		// Disable contextual menu
		disableContextMenu = 0
		disableRightClick = 0

		// Display status bar
		showStatusBar = 1

		// Disable color picker
		disableColorPicker = 0

		// Disable color selector
		disableSelectColor = 0

		// RTE stylesheet
		contentCSS = fileadmin/stylesheets/screen/rte.css

		// MS Word cleaning
		enableWordClean = 1

		// Remove HTML comments
		removeComments = 1

		// Remove HTML tags
		removeTags = font

		// Remove HTML tags and their content
		removeTagsAndContents =

		// Use CSS formatting when possible
		useCSS = 1

		// Disable enter key for new paragraphs creation
		disableEnterParagraphs = 0

		// Remove trailing BR if any
		removeTrailingBR = 1

		// Hide tags in the quick tag plugin
		hideTags = font, font (full)

		// Disable table attributes for table operations
		disableAlignmentFieldsetInTableOperations = 1
		disableSpacingFieldsetInTableOperations = 1
		disableColorFieldsetInTableOperations = 1
		disableLayoutFieldsetInTableOperations = 1
		disableBordersFieldsetInTableOperations = 1

		// Colors available
		colors = color1,color2,color3,color4,color5,color6

		// Processing rules
		proc {

			// Allowed Classes to be saved
			allowedClasses  < RTE.default.classesCharacter

			// Transformation method
			overruleMode = ts_css

			// Do not convert BR into linebreaks
			dontConvBRtoParagraph = 1

			// Map paragraph tag
			remapParagraphTag = p

			// Tags allowed
			allowTags = a, abbr, acronym, address, blockquote, b, br, caption, center, cite, code, div, em, font, h1, h2, h3, h4, h5, h6, hr, i, img, li, link, ol, p, pre, q, sdfield, span, strike, strong, sub, sup, table, thead, tbody, tfoot, td, th, tr, tt, u, ul

			// Tags denied
			denyTags >

			// Attributes to keep for P & DIV
			keepPDIVattribs = xml:lang,class,style,align

			// Tags allowed outside P & DIV
			allowTagsOutside = img,hr,table,tr,th,td,h1,h2,h3,h4,h5,h6,br,ul,ol,li,pre,address,span

			// Tags allowed in Typolists
			allowTagsInTypolists = br,font,b,i,u,a,img,span

			// Keep unknown tags
			dontRemoveUnknownTags_db = 1

			// Allow tables
			preserveTables = 1

			// Entry HTML parser
			entryHTMLparser_db = 1
			entryHTMLparser_db {

				// Tags allowed
				allowTags < RTE.default.proc.allowTags

				// Tags denied
				denyTags >

				// HTML special characters
				htmlSpecialChars = 0

				// Allow IMG tags
				tags.img >

				// Allow attributes
				tags.span.fixAttrib.style.unset >
				tags.p.fixAttrib.align.unset >
				tags.div.fixAttrib.align.unset >

				// Additionnal attributes for P & DIV
				tags.div.allowedAttribs = class,style,align
				tags.p.allowedAttribs = class,style,align

				// Tags to remove
				removeTags = center, font, o:p, sdfield, strike, u

				// Keep non matched tags
				keepNonMatchedTags = protect
			}

			// HTML parser
			HTMLparser_db {

				// Strip attributes
				noAttrib = br

				// XHTML compliance
				xhtml_cleaning = 1
			}

			// Exit HTML parser
			exitHTMLparser_db = 1
				exitHTMLparser_db {

				// Remap bold and italic
				tags.b.remap = strong
				tags.i.remap = em

				// Keep non matched tags
				keepNonMatchedTags = 1

				// HTML special character
				htmlSpecialChars = 0
			}
		}
	}
}

// MS Word clean options
RTE.default.enableWordClean.HTMLparser < RTE.default.proc.entryHTMLparser_db

// Frontend RTE configuration
RTE.default.FE < RTE.default


