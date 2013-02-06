<?php

// Configure Pages
\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('pages');

// New icons for the BE
if (TYPO3_MODE == 'BE') {

	$icons = array('category', 'comment', 'storage', 'tesseract', 'news', 'people');
	foreach ($icons as $icon) {

		\TYPO3\CMS\Backend\Sprite\SpriteManager::addTcaTypeIcon(
			'pages',
			'contains-' . $icon,
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Backend/Icons/' . $icon . '.png');

		$TCA['pages']['columns']['module']['config']['items'][] = array(
			ucfirst($icon),
			$icon,
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Backend/Icons/' . $icon . '.png'
		);
	}
}

?>