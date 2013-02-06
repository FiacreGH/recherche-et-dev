Bootstrap package for TYPO3 CMS
================================

Check it out the live example running at http://bootstrap.ecodev.ch/

This is another introduction package for TYPO3 CMS that may be interesting for the following reasons:

* Twitter Bootstrap as HTML / CSS Framework
* Entirely based on **Fluid** form the templating and rendering.
* Folder ``fileadmin`` is kept for media only (images, documents etc...) and is clean from TS / JS / CSS files.
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
	-> configure a Virtual Host. Convenience example for Apache:

		<VirtualHost *:80>
		    DocumentRoot "/var/vhosts/example.fab/htdocs"
		    ServerName example.fab
		    ServerAlias *.example.fab
		    ErrorLog "/var/vhosts/example.fab/logs/error_log"
		    CustomLog "/var/vhosts/example.fab/logs/access_log" common
		</VirtualHost>

	-> add a DNS entry (e.g editing /etc/hosts file)
	-> open in the browser http://example.com and run the 1,2,3 wizard


Notice the ``htdocs`` folder located at the root of the direction is not mandatory. It just matches our hosting convention in our company.
If you want to get rid of it, rename the file structure to your convenience when configuring the Virtual Host.

--Notice the composer step is not mandatory-- (**not true as of today since ``EXT:speciality`` was not published on the TER**).
The difference is that extensions will be fetched from the TER and managed from the Extension Manager for update which is fine
but not as fancy as the composer approach. Besides the fancy part, the main reasons to use Composer is the capability to handle extension from Git / SVN repositories.


How to continue?
==================

As a next step, you likely want to change the CSS, add some custom layouts or customize configuration.
The place to head to is ``EXT:speciality`` which is located at ``htdocs/typo3conf/ext/speciality``. The name "speciality"
is just the extension key we are using in our company as convention. We keep it across our projects so that we don't have to think more
where to find the source code. This is not a big deal to change the name in case. However, the extension is mandatory and contains:

* HTML templates - ``EXT:speciality/Resources/Private/``
* Public resources such as JavaScript and CSS files  - ``EXT:speciality/Resources/Public/``
* PHP Code - ``EXT:speciality/Classes/``

Adding a new layout
---------------------

As a short tutorial, let assume one needs to add a 4 column layout in the website. Proceed as follows:

* Copy ``EXT:speciality/Resources/Private/Templates/Page/3Columns.html`` to ``EXT:speciality/Resources/Private/Templates/Page/4Columns.html``
* Update section "Content" and "Configuration" in ``speciality/Resources/Private/Templates/Page/4Columns.html``

You have a new layout to be used in BE / FE! So quick? You don't believe me, do you?

As further reading, I recommend the `excellent work / documentation`_ from `@NamelessCoder`_ which framework is used in the Bootstrap package, sponsored by `Wildside`_  and its motivation. Also, I recommend having at look `fluidpages_bootstrap`_ which definitely contains more advance examples for page layouts.


.. _excellent work / documentation: http://fedext.net/features.html
.. _@NamelessCoder: https://twitter.com/NamelessCoder
.. _Wildside: http://www.wildside.dk/da/start/
.. _fluidpages_bootstrap: https://github.com/NamelessCoder/fluidpages_bootstrap


What special features is here?
=====================================

Static TypoScript files API
----------------------------

Static configuration files are usually managed and stored in the database. To be precise they are added from a Template record (AKA ``sys_template``) in tab "Includes".
However, it would be nicer to handle in a programmatic way so they can be versioned in the source code. For that purpose a thin API is available taking advantage of hook in ``\TYPO3\CMS\Core\TypoScript\TemplateService``. In file ``ext_localconf.php``, you will find the following code::

	# A list of static configuration files to be loaded. Order has its importance of course.
	\TYPO3\CMS\Speciality\Hooks\TypoScriptTemplate::getInstance()->addStaticTemplates(array(
		'EXT:css_styled_content/static',
		'EXT:speciality/Configuration/TypoScript',
		'EXT:fluidcontent/Configuration/TypoScript',
		'EXT:fluidcontent_boostrap/Configuration/TypoScript',
	));

It is still possible to load a static configuration file from a Template record as usually. Notice, it will be loaded on the top of the ones added by the API. Thanks Xavier for your inspiring `blog post`_.

.. _blog post: http://blog.causal.ch/2012/05/automatically-including-static-ts-from.html!

Application Context API
------------------------

A thin API has also been introduced for handling Application Context. An Application Context tells whether the applications runs in development, production or whatever.
A default context has been defined as "Development". For now it does nothing particular but can be used in Extension to decide how to behaves according
to the context. A good example is about sending email in a development context. It is likely to send email to a debug recipient while in debug mode.

A Context can be get like::

	if (\TYPO3\CMS\Speciality\Utility\Context::getInstance()->isProduction()) {
		// do something
	}

	# Display the context name
	var_dump(\TYPO3\CMS\Speciality\Utility\Context::getInstance()->getName());

A Context can be be set in the Extension Manager when configuring ``EXT:speciality`` where a value is to be picked among value Development, Production or Testing. Adding a custom context is as easy as adding a value into file ``EXT:speciality/ext_conf_template.txt``. It can also be defined by the mean of an environment variable which will have the priority if existing. For example, one can put in .htaccess::

	SetEnv TYPO3_CONTEXT Production

Hopefully, this feature will be handled by the Core `at one point`_ like TYPO3 Flow `has`_.
One thing that is still missing is a patch adding the support of TypoScript condition for a Context::

	[context = Foo]
	[end]

.. _at one point: http://forge.typo3.org/issues/39441
.. _has: http://docs.typo3.org/flow/TYPO3FlowDocumentation/TheDefinitiveGuide/PartIII/Bootstrapping.html

Override configuration for development
---------------------------------------

While developing on its local machine, it might be interesting to override default values of the live website.
A good example, is the domain name for instance which will be different than the one in production.
It can be performed by adding configuration in directory ``EXT:speciality/Configuration/Development``.

* If present, two TypoScript files will be automatically loaded on the top (and will override the default configuration)

	``EXT:speciality/Configuration/Development/setup.txt``
	``EXT:speciality/Configuration/Development/constants.txt``

* A PHP file can be added ``EXT:speciality/Configuration/Development/DefaultConfiguration.php`` for PHP configuration which will also be automatically loaded. Just make sure, the extension "speciality" is loaded at last to avoid unwanted behaviour.

Tip: check out default PHP configuration from ``EXT:speciality/Configuration/Php/DefaultConfiguration.php``

Tip for development
---------------------

* TYPO3 has many levels of caches. While it is good for performance, it will become very annoying in development mode. Check out the `uncache extension`_ to work around.
* For new TYPO3 developers which are starting with extension development head to the `extension builder`_.

.. _uncache extension: https://github.com/NamelessCoder/uncache
.. _extension builder: https://forge.typo3.org/projects/show/extension-extension_builder

Check list for production
==================================

To go live with your website, consider doing the following step:

* Change icons in the document root (favicon, apple touch icons) and configure robots.txt, humans.txt if needed.
* Remove extension ``introduction`` located at ``htdocs/typo3conf/ext/introduction``. The extension has become useless once the website has been installed.
* If you still plan to use composer, update ``composer.json`` at the root and change the reference "master" to a feature / tag branch. Otherwise ``composer update`` will always check out the master branch which is not desired for production.
* Update the Index Reference (for php /Users/fudriot/Sites/Ecodev/dummy.fab/htdocs/typo3/cli_dispatch.phpsh lowlevel_refindex -c
* Select the language package in the BE. @todo provide with a link to an already existing tutorial.
* Suggested security: put the database password into directory ``private`` at the root or somewhere else.
* ... there are probably more tips to come here...

Feature tests
==================================

@todo add something more here


TODO
======

* Test and add aloha editor for FE editing https://forge.typo3.org/projects/show/extension-aloha
* To add SEO extension. Candidate: https://forge.typo3.org/projects/show/extension-seo


Making your own introduction package
=====================================

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

Copy the files that need to be shipped. For the case of the Bootstrap package:

	cp -r htdocs/{fileadmin,uploads} htdocs/typo3conf/ext/introduction/Resources/Private/Subpackages/Bootstrap/Files

That's it! You just have made a new introduction package! Well, this will require more time but the principle is fairly simple.
