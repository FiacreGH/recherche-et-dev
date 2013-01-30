<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Fluid Pages: Bootstrap package');


# Include custom TCA
$recordTypes = array('Pages', 'BeUsers');
$configurationPath = t3lib_extMgm::extPath($_EXTKEY) . '/Configuration/TCA';
foreach ($recordTypes as $recordType) {
	$configurationFile = $configurationPath . '/' . $recordType . '.php';
	if (file_exists($configurationFile)) {
		include_once ($configurationFile);
	}
}
