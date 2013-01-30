<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ext_templates/Configuration/TsConfig/PageTsConfig/Rte.ts">

mod.SHARED {
  defaultLanguageFlag = de.gif
  defaultLanguageLabel = German
}

# PAGE DEFAULT PERMISSIONS
TCEMAIN.permissions {

	# NEW PAGES RIGHT
	# do anything (default):
	user = 31
	# do anything (normally "delete" is disabled)
	group = 31
	# (normally everybody can do nothing)
	everybody =

	# user: default user
	# userid = 6

	# group _Users
	groupid = 1
}

// Full screen for bodytext (tt_content)
TCEFORM.tt_content.bodytext.RTEfullScreenWidth= 100%

mod.web_txtemplavoilaM1 {
	stylesheet = ../typo3conf/ext/ext_templates/Resources/Public/Backend/Css/styles.css
	javascript.jquery = ../typo3conf/ext/ext_templates/Resources/Public/Backend/JavaScript/jquery-1.6.2.min.js
	javascript.file1 = ../typo3conf/ext/ext_templates/Resources/Public/Backend/JavaScript/script.js
}

TCEFORM.tt_content.layout.altLabels {
	1 = Lightbox
	2 = Grey
}

TCEMAIN.table.tt_content {
	disablePrependAtCopy = 1
	disableHideAtCopy = 0
}

# TemplaVoilà configuration
templavoila.wizards.newContentElement.renderMode = tabs
mod.web_txtemplavoilaM1.enableDeleteIconForLocalElements = 2
