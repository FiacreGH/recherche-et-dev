Bootstrap package for TYPO3 CMS
================================

The aim of this package is not only to provide a ready to go website but also be a framework for developing TYPO3 website base on the finest technology.

cut down the starting time for every project to focus in the interesting job!

  Boilerplate

Keywords

* Twitter Bootstrap as HTML / CSS Framework
* Templating based on Fluid @todo link
* Composer for managing extensions.

How to install?
===============

Follow these steps to get the website running - in no time I would be a marketing guy :) ::

	# Clone the repository
	git clone https://github.com/Ecodev/bootstrap_package.git


	# If composer is not yet installed.
	# hint: consider installing "composer" globally in your system at one point.
	cd bootstrap_package
	curl -s https://getcomposer.org/installer | php

	# Install the dependencies
	php composer.phar install

	# Download TYPO3 CMS Core
	cd htdocs
	wget get.typo3.org/current -O typo3_src-latest.tgz

	# Extract TYPO3 CMS Core archive and symlink
	tar -xzf typo3_src-latest.tgz
	rm typo3_src-latest.tgz
	ln -s typo3_src-* typo3_src

	# Manual steps
	-> configure a Virtual Host and DNS entries (e.g editing /etc/hosts file)
	-> open in the browser http://example.com and run the 1,2,3 wizard

Notice the ``htdocs`` folder located at the root of the direction is not mandatory. It just matches our hosting convention.
If you want to get rid of it, rename the file structure to your convenient before the step "configure a Virtual Host"

How to customize?
==================

Development happen in Speciality. With the EXT:, il mean extension located in typo3conf/ext. Speciality is just the extension name we use in our company to know where to code (versus each website its own one.

Tutorial: copy file 3column to 4columns and change every

More example into Claus Due example


Building its own dump
==================================

If one need to build a SQL dump of its own website including the changes made along the way, there is a script within the build directory that may be useful for dumping the database.
Proceed as follow::

	cd build

	# To get the usage
	./dump.php --help

	# Before running the script for real display the command on the console.
	./dump.php --dry-run


Hint for production
==================================

!!! Important notice, for production usage consider doing the following step:

* remove the extension ``introduction_bootstrap`` located at ``htdocs/typo3conf/ext/introduction_bootstrap``.
  The extension has become useless once the website has been installed.
* Suggested security put the database password into directory ``private`` at the root.
* select the language package in the BE. @todo provide a on-line tutorial how to do that.
* Update the Index Reference (for
	php /Users/fudriot/Sites/Ecodev/dummy.fab/htdocs/typo3/cli_dispatch.phpsh lowlevel_refindex -c

* ... there are probably more tips to come here...


Todo
=========

I have at least three todo list for this project, below is the fourth one ;)

@todo document EXT:speciality what it does and for what reason
@todo document folder features how to use the features tests


Override configuration for development
---------------------------------------

@todo check if this still true!

While developing the website in a development context, it might be interesting to override some default values such as the domain name for instance.
It can be performed by adding configuration in directory ``EXT:speciality/Configuration/Development``.

There are two TypoScript files that are going to be automatically included and override the default configuration:

* setup.txt
* constants.txt

File ``EXT:speciality/Configuration/Development/DefaultConfiguration.php`` will also be included. Make sure you don't load changes after that if you want the settings to be applied.