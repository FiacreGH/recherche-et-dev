<?php

namespace PackageMaker\Command;

use PackageMaker\Util\ExtensionUtility;
use Symfony\Component\Console as Console;

class GitCommand extends Console\Command\Command {

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

		$this->setDescription('Update Git repository');
		$this->setHelp('Update Git repository of extensions.');
		$this->addOption('dry-run', 'd', Console\Input\InputOption::VALUE_NONE, 'Output command that are going to be executed but don\'t run them.');
		$this->addOption('status', 's', Console\Input\InputOption::VALUE_NONE, 'Get status of repository');
		$this->addOption('reset', 'r', Console\Input\InputOption::VALUE_NONE, 'Reset repository');
		$this->addOption('fetch', 'f', Console\Input\InputOption::VALUE_NONE, 'Fetch repository');
		$this->addOption('pull', 'p', Console\Input\InputOption::VALUE_NONE, 'Pull repository');
		$this->addOption('diff', '', Console\Input\InputOption::VALUE_NONE, 'Pull repository');
	}

	/**
	 * @param Console\Input\InputInterface $input
	 * @param Console\Output\OutputInterface $output
	 * @return int|null|void
	 */
	protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output) {

		$extPath = realpath(__DIR__ . '/../../../../../htdocs/typo3conf/ext');

		foreach ($this->extensionUtility->getExtensionsToGitUpdate() as $extension) {

			$action = '';
			$doPrint = FALSE;

			if ($input->getOption('status')) {
				$doPrint = TRUE;
				$action = 'git status';
			}

			if ($input->getOption('reset')) {
				$doPrint = TRUE;
				$action = 'git reset --hard origin/master';
			}

			if ($input->getOption('fetch')) {
				$commands[] = sprintf('echo "Fetching \"%s\"..."', $extension);
				$action = 'git checkout master; git fetch --all;';
			}

			if ($input->getOption('diff')) {
				$doPrint = TRUE;
				$action = "git --no-pager log --color --pretty=format:'%Cred%h%Creset -%C(yellow)%d%Creset %s %Cgreen(%cr) %C(bold blue)<%an>%Creset' --abbrev-commit  master..origin/master";
			}

			if ($input->getOption('pull')) {
				$doPrint = TRUE;
				$commands[] = sprintf('echo "Pulling \"%s\"..."', $extension);
				$action = 'git checkout master; git fetch origin; git merge origin/master';
			}

			// Generate command
			$commands[] = sprintf('cd %s/%s; echo "\ncd %s/%s"; %s',
				$extPath,
				$extension,
				$extPath,
				$extension,
				$action
			);
		}

		if ($input->getOption('dry-run')) {
			$output->writeln($commands);
		} else {
			$result = $this->work($commands);
			if ($doPrint) {
				$output->writeln($result);
			}
		}
	}

	/**
	 * Execute shell commands
	 *
	 * @todo use trait when using PHP 5.4
	 * @param mixed $commands
	 * @return array
	 */
	protected
	function work($commands) {

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

