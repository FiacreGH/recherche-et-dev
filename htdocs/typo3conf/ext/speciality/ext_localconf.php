<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

//# Include static TypoScript files from extensions.
//$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tstemplate.php']['includeStaticTypoScriptSources'][] =
//	'EXT:' . $_EXTKEY . '/Classes/Hooks/T3lib_TsTemplate.php:Tx_ExtTemplates_Hooks_T3lib_TsTemplate->preprocessIncludeStaticTypoScriptSources';

//# Computes Context
//if (!defined('TYPO3_CONTEXT')) {
//	if (getenv('TYPO3_CONTEXT')) {
//		define('TYPO3_CONTEXT', getenv('TYPO3_CONTEXT'));
//	} elseif (ini_get('TYPO3_ENV')) {
//		define('TYPO3_CONTEXT', ini_get('TYPO3_CONTEXT'));
//	} else {
//		define('TYPO3_CONTEXT', 'Production');
//	}
//}
//

# Default configuration
$defaultConfigurationFile = t3lib_extMgm::extPath($_EXTKEY) . '/Configuration/Php/DefaultConfiguration.php';
require_once($defaultConfigurationFile);


# Development configuration (override default configuration)
$developmentConfigurationFile = t3lib_extMgm::extPath($_EXTKEY) . '/Configuration/Development/DefaultConfiguration.php';
if (TYPO3_CONTEXT == 'Development' && file_exists($developmentConfigurationFile)) {
	include_once($developmentConfigurationFile);
}

?>
