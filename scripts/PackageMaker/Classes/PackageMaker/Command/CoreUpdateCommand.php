<?php

namespace PackageMaker\Command;

use Symfony\Component\Console as Console;

class CoreUpdateCommand extends AbstractCommand {

	/**
	 * @param string $name The name of the command
	 */
	public function __construct($name = null) {
		parent::__construct($name);

		$this->setDescription('Update TYPO3 CMS Core to the latest stable version');
		$this->setHelp('Update TYPO3 CMS Core to the latest stable version.');
		$this->addOption('dry-run', 'd', Console\Input\InputOption::VALUE_NONE, 'Output command that are going to be executed but don\'t run them.');
	}

	/**
	 * @param Console\Input\InputInterface $input
	 * @param Console\Output\OutputInterface $output
	 * @return int|null|void
	 */
	protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output) {

		$path = realpath(__DIR__ . '/../../../../../htdocs');
		$commands[] = sprintf('rm -rf %s/typo3_src', $path);
		$commands[] = 'echo "Fetching a new TYPO3 CMS Core..."';
		$commands[] = sprintf('cd %s; wget --quiet http://get.typo3.org/current -O typo3_src.tgz', $path);
		$commands[] = 'echo "Extracting files..."';
		$commands[] = sprintf('cd %s; tar -xzf typo3_src.tgz', $path);
		$commands[] = sprintf('cd %s; rm typo3_src.tgz', $path);
		$commands[] = sprintf('cd %s; mv typo3_src* typo3_src', $path);

		if ($input->getOption('dry-run')) {
			$output->writeln($commands);
		} else {
			$this->work($commands);
		}
	}
}