###################################################
# lib.content
###################################################

lib.content {

	left < styles.content.getLeft
	left.select.where = colPos=0

	main < styles.content.get
	main.select.where = colPos=2

	right < styles.content.getRight
	right.select.where = colPos=3
}
