<?php

namespace PackageMaker\Command;

use Symfony\Component\Console as Console;

abstract class AbstractCommand extends Console\Command\Command {

	/**
	 * Execute shell commands
	 *
	 * @todo use trait when using PHP 5.4
	 *
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

