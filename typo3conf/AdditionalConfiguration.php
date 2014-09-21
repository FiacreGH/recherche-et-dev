<?php

// Security tip for production: putting the database password outside the document root!
$databaseCredentialsFile = PATH_site . '../configuration/Settings.php';
if (file_exists($databaseCredentialsFile)) {
	require_once ($databaseCredentialsFile);

	# file ``configuration/Settings.php`` should contains something like:
	# Database settings
	//$GLOBALS['TYPO3_CONF_VARS']['DB']['database'] = '';
	//$GLOBALS['TYPO3_CONF_VARS']['DB']['host'] = '';
	//$GLOBALS['TYPO3_CONF_VARS']['DB']['password'] = '';
	//$GLOBALS['TYPO3_CONF_VARS']['DB']['username'] = '';

	# Backend settings
	//$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword'] = '';
}

# Frontend Settings
#$GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFound_handling'] = '404.html';

// Add some more prefix table for the live search (the top right search)
// Usage for editor: #user:foo
$GLOBALS['TYPO3_CONF_VARS']['SYS']['livesearch']['fe_user'] = 'fe_users';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['livesearch']['user'] = 'fe_users';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['livesearch']['fe_group'] = 'fe_groups';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['livesearch']['group'] = 'fe_groups';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['livesearch']['be_user'] = 'be_users';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['livesearch']['be_group'] = 'be_groups';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['livesearch']['address'] = 'tt_address';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['livesearch']['news'] = 'news';

// Add configuration for Development Context
if (\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isDevelopment()) {
	$GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = '1';
	$GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] = '1';
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = '*';
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = '1';
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['enableDeprecationLog'] = 'file';
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug'] = '1';
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLogLevel'] = '0';
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['exceptionalErrors'] = '28674';
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['clearCacheSystem'] = '1';
}

// Declare Content Rendering for the Frontend
$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'] = array('fluidcontentcore/Configuration/TypoScript/');
