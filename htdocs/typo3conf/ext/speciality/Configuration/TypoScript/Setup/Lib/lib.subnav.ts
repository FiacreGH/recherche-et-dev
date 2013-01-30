###################################################
# language Sub-Navigation
###################################################

lib.subnav = COA
lib.subnav.10 = HMENU
lib.subnav.10 {

	entryLevel = 1

	1 = TMENU
	1 {
		noBlur = 1
		expAll = 1
		wrap = <nav id="subnav"><ul> | </ul></nav>
		NO {
			wrapItemAndSub = <li>|</li>
			stdWrap.dataWrap = <span> | </span>
			ATagTitle.field = title
		}
		ACT < .NO
		ACT = 1
		ACT.wrapItemAndSub = <li class="active">|</li>
	}

	2 < .1
	2.wrap = <ul> | </ul>
	2.ACT.wrapItemAndSub = <li class="active">|</li>
}

