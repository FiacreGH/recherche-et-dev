<?php

namespace PackageMaker\Command;

use Symfony\Component\Console as Console;

class FileIntroductionUpdateCommand extends AbstractCommand {

	/**
	 * @param string $name The name of the command
	 */
	public function __construct($name = null) {
		parent::__construct($name);

		$this->setDescription('Update some file related to the distribution');
		$this->setHelp('Update some file related to the distribution, e.g INSTALL.txt, README.txt');
		$this->addOption('dry-run', 'd', Console\Input\InputOption::VALUE_NONE, 'Output command that are going to be executed but don\'t run them.');
	}

	/**
	 * @param Console\Input\InputInterface $input
	 * @param Console\Output\OutputInterface $output
	 * @return int|null|void
	 */
	protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output) {

		$sourcePath = realpath(__DIR__ . '/../../../../../htdocs/fileadmin');
		$targetPath = realpath(__DIR__ . '/../../../../../htdocs/typo3conf/ext/introduction/Resources/Private/Subpackages/Bootstrap/Files/fileadmin');


		$commands[] = sprintf('rm -rf %s', $targetPath);
		$commands[] = sprintf('cp -r %s %s', $sourcePath, $targetPath);

		$sourcePath = realpath(__DIR__ . '/../../../../../htdocs/uploads');
		$targetPath = realpath(__DIR__ . '/../../../../../htdocs/typo3conf/ext/introduction/Resources/Private/Subpackages/Bootstrap/Files/uploads');

		$commands[] = sprintf('rm -rf %s', $targetPath);
		$commands[] = sprintf('cp -r %s %s', $sourcePath, $targetPath);

		if ($input->getOption('dry-run')) {
			$output->writeln($commands);
		} else {
			$this->work($commands);
		}
	}
}