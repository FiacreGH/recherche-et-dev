A bunch of scripts for generating the TYPO3 CMS Bootstrap Package.

1. Install the dependencies with composer::

	curl -s https://getcomposer.org/installer | php
	php composer.phar install

2. Generate new Package. Each command has a ``--dry-run`` option displaying the command instead of executing them::

	# Update Core
	php console.php core-update

	# Update File distributions
	php console.php file-distribution-update

	# Check the status of the Git repository
	php console.php git-status

	# Update Git repository
	php console.php git-pull

	-> clear the cache
	-> Check what Feature Tests say

	# Create a SQL dump and move into EXT:introduction
	php console.php dump --move

	# Bundle the extension as t3x files and put them into EXT:introduction
	php console.php t3x-bundle

	# Bundle files and put them into EXT:introduction
	php console.php file-bundle

	-> push EXT:introduction

	# Create a package
	# @todo handle the FIRST_INSTALL_FILE + GeneralConfiguration
	php console.php package

	-> Install Package
	-> Run Feature Tests
	-> Push the zipball / tarball to github
	-> Communicate


