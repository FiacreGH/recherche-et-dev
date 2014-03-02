Bootstrap package for TYPO3 CMS
===============================

Check it out the live example running at http://bootstrap.typo3cms.demo.typo3.org/. The package is provided in the demo area of typo3 meaning it is
possible to log in the BE and play around. The demo is reset every three hours as information.
Head to http://bootstrap.typo3cms.demo.typo3.org/typo3 and log-in with "admin" "password" as credentials.

Fedext development branch with TYPO3 6.1
----------------------------------------

This is a temporary section to explain how `Fedext`_ "development" can be used in conjunction with TYPO3 CMS 6.1.
I am assuming that you have acknowledged the branching strategy we have adopted in our FluidTYPO3 project. If not there is a `post`_ where you can catch up.

As you can also read in `this article`_, Fedext is dropping support of TYPO3 CMS 4.x branch and is shifting its code basis towards namespaces, among other.
Although, it is targeting in a first place the upcoming TYPO3 6.2 LTS, it is yet possible to use Fedext with development branches with TYPO3 CMS 6.1.
I felt being a good choice for the Bootstrap Package, since there were some bugs appearing in the "legacy" branches as CMS 6.1
is evolving. Additionally, I wanted to be on the "safe" side for the future and solve the breaking changes ASAP.
This being said, I had to figure out a few things to make it. Though, after a bit of digging it turns out to be fairly simple.

* Update Fedext extensions to development branch. Since we are using for managing our website, this is pretty straightforward.

::

	cd fluidcontent; git co development; git pull;
	cd fluidcontent_bootstrap; git co development; git pull;
	cd fluidpages; git co development; git pull;
	cd flux; git co development; git pull;
	cd vhs; git co master;

* Head to the Install Tool, there are a few fields to be created

* Important!! Use the `dev branch`_ of TYPO3 6.1 as well. This corresponds as of this writing to the upcoming 6.1.8 release which should happen in a close future.
  FYI, there are some changes in the way classes are instantiated (AKA ``makeInstance``) which are required to have Fedext working properly on the Frontend without the BE login.

* Migrate your template. Check out `this documentation`_ and the script at the button. The script took good care of my template and didn't break anything. :)

For now, the current Bootstrap Package, can not be issued as stable, mainly because of the yet to be released TYPO3 6.1.8. Stay tune!

.. _this documentation: https://github.com/FluidTYPO3/documentation/blob/master/Namespaces.md
.. _dev branch: https://git.typo3.org/Packages/TYPO3.CMS.git/shortlog/refs/heads/TYPO3_6-1
.. _post: https://fedext.net/blog/git-branching-strategy.html
.. _Fedext: https://fedext.net/
.. _this article: https://fedext.net/blog/dropping-typo3-4x-support.html


Motivation
----------

All started with the modernisation of our Dummy package we were using in our company. To give a bit of background, we were aiming to:

* Have Twitter Bootstrap as HTML / CSS Framework
* Use as much as possible Fluid for the rendering and the templating. Actually, it turned out we have reached the 100% thanks to the work of Claus Due
* Keep folder fileadmin clean from TS / JS / CSS files which should be for storing media only (images, documents etc…)

We wanted not only a package to demonstrate the capability of TYPO3 but also something useful so that it should save us from the tedious and repeating work when kick-starting a website. The result is pretty much promising. More important we **have put everything in public** so that you can test and also take advantage for your own needs.

Generate

Update Assets Workflow
======================

Find some instructions how you can update the layout of this site based on a workflow
powered by Phing and Grunt::

	# Head to the home
    cd bootstrap_package

    # Installation of Composer is not already don
    curl -sS https://getcomposer.org/installer | pdhp

    # Optional: install it globally. You may reload your terminal.
    mv composer.phar /usr/local/bin/composer

	# Install dependencies
    php composer.phar install (if installed globally "composer install")

	./bin/phing
	-> read carefully instruction.

	# Watch, compile, package your assets
	./bin/phing asset-watch
	./bin/phing asset-package

How to install?
===============

There are two options, either you can get the **stable version** from http://get.typo3.org/bootstrap or you can follow this
little step by step tutorial to get the **master version** - in no time to talk the marketing guy :) Notice the
`system requirement`_ before proceeding and make sure PHP 5.3.7 - 5.4.x and MariaDB / MySQL 5.1.x-5.5.x is installed in your
system::

	# Clone the repository
	git clone --recursive git://github.com/Ecodev/bootstrap_package.git

	# Download TYPO3 CMS Core
	cd bootstrap_package/htdocs
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

.. _system requirement: http://wiki.typo3.org/TYPO3_6.1#System_Requirements

Support
=======

Bugs and wishes can be reported on the `bug tracker`_. You can also take advantage of some commercial support related to the Bootstrap Package by contacting contact@ecodev.ch.

.. _bug tracker: https://github.com/Ecodev/bootstrap_package/issues

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