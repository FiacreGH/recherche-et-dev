To automatically install the Package::

	cd scripts/PackageInstaller

	curl http://getcomposer.org/installer | php
	php composer.phar install

	# Generate behat configuration
	php generate-behat-configuration.php --domain=http://bootstrap.build/ --database-password=root --database-user=root --database-name=bootstrapbuild --database-host=127.0.0.1
	bin/behat

	# Run installation
	./bin/behat
