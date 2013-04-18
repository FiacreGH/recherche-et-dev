<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Fluid Pages: Bootstrap package');

//# Add page TSConfig
$pageTsConfig = \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl(
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TsConfig/Page/config.ts');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig($pageTsConfig);

# Add user TSConfig
$userTsConfig = \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl(
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TsConfig/User/config.ts');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig($userTsConfig);

# Include custom TCA
# @todo adjust compatibility TYPO3 6.1
$recordTypes = array('BeUsers');
$configurationPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . '/Configuration/TCA';
foreach ($recordTypes as $recordType) {
	$configurationFile = $configurationPath . '/' . $recordType . '.php';
	if (file_exists($configurationFile)) {
		include_once ($configurationFile);
	}
}

// Configure Pages
# @todo adjust compatibility TYPO3 6.1
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