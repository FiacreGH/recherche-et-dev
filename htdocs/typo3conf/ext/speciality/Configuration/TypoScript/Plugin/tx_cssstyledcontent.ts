###################################################
# Plugin CSS Styled Content
###################################################

# Remove default CSS of css_styled_content
plugin.tx_cssstyledcontent._CSS_DEFAULT_STYLE >

# Configure table
lib.parseFunc_RTE {
	externalBlocks {
		table.stdWrap.HTMLparser.tags.table.fixAttrib.class {
			default = table table-striped table-hover table-condensed
			always = 1
			list >
		}
	}
}