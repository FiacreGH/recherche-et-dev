<?php

namespace PackageMaker\Command;

use PackageMaker\Util\ExtensionUtility;
use Symfony\Component\Console as Console;

class PackageCommand extends AbstractCommand {

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

		$homePath = realpath(__DIR__ . '/../../../../..');

		# Archive ball options
		$balls = array(
			'tarball' => array(
				'copy_option' => '-R',
				'command' => 'tar -czf',
				'extension' => 'tar.gz',
				'file_to_remove' => '',
			),
			'zipball' => array(
				'copy_option' => '-r',
				'command' => 'zip -rq',
				'extension' => 'zip',
				'file_to_remove' => 'typo3_src', // special case for zipball since symlink are not followed
			),
		);
		foreach ($balls as $key => $ball) {

			$commands[] = sprintf('echo "Packaging %s..."', $key);
			$commands[] = sprintf('cd %s; cp %s htdocs bootstrappackage', $homePath, $ball['copy_option']);

			// Restore certain files
			$commands[] = sprintf('cd %s; touch bootstrappackage/typo3conf/FIRST_INSTALL', $homePath);
			$commands[] = sprintf('cd %s; rm -rf bootstrappackage/{uploads,fileadmin,typo3temp,typo3conf/LocalConfiguration.php}/*', $homePath);

			// Save a bit of space by removing files from EXT:introduction
			$commands[] = sprintf('cd %s; rm -rf bootstrappackage/typo3conf/ext/introduction/.git', $homePath);
			$commands[] = sprintf('cd %s; rm -rf bootstrappackage/typo3conf/ext/introduction/Resources/Private/Subpackages/Introduction/', $homePath);

			if (! empty($ball['file_to_remove'])) {
				$commands[] = sprintf('cd %s; rm -rf bootstrappackage/%s', $homePath, $ball['file_to_remove']);
			}

			// Create ball
			$commands[] = sprintf('cd %s; %s bootstrappackage.%s bootstrappackage',
				$homePath,
				$ball['command'],
				$ball['extension']
			);

			// delete bootstrap package directory
			$commands[] = sprintf('cd %s; rm -rf bootstrappackage', $homePath);
		}

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
}