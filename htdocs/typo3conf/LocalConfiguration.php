<?php
return array(
	'BE' => array(
		'RTE_imageStorageDir' => '1:variants',
		'disable_exec_function' => 0,
		'explicitADmode' => 'explicitAllow',
		'fileCreateMask' => '0666',
		'folderCreateMask' => '2777',
		'loginSecurityLevel' => 'rsa',
	),
	'DB' => array(
		'extTablesDefinitionScript' => 'extTables.php',
		'host' => 'localhost',
		'socket' => '',
	),
	'EXT' => array(
		'extConf' => array(
			'fluidcontent' => 'a:1:{s:9:"removeTab";s:1:"0";}',
			'fluidcontent_bootstrap' => 'a:0:{}',
			'fluidpages' => 'a:1:{s:8:"doktypes";s:0:"";}',
			'flux' => 'a:3:{s:9:"debugMode";s:1:"0";s:7:"compact";s:1:"0";s:20:"rewriteLanguageFiles";s:1:"0";}',
			'indexed_search' => 'a:18:{s:8:"pdftools";s:9:"/usr/bin/";s:8:"pdf_mode";s:2:"20";s:5:"unzip";s:9:"/usr/bin/";s:6:"catdoc";s:9:"/usr/bin/";s:6:"xlhtml";s:9:"/usr/bin/";s:7:"ppthtml";s:9:"/usr/bin/";s:5:"unrtf";s:9:"/usr/bin/";s:9:"debugMode";s:1:"0";s:18:"fullTextDataLength";s:1:"0";s:23:"disableFrontendIndexing";s:1:"0";s:21:"enableMetaphoneSearch";s:1:"1";s:6:"minAge";s:2:"24";s:6:"maxAge";s:1:"0";s:16:"maxExternalFiles";s:1:"5";s:26:"useCrawlerForExternalFiles";s:1:"0";s:11:"flagBitMask";s:3:"192";s:16:"ignoreExtensions";s:0:"";s:17:"indexExternalURLs";s:1:"0";}',
			'infinite_scroll_gallery' => 'a:0:{}',
			'info' => 'a:0:{}',
			'jquerycolorbox' => 'a:0:{}',
			'linkvalidator' => 'a:0:{}',
			'media' => 'a:6:{s:18:"default_categories";s:1:"3";s:15:"image_thumbnail";s:7:"100x100";s:10:"image_mini";s:7:"120x120";s:11:"image_small";s:7:"320x320";s:12:"image_medium";s:7:"760x760";s:11:"image_large";s:9:"1200x1200";}',
			'metadata' => 'a:0:{}',
			'nc_staticfilecache' => 'a:8:{s:23:"clearCacheForAllDomains";s:1:"1";s:22:"sendCacheControlHeader";s:1:"0";s:27:"enableStaticFileCompression";s:1:"1";s:23:"showGenerationSignature";s:1:"1";s:8:"strftime";s:36:"cached statically on: %d-%m-%y %H:%M";s:5:"debug";s:1:"0";s:11:"recreateURI";s:1:"0";s:26:"markDirtyInsteadOfDeletion";s:1:"0";}',
			'news' => 'a:12:{s:29:"removeListActionFromFlexforms";s:1:"0";s:20:"pageModuleFieldsNews";s:313:"LLL:EXT:news/Resources/Private/Language/locallang_be.xml:pagemodule_simple=title,datetime;LLL:EXT:news/Resources/Private/Language/locallang_be.xml:pagemodule_advanced=title,datetime,teaser,category;LLL:EXT:news/Resources/Private/Language/locallang_be.xml:pagemodule_complex=title,datetime,teaser,category,archive;";s:24:"pageModuleFieldsCategory";s:17:"title,description";s:6:"tagPid";s:1:"1";s:13:"prependAtCopy";s:1:"1";s:19:"categoryRestriction";s:4:"none";s:22:"contentElementRelation";s:1:"0";s:13:"manualSorting";s:1:"0";s:11:"archiveDate";s:4:"date";s:12:"showImporter";s:1:"0";s:24:"showAdministrationModule";s:1:"1";s:25:"showMediaDescriptionField";s:1:"0";}',
			'realurl' => 'a:5:{s:10:"configFile";s:21:"typo3conf/RealUrl.php";s:14:"enableAutoConf";s:1:"1";s:14:"autoConfFormat";s:1:"0";s:12:"enableDevLog";s:1:"0";s:19:"enableChashUrlDebug";s:1:"0";}',
			'rtehtmlarea' => 'a:13:{s:21:"noSpellCheckLanguages";s:23:"ja,km,ko,lo,th,zh,b5,gb";s:15:"AspellDirectory";s:15:"/usr/bin/aspell";s:17:"defaultDictionary";s:2:"en";s:14:"dictionaryList";s:2:"en";s:20:"defaultConfiguration";s:105:"Typical (Most commonly used features are enabled. Select this option if you are unsure which one to use.)";s:12:"enableImages";s:1:"1";s:20:"enableInlineElements";s:1:"0";s:19:"allowStyleAttribute";s:1:"1";s:24:"enableAccessibilityIcons";s:1:"0";s:16:"enableDAMBrowser";s:1:"0";s:16:"forceCommandMode";s:1:"0";s:15:"enableDebugMode";s:1:"0";s:23:"enableCompressedScripts";s:1:"1";}',
			'saltedpasswords' => 'a:2:{s:3:"FE.";a:2:{s:7:"enabled";s:1:"1";s:21:"saltedPWHashingMethod";s:28:"tx_saltedpasswords_salts_md5";}s:3:"BE.";a:1:{s:21:"saltedPWHashingMethod";s:28:"tx_saltedpasswords_salts_md5";}}',
			'scheduler' => 'a:4:{s:11:"maxLifetime";s:4:"1440";s:11:"enableBELog";s:1:"1";s:15:"showSampleTasks";s:1:"1";s:11:"useAtdaemon";s:1:"0";}',
			'seo_basics' => 'a:2:{s:10:"xmlSitemap";s:1:"1";s:16:"sourceFormatting";s:1:"1";}',
			'speciality' => 'a:1:{s:7:"context";s:11:"Development";}',
			'speciality_distribution' => 'a:0:{}',
			'vhs' => 'a:0:{}',
			'vidi' => 'a:2:{s:10:"data_types";s:18:"fe_users,fe_groups";s:11:"default_pid";s:1:"1";}',
			'wt_spamshield' => 'a:10:{s:12:"useNameCheck";s:1:"0";s:12:"usehttpCheck";s:1:"3";s:9:"notUnique";s:0:"";s:13:"honeypodCheck";s:1:"1";s:15:"useSessionCheck";s:1:"1";s:16:"SessionStartTime";s:2:"10";s:14:"SessionEndTime";s:3:"600";s:10:"AkismetKey";s:0:"";s:12:"email_notify";s:0:"";s:3:"pid";s:2:"-1";}',
		),
	),
	'EXTCONF' => array(
		'lang' => array(
			'availableLanguages' => array(
				'vi',
			),
		),
	),
	'FE' => array(
		'loginSecurityLevel' => 'rsa',
		'pageNotFound_handling' => 'http://bootstrap.fab/index.php?id=16',
	),
	'GFX' => array(
		'gdlib_png' => 1,
		'im_mask_temp_ext_gif' => 1,
		'im_path' => '/usr/local/bin/',
		'im_path_lzw' => '',
		'im_v5effects' => -1,
		'im_version_5' => 'gm',
		'jpg_quality' => '80',
	),
	'INSTALL' => array(
		'wizardDone' => array(
			'TYPO3\CMS\Install\Updates\FileIdentifierHashUpdate' => 1,
			'TYPO3\CMS\Install\Updates\FilemountUpdateWizard' => 1,
			'TYPO3\CMS\Install\Updates\TceformsUpdateWizard' => 'tt_content:image,pages:media,pages_language_overlay:media',
			'TYPO3\CMS\Install\Updates\TruncateSysFileProcessedFileTable' => 1,
		),
	),
	'SYS' => array(
		'compat_version' => '6.2',
		'encryptionKey' => '5b407ed0280fc56fe927a58b6d0f55ae952525e35ee059b90012843251734eb6a6dea50133bb51621f6555dcfa400d1e',
		'sitename' => 'New TYPO3 site',
	),
);
?>