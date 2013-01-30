###################################################
# lib.nav (Main Navigation in Header)
###################################################

lib.nav = HMENU
lib.nav {
	entryLevel = 0

	1 = TMENU
	1 {
		noBlur = 1
		wrap = <ul class="unstyled"> | </ul>
		NO {
			wrapItemAndSub = <li> | </li>
			ATagTitle.field = title
		}
		ACT = 1
		ACT {
			wrapItemAndSub = <li class="active"> | </li>
			ATagTitle.field = title
		}
	}
}
