<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Fluid Pages: Bootstrap package');

//# Add page TSConfig
$pageTsConfig = t3lib_div::getUrl(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TsConfig/Page/config.ts');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig($pageTsConfig);

# Add user TSConfig
$userTsConfig = t3lib_div::getUrl(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TsConfig/User/config.ts');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig($userTsConfig);

# Include custom TCA
$recordTypes = array('Pages', 'BeUsers');
$configurationPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . '/Configuration/TCA';
foreach ($recordTypes as $recordType) {
	$configurationFile = $configurationPath . '/' . $recordType . '.php';
	if (file_exists($configurationFile)) {
		include_once ($configurationFile);
	}
}
