<?php

// Configure Pages
\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('pages');

$relativePath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY);

// @todo remove me if not used
#$TCA['pages']['columns']['module']['config']['items'][] = array('TypoScript', 'typoscript', '../typo3/sysext/t3skin/icons/module_web_ts.gif');
#$ICON_TYPES['typoscript']['icon'] = '../typo3/sysext/t3skin/icons/module_web_ts.gif';

#$TCA['pages']['columns']['module']['config']['items'][] = array('Tesseract', 'tesseract', $relativePath . 'Resources/Public/Backend/Icons/cog.png');
#$ICON_TYPES['tesseract']['icon'] = $relativePath . 'Resources/Public/Backend/Icons/cog.png';

# Icon already exists
#$TCA['pages']['columns']['module']['config']['items'][] = array('News', 'news', $relativePath . 'Resources/Public/Backend/Icons/folder_page.png');
#$ICON_TYPES['news']['icon'] = $relativePath . 'Resources/Public/Backend/Icons/folder_page.png';

$TCA['pages']['columns']['module']['config']['items'][] = array('Global Storage', 'storage', $relativePath . 'Resources/Public/Backend/Icons/folder_wrench.png');
$ICON_TYPES['storage']['icon'] = $relativePath . 'Resources/Public/Backend/Icons/folder_wrench.png';

$TCA['pages']['columns']['module']['config']['items'][] = array('Category', 'category', $relativePath . 'Resources/Public/Backend/Icons/folder_palette.png');
$ICON_TYPES['category']['icon'] = $relativePath . 'Resources/Public/Backend/Icons/folder_palette.png';

$TCA['pages']['columns']['module']['config']['items'][] = array('Addresses', 'addresses', $relativePath . 'Resources/Public/Backend/Icons/group.png');
$ICON_TYPES['addresses']['icon'] = $relativePath . 'Resources/Public/Backend/Icons/group.png';

$TCA['pages']['columns']['module']['config']['items'][] = array('Comments', 'comments', $relativePath . 'Resources/Public/Backend/Icons/comment.png');
$ICON_TYPES['comments']['icon'] = $relativePath . 'Resources/Public/Backend/Icons/comment.png';

$TCA['pages']['columns']['module']['config']['items'][] = array('Tags', 'tags', $relativePath . 'Resources/Public/Backend/Icons/tag_yellow.png');
$ICON_TYPES['tags']['icon'] = $relativePath . 'Resources/Public/Backend/Icons/tag_yellow.png';

?>