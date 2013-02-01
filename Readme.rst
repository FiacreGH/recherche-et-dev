Bootstrap package for TYPO3 CMS
================================

This is another introduction package for TYPO3 CMS with some variants that may interest you:

* Twitter Bootstrap as HTML / CSS Framework
* Entirely based on **Fluid** form the templating and rendering.
* Folder ``fileadmin`` is kept for media only (images, documents etc...) and is kept clean from JavaScript / CSS files.
* `Composer`_ as an alternative for managing and installing extensions.

.. _Composer: http://getcomposer.org/

How to install?
===============

Follow these steps to get the website running - in no time if I would talk marketing :) ::

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


Notice the ``htdocs`` folder located at the root of the direction is not mandatory. It just matches our hosting convention in our company.
If you want to get rid of it, rename the file structure to your convenience when configuring the Virtual Host.

--Notice the composer step is not mandatory-- (**not true as of today since ``EXT:speciality`` was not published on the TER**).
The difference is that extensions will be fetched from the TER and managed from the Extension Manager for update which is fine
but not as fancy as the composer approach. Besides the fancy part, the main reasons to use Composer is the capability to handle extension from Git / SVN repositories.


How to customize?
==================

As a next step, you likely want to change the CSS, add some custom layouts or customize configuration.
The place to head to is ``EXT:speciality`` which is located at ``htdocs/typo3conf/ext/speciality``. The name "speciality"
is just the extension we are using in our company as convention. We keep it across our projects so that we don't have to think more
where to find the source code. This is not a big deal to change the name.

As a short tutorial, let assume one needs to add a 4 column layout in the website. Proceed as follows:

* Copy ``EXT:speciality/Resources/Private/Templates/Page/3Columns.html`` to ``EXT:speciality/Resources/Private/Templates/Page/4Columns.html``
* Update section "Content" and "Configuration" in ``speciality/Resources/Private/Templates/Page/4Columns.html``

You have a new layout to be used in BE / FE! You don't believe me, do you?

For further reading, I recommend the `excellent work / documentation`_ from Claus Due which framework is used in the Bootstrap package.
@NamelessCoder let me know if you would like to add something more here. Sponsor? Resource?

.. _excellent work / documentation: http://fedext.net/features.html

Make your own introduction package
==================================

Building your own introduction package is much easier than it looks. Actually the ``EXT:introduction`` (which provided the boilerplate code) was designed to manage multiple packages.
You will need to fork the Introduction extension from https://github.com/Ecodev/introduction.git which was extracted from the `TYPO3 Git repository`_. (Don't know why there isn't a standalone repository for this extension?)

So here are the steps:

* Fork https://github.com/Ecodev/introduction.git
* Duplicate directory with your own name ``EXT:introduction/Resources/Private/Subpackages/Introduction``.
* Go through the files and replace what makes sense.

.. _TYPO3 Git repository: http://git.typo3.org/TYPO3v4/Distributions/Introduction.git/tree/master:/typo3conf/ext

Dump database
---------------

To build a SQL dump of its own website, there is a script within the build directory that may be useful for dumping the database.
Proceed as follow::

	cd build

	# To get the usage
	./dump.php --help

	# Before running the script for real display the command on the console.
	./dump.php --dry-run


Copy files
------------

Copy the files that need to be shipped. For the case of the Bootstrap package.

* cp -r htdocs/{fileadmin,uploads} htdocs/typo3conf/ext/introduction/Resources/Private/Subpackages/Bootstrap/Files


That's it you just have made a new introduction package! Well, there will be more time needed but the principle is fairly simple.

Hint for production
==================================

!!! Important notice, for production usage consider doing the following step:

* Remove the extension ``introduction`` located at ``htdocs/typo3conf/ext/introduction``. The extension has become useless once the website has been installed.
* Suggested security: put the database password into directory ``private`` at the root or somewhere else.
* Update the Index Reference (for php /Users/fudriot/Sites/Ecodev/dummy.fab/htdocs/typo3/cli_dispatch.phpsh lowlevel_refindex -c
* Select the language package in the BE. @todo provide with a link to an already existing tutorial.
* ... there are probably more tips to come here...


Todo
=========

I have at least three todo list for this project, below is the fourth one ;)

* document ``EXT:speciality`` more in depth
* document features tests - how to use them


Override configuration for development
---------------------------------------

@todo check if this still true!

While developing the website in a development context, it might be interesting to override some default values such as the domain name for instance.
It can be performed by adding configuration in directory ``EXT:speciality/Configuration/Development``.

There are two TypoScript files that are going to be automatically included and override the default configuration:

* setup.txt
* constants.txt

File ``EXT:speciality/Configuration/Development/DefaultConfiguration.php`` will also be included. Make sure you don't load changes after that if you want the settings to be applied.