<?php

// Configure BeUsers

# @todo adjust compatibility TYPO3 6.1
# * TCA files should now be located at ext:extensionname/Configuration/TCA/tablename.php' and should return
# an array with the TCA for the table specified by the filename.

# Allows BE User to be put on different page as pid = 0
\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('be_users');
$TCA['be_users']['ctrl']['rootLevel'] = -1;

?>