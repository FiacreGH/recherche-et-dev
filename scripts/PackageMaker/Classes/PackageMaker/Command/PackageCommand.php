<?php

namespace PackageMaker\Command;

use PackageMaker\Util\ExtensionUtility;
use Symfony\Component\Console as Console;

class PackageCommand extends Console\Command\Command {

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

		$this->setDescription('Package the Bootstrap Package');
		$this->setHelp('Package the Bootstrap Package as ZIP archive');
		$this->addOption('dry-run', 'd', Console\Input\InputOption::VALUE_NONE, 'Output command that are going to be executed but don\'t run them.');
		$this->addOption('move', 'm', Console\Input\InputOption::VALUE_NONE, 'Move the tar and zip ball instead of letting the file where they where created (current directory).');
	}

	/**
	 * @param Console\Input\InputInterface $input
	 * @param Console\Output\OutputInterface $output
	 * @return int|null|void
	 */
	protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output) {

		$originalPath = realpath(__DIR__ . '/../../../../../htdocs');
		$homePath = realpath(__DIR__ . '/../../../../..');
		$path = str_replace('/htdocs', '/bootstrappackage', $originalPath);

		$commands[] = sprintf('mv %s %s', $originalPath, $path);
		$commands[] = sprintf('cd %s; tar -czf bootstrappackage.tar.gz bootstrappackage', $homePath);
		$commands[] = sprintf('cd %s; zip -r bootstrappackage.zip bootstrappackage', $homePath);
		$commands[] = sprintf('mv %s %s', $path, $originalPath);

		if ($input->getOption('move')) {
			$target = $input->getOption('move');
			$commands[] = sprintf('cd %s; mv bootstrappackage* %s',
				$homePath,
				$target
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

