<?php

namespace PackageMaker\Command;

use PackageMaker\Util\ExtensionUtility;
use Symfony\Component\Console as Console;

class GitStatusCommand extends Console\Command\Command {

	/**
	 * @var \PackageMaker\Util\ExtensionUtility
	 */
	protected $extensionUtility;

	/**
	 * @param string $name The name of the command
	 */
	public function __construct($name = null) {
		parent::__construct($name);

		$this->extensionUtility = new ExtensionUtility();

		$this->setDescription('Return Git repository status');
		$this->setHelp('Return the Git repository status of extensions.');
		$this->addOption('dry-run', 'd', Console\Input\InputOption::VALUE_NONE, 'Output command that are going to be executed but don\'t run them.');
	}

	/**
	 * @param Console\Input\InputInterface $input
	 * @param Console\Output\OutputInterface $output
	 * @return int|null|void
	 */
	protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output) {

		$extPath = realpath(__DIR__ . '/../../../../../htdocs/typo3conf/ext');

		foreach ($this->extensionUtility->getExtensionsToGitUpdate() as $extension) {

			// Generate command
			$commands[] = sprintf('cd %s/%s; echo "\ncd %s/%s"; git status',
				$extPath,
				$extension,
				$extPath,
				$extension
			);
		}

		if ($input->getOption('dry-run')) {
			$output->writeln($commands);
		} else {
			$result = $this->work($commands);
			$output->writeln($result);
		}
	}

	/**
	 * Execute shell commands
	 *
	 * @todo use trait when using PHP 5.4
	 * @param mixed $commands
	 * @return array
	 */
	protected function work($commands) {

		$result = array();

		if (is_string($commands)) {
			$commands = array($commands);
		}

		foreach ($commands as $command) {

			// echo command won't be outputed otherwise
			if (preg_match('/^echo /is', $command)) {
				system($command);
			} else {
				exec($command, $result);
			}
		}
		return $result;
	}
}

