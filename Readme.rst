How to install?
===============

Follow these step to get the website running - in no time I would add if I would be a marketing guy :) ::

	# Clone the repository
	git clone https://github.com/Ecodev/bootstrap_package.git

	# If composer is not yet installed.
	# hint: consider installing "composer" globally in your system at one point.
	curl -s https://getcomposer.org/installer | php

	# Install the dependencies
	php composer.phar install

	# Next todo
	-> configure a Virtual Host and DNS entries (e.g editing /etc/hosts file)
	-> go to http://example.com and run the 1,2,3 wizard

Notice the ``htdocs`` folder located at the root of the direction is not mandatory. It just matches our hosting convention.
If you want to get rid of it, rename the file structure to your convenient before the step "configure a Virtual Host"

Finish installation for production
==================================

@todo complete this section

!!! Important notice, for production usage consider the following step:

* remove the extension ``introduction_bootstrap`` located at ``htdocs/typo3conf/ext/introduction_bootstrap``.
  The extension has become useless once the website has been installed.
* Security hint put the database password into directory ``private`` at the root
* select the language package in the BE. @todo provide a on-line tutorial how to do that.


Todo
=========

I have at least three todo list for this project, below is the fourth one ;)

@todo document EXT:speciality what it does and for what reason
@todo document folder features how to use the features tests


Override configuration for development
---------------------------------------

@todo complete me! This section is under writing.

While developing the website in a development context, it might be interesting to override some default values such as the domain name for instance.
It can be performed by adding configuration in directory ``Configuration/Development`` with two TS configuration files:

* setup.txt
* constants.txt

Theses two files will override the default configuration since loaded on the top.
