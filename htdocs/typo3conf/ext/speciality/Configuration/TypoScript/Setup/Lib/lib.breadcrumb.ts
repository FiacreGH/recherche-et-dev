###################################################
# Breadcrumb
###################################################

lib.breadcrumb = COA
lib.breadcrumb {
	10 = HMENU
	10 {
		special = rootline
		special.range = 0|-1
		1 = TMENU
		1 {
			allWrap = |
			noBlur = 1
			NO.linkWrap = |&nbsp;&gt;&nbsp; |*| |&nbsp;&gt;&nbsp; |*| |
			NO.doNotLinkIt = 0 |*| 0 |*| 1
			NO.ATagTitle.field = abstract // description // subtitle
			NO.stdWrap.htmlSpecialChars = 1
		}
	}

}