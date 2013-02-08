###################################################
# Plugin Flux
###################################################

# "tx_fed" for historical reason.
plugin.tx_fed {
	page.speciality {
		templateRootPath = EXT:speciality/Resources/Private/Templates/
		partialRootPath = EXT:speciality/Resources/Private/Partials/
		layoutRootPath = EXT:speciality/Resources/Private/Layouts/
	}
}

plugin.tx_flux.view.widget.Tx_Fluid_ViewHelpers_Widget_PaginateViewHelper.templateRootPath < plugin.tx_fed.page.fluidpages.templateRootPath
plugin.tx_news.view.widget.Tx_Fluid_ViewHelpers_Widget_PaginateViewHelper.templateRootPath < plugin.tx_fed.page.fluidpages.templateRootPath