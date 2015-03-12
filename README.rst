Speciality Distribution for TYPO3 CMS
=====================================

Motivation
----------

All started with the modernisation of our Dummy package we were using in our company. To give a bit of background, we were aiming to:

* Have Twitter Bootstrap as HTML / CSS Framework
* Use as much as possible Fluid for the rendering and the templating. Actually, it turned out we reached the 100% thanks to the work of Claus Due

We wanted not only a package to demonstrate the capability of TYPO3 but also something useful so that it should save us from the tedious and repeating work when kick-starting a website. The result is pretty much promising. More important we **have put everything in public** so that you can test and also take advantage for your own needs.

.. No public website so far. Let see if it can be re-activated.


Umbrella repository
-------------------

This Git repository is the umbrella repository which basically contains some scaffolding files taken from `HTML5 Boilerplate`_ and the Composer files.
The command `composer install` will fetch the required Packages for you, among other:

* extension `speciality`_ which contains the template and configuration files for the website. Please report and make Pull Request **in this repository**.
* extension `speciality_distribution`_ which hosts the initial SQL dump of the distribution along with some demo images.
This extension is only required once. Before going live, it is advised to complete remove the extension which is not necessary anymore.

.. _speciality: https://github.com/Ecodev/speciality
.. _speciality_distribution :https://github.com/Ecodev/speciality_distribution
.. _HTML5 Boilerplate: https://html5boilerplate.com/

Installation
------------

Use Composer to install the Speciality Distribution. Notice the `system requirement`_ before proceeding and make sure PHP 5.3.7 - 5.4.x
and MariaDB / MySQL 5.1.x-5.5.x is installed on your system::

	# Download the Speciality Distribution via Composer
	composer create-project ecodev/typo3-cms-speciality-distribution htdocs dev-master

	# If you want to keep the Git information
	composer create-project ecodev/typo3-cms-speciality-distribution htdocs --prefer-source --keep-vcs

	# Prepare installation
	cd htdocs
	touch typo3conf/ENABLE_INSTALL_TOOL

	# Manual steps
	-> configure a Virtual Host. Convenience example for Apache:

		<VirtualHost *:80>
		    DocumentRoot "/var/vhosts/SpecialityDistribution"
		    ServerName speciality.distribution
		</VirtualHost>

	-> add a DNS entry (e.g editing /etc/hosts file)

	# Run the Installation Wizard.
	# !! IMPORTANT: at step 5 of the wizard, do not download list of distributions.
	# The extension containing the distribution has already been downloaded by Composer.
	open http://speciality.distribution

	# Open the Backend at the end of the Wizard.
	http://speciality.distribution/typo3

	# Install the extension containing the distribution
	-> Open the Extension Manager
	-> Firstly, deactivate CSS styled content (EXT:css_styled_content)
	-> Search for extension "speciality_distribution" and install it. It can take a while!
	-> At the end of the installation, reload the whole Backend and :)


.. _system requirement: http://wiki.typo3.org/TYPO3_6.2#System_Requirements

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

For more detail, refer to https://github.com/Ecodev/speciality
