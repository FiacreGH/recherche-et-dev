<?php

// Configure BeUsers

# Allows BE User to be put on different page as pid = 0
t3lib_div::loadTCA('be_users');
$TCA['be_users']['ctrl']['rootLevel'] = -1;

?>