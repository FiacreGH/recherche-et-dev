Speciality Distribution for TYPO3 CMS
=====================================

.. No public website so far. Let see if it can be re-activated.

How to install with TYPO3 CMS 6.2
---------------------------------

**Long term the goal is to have the Speciality Distribution shipped via the TER** following the TYPO3 CMS Distributions model change in 6.2. For now, it is not
possible as EXT:media and EXT:vidi are not yet released on the TER - with the compatibility of CMS 6.2. I am working hard on that!
I still have one important feature to merge in Vidi (a BE listing engine required by Media) before it
can be released as I want to avoid possible breaking changes after TER release. I have the financial support to do it, just need the time!

However, the good news is that the Speciality Distribution can nevertheless be installed via Git and has some Composer flavour as a bonus.
Notice the `system requirement`_ before proceeding and make sure PHP 5.3.7 - 5.4.x and MariaDB / MySQL 5.1.x-5.5.x is installed in your
system::

	# Clone the repository
	git clone git://github.com/Ecodev/bootstrap_package.git speciality.distribution

	# Download TYPO3 CMS Core
	cd speciality.distribution/htdocs

	# Download CMS Core and extensions through Composer.
	# If you don't have Composer on your system, refer to https://getcomposer.org/download/
	composer install

	# There is a bug in the Composer Installer. To fix that, these commands are required:
	rm -rf Packages/Libraries/{ecodev,fab}
	composer install

	# Manual steps
	-> configure a Virtual Host. Convenience example for Apache:

		<VirtualHost *:80>
		    DocumentRoot "/var/vhosts/speciality.distribution/htdocs"
		    ServerName speciality.distribution
		    ServerAlias *.speciality.distribution
		    ErrorLog "/var/vhosts/speciality.distribution/logs/error_log"
		    CustomLog "/var/vhosts/speciality.distribution/logs/access_log" common
		</VirtualHost>

	-> add a DNS entry (e.g editing /etc/hosts file)

	# Run the 1,2,3 wizard installation
	touch typo3conf/ENABLE_INSTALL_TOOL

	# Run the Installation Wizard.
	# !! IMPORTANT: at step 5 of the wizard, do not download list of distributions.
	# The distribution has already been download by Composer.
	open http://speciality.distribution

	# Open the Backend at the end of the Wizard.
	http://speciality.distribution/typo3

	# Install the extension containing the distribution
	-> Open the Extension Manager
	-> Search for extension "speciality_distribution" and install it. (Install EXT:vhs first, if you encounter an exception during installation)
	-> wait and :)


Notice the ``htdocs`` folder located at the root of the direction is not mandatory. It just matches our hosting convention in our company.
If you want to get rid of it, rename the file structure to your convenience when configuring the Virtual Host.

.. _system requirement: http://wiki.typo3.org/TYPO3_6.1#System_Requirements



TODO:

* Check whether to integrate `EXT:fluidcontent_core`_ instead of EXT:css_styled_content.
* Streamline the page template (1column.html, 2column.html could be replaced as done in `EXT:fluidpages_bootstrap`_

.. _this ticket: https://forge.typo3.org/issues/58648
.. _EXT:fluidcontent_core: https://github.com/FluidTYPO3/fluidcontent_core
.. _EXT:fluidpages_bootstrap: https://github.com/FluidTYPO3/fluidpages_bootstrap


Motivation
----------

All started with the modernisation of our Dummy package we were using in our company. To give a bit of background, we were aiming to:

* Have Twitter Bootstrap as HTML / CSS Framework
* Use as much as possible Fluid for the rendering and the templating. Actually, it turned out we have reached the 100% thanks to the work of Claus Due
* Keep folder fileadmin clean from TS / JS / CSS files which should be for storing media only (images, documents etc…)

We wanted not only a package to demonstrate the capability of TYPO3 but also something useful so that it should save us from the tedious and repeating work when kick-starting a website. The result is pretty much promising. More important we **have put everything in public** so that you can test and also take advantage for your own needs.

Support
=======

Bugs and wishes can be reported on the `bug tracker`_. You can also take advantage of some commercial support related to the Bootstrap Package by contacting contact@ecodev.ch.

.. _bug tracker: https://github.com/Ecodev/bootstrap_package/issues

Phing build
===========

`Phing`_: is a build system for PHP and is used to replicate the website between production and development and do some low level tasks.
Also make sure to have a look at the `Frontend Development Workflow`_ which integrates itself with this build system
Some instructions how to get started with this development workflow::

	# Head to the home
	cd bootstrap_package

	# Installation of Composer is not already done
	curl -sS https://getcomposer.org/installer | php

	# Optional: install it globally. You may need to reload your terminal.
	mv composer.phar /usr/local/bin/composer

	# Install dependencies
	# If Composer is installed globally "composer install" is enought
	# This will basically installed Phing locally for this website.
	php composer.phar install

	./bin/phing
	-> read carefully instruction. A file must be generated in `configuration`.

	./bin/phing help

	[echo] ---------------------------------------------
	[echo] Handle cache
	[echo] ---------------------------------------------
	[echo] phing clear_cache     - Flush cached files along with database cache (depth 3)
	[echo] phing warmup          - Call Frontend to generate necessary files
	[echo]
	[echo] phing c               - Clear cache, depth 1: typo3temp/Cache files
	[echo] phing cc              - Clear cache, depth 2: all typo3temp files
	[echo] phing ccc             - Clear cache, depth 3: all typo3temp files + database
	[echo]
	[echo] ---------------------------------------------
	[echo] Import website locally
	[echo] ---------------------------------------------
	[echo] phing show            - Show Phing current configuration
	[echo] phing import-dump     - Fetch the database and build it again locally for TYPO3 6.0
	[echo] phing htaccess        - Fetch the htaccess from the remote server
	[echo] phing symlink         - Create symlinks to the core, current value "/t3core/typo3_src-6.1"
	[echo] phing uploads         - Fetch uploads folder
	[echo] phing fileadmin       - Fetch fileadmin
	[echo] phing user_upload     - Fetch user_upload folder
	[echo]
	[echo] phing d               - import-dump
	[echo] phing initialize6     - import-dump, htaccess, symlink, uploads, fileadmin
	[echo] phing reset           - import-dump, clear_cache, warmup

.. _Frontend Development Workflow:
.. _Phing: http://www.phing.info/

How to continue?
================

As a next step, you likely want to change the CSS, add some custom layouts or customize configuration.
The place to head to is ``EXT:speciality`` which is located at ``htdocs/typo3conf/ext/speciality``. The name "speciality"
is just the extension key we are using in our company as convention. We keep it across our projects so that we don't have to think more
where to find the source code. This is not a big deal to change the name in case. However, the extension is mandatory and contains:

* HTML templates - ``EXT:speciality/Resources/Private/``
* Public resources such as JavaScript and CSS files  - ``EXT:speciality/Resources/Public/``
* PHP Code - ``EXT:speciality/Classes/``

Adding a new layout
-------------------

As a short tutorial, let assume one needs to add a 4 column layout in the website. Proceed as follows:

* Copy ``EXT:speciality/Resources/Private/Templates/Page/3Columns.html`` to ``EXT:speciality/Resources/Private/Templates/Page/4Columns.html``
* Update section "Content" and "Configuration" in ``speciality/Resources/Private/Templates/Page/4Columns.html``

You have a new layout to be used in BE / FE! So quick? You don't believe me, do you?

As further reading, I recommend the `excellent work / documentation`_ from `@NamelessCoder`_ which framework is used in the Bootstrap package, sponsored by `Wildside`_  and its motivation. Also, I recommend having at look `fluidpages_bootstrap`_ which definitely contains more advance examples for page layouts.


.. _excellent work / documentation: http://fedext.net/features.html
.. _@NamelessCoder: https://twitter.com/NamelessCoder
.. _Wildside: http://www.wildside.dk/da/start/
.. _fluidpages_bootstrap: https://github.com/NamelessCoder/fluidpages_bootstrap


Adding a new extension
----------------------

Checkout those instructions:
https://github.com/Ecodev/bootstrap_package/wiki/Adding-Extensions-How-To

Static TypoScript template
--------------------------

Static configuration files are usually managed and stored in the database. To be more precise, they can be added in the BE
from a Template record (AKA ``sys_template``) in tab "Includes".
However, we are using Git for managing our entire website and we want to have this configurable at the source code level.
We are managing our configuration in file `EXT:speciality/Configuration/TypoScript/setup.ts`. Have a look there if you must add additional
configuration.

If you are facing problem, you may consider the Hook approach for managing your Static TypoScript template. More detail in this `blog post`_.

.. _blog post: http://blog.causal.ch/2012/05/automatically-including-static-ts-from.html


Tip for development
-------------------

* TYPO3 has many levels of caches. While it is good for performance, it will become very annoying in development mode. Check out the `uncache extension`_ to work around.
* For new TYPO3 developers which are starting with extension development take advantage of the `extension builder`_.

.. _uncache extension: https://github.com/NamelessCoder/uncache
.. _extension builder: https://forge.typo3.org/projects/show/extension-extension_builder

Behavior-driven development
===========================

The main purpose of `behavior-driven development`_ (abbreviated BDD) is to ensure the feature set is there taking
the point of view of a User (largely speaking). It is also referred as
"Acceptance tests". Acceptance criteria should be written in terms of scenarios and implemented as classes:
Given [initial context], when [event occurs], then [ensure some outcomes].

See it in practice::

	cd tests

	curl http://getcomposer.org/installer | php
	php composer.phar install

	./bin/behat

Feature tests files are to be found into ``tests/features``.

.. _behavior-driven development: http://en.wikipedia.org/wiki/Behavior-driven_development
Making your own introduction package