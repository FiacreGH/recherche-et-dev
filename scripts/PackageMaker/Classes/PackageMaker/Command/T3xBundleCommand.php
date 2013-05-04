<?php

namespace PackageMaker\Command;

use PackageMaker\Util\ExtensionUtility;
use Symfony\Component\Console as Console;

class T3xBundleCommand extends AbstractCommand {

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

		$this->setDescription('Update t3x files');
		$this->setHelp('Update t3x files and copy them into EXT:introduction.');
		$this->addOption('dry-run', 'd', Console\Input\InputOption::VALUE_NONE, 'Output command that are going to be executed but don\'t run them.');
		$this->addOption('package', 'p', Console\Input\InputOption::VALUE_REQUIRED, 'Give the target subpackage name in which t3x files will be put. Possible values "Introduction", "Bootstrap".', 'Bootstrap');
	}

	/**
	 * @param Console\Input\InputInterface $input
	 * @param Console\Output\OutputInterface $output
	 * @return int|null|void
	 */
	protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output) {

		$t3xutilsPath = realpath(__DIR__ . '/../../..');
		$extPath = realpath(__DIR__ . '/../../../../../htdocs/typo3conf/ext');

		$subPackages = array('Bootstrap', 'Introduction');
		$subPackage = $input->getOption('package');

		if (in_array($subPackage, $subPackages)) {

			$target = realpath(__DIR__ . sprintf('/../../../../../htdocs/typo3conf/ext/introduction/Resources/Private/Subpackages/%s/Extensions', $subPackage));

			$commands[] = sprintf('echo "Following extensions hav been generated on %s from their Git repository" > %s/VERSIONS.TXT',
				date('d-m-Y H@i'),
				$target
			);

			foreach ($this->extensionUtility->getExtensions() as $extension) {
				$commands[] = sprintf('echo "Packaging \"%s\"..."', $extension);

				// remove t3x file first avoiding any trouble
				$commands[] = sprintf('rm -f %s/%s.t3x',
					$target,
					$extension
				);

				// Generate a new t3x
				$commands[] = sprintf('php %s/t3xutils.phar create %s %s/%s %s/%s.t3x',
					$t3xutilsPath,
					$extension,
					$extPath,
					$extension,
					$target,
					$extension
				);
			}

			if ($input->getOption('dry-run')) {
				$output->writeln($commands);
			} else {
				$this->work($commands);
			}
		} else {
			$output->writeln(sprintf('No valid option package "%s"', $input->getOption('package')));
		}
	}
}