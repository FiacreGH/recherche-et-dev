<?php

// Configure BeUsers

# Allows BE User to be put on different page as pid = 0
\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('be_users');
$TCA['be_users']['ctrl']['rootLevel'] = -1;

?>