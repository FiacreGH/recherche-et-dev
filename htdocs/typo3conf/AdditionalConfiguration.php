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

$GLOBALS['TYPO3_CONF_VARS']['BE']['elementVersioningOnly'] = '1';
$GLOBALS['TYPO3_CONF_VARS']['BE']['forceCharset'] = 'utf-8';
$GLOBALS['TYPO3_CONF_VARS']['BE']['interfaces'] = ''; # backend,frontend
$GLOBALS['TYPO3_CONF_VARS']['BE']['lockIP'] = '4';
$GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'] = '100000';
$GLOBALS['TYPO3_CONF_VARS']['BE']['sessionTimeout'] = '32400'; // 9 hours admin access
$GLOBALS['TYPO3_CONF_VARS']['BE']['warning_mode'] = '2';
$GLOBALS['TYPO3_CONF_VARS']['FE']['forceCharset'] = 'utf-8';
$GLOBALS['TYPO3_CONF_VARS']['FE']['lifetime'] = '31536000'; //for frontend user
$GLOBALS['TYPO3_CONF_VARS']['FE']['lockIP'] = '4';
$GLOBALS['TYPO3_CONF_VARS']['FE']['permalogin'] = '1';
$GLOBALS['TYPO3_CONF_VARS']['GFX']['png_truecolor'] = '1';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['USdateFormat'] = '0';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['ddmmyy'] = 'd.m.Y';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = '2';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['hhmm'] = 'g:i a';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['loginCopyrightShowVersion'] = '1';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['maxFileNameLength'] = '255';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['recursiveDomainSearch'] = '1';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['serverTimeZone'] = '0';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['textfile_ext'] = 'txt,html,htm,css,tmpl,js,sql,xml,csv,php,php3,php4,php5,php6,phpsh,inc,ts';

// http://foobar.lamp-solutions.de/howtos/typo3/typo3-tuning/3111/
$GLOBALS['TYPO3_CONF_VARS']['SYS']['enableDeprecationLog'] = '0';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['syslogErrorReporting'] = '0';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['belogErrorReporting'] = '0';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = '192.168.*,127.0.0.1';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLogLevel'] = 1;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = '2';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandler'] = 't3lib_error_ErrorHandler';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLogLevel'] = '2';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLog'] = 'error_log,,2;syslog,LOCAL0,,3';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['enable_errorDLOG'] = '0';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['enable_exceptionDLOG'] = '0';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['errorHandlerErrors'] = 0;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['exceptionalErrors'] = 0;

// MLC modify as needed for file and directory permissions
if (FALSE) {
	$GLOBALS['TYPO3_CONF_VARS']['BE']['fileCreateMask'] = '0664';
	$GLOBALS['TYPO3_CONF_VARS']['BE']['folderCreateMask'] = '0775';
}

// company support details
if (FALSE) {
	// admin login warning email
	$GLOBALS['TYPO3_CONF_VARS']['BE']['warning_email_addr'] = 'support@ecodev.ch';
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['loginCopyrightWarrantyProvider'] = 'Ecodev Sàrl';
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['loginCopyrightWarrantyURL'] = 'http://www.ecodev.ch/';
}

#curl and filepath helpers
$GLOBALS['TYPO3_CONF_VARS']['BE']['unzip_path'] = '/usr/bin/';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['binPath'] = '/usr/local/bin,/usr/bin';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['curlUse'] = '1';

$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'] = array('fluidcontentcore/Configuration/TypoScript/');