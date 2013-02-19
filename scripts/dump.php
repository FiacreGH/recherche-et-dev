#!/usr/bin/env php
<?php
/**
 * Script that will generate a dump out of this website.
 */

// @todo decide whether to ship pictures or not. Tendency not! -> truncate table sys_file and sys_file_reference?

$console = new Console();

// Parse argument
$arguments = Console::parseArgs($argv);
Argument::setArguments($arguments);

if (Argument::has('/^h$|^help$/is')) {
	$usage = <<<EOF
Optimize database and then dump into file `introduction.sql` for the need of the bootstrap introduction package.

Usage:
	dump.php [OPTIONS]

Options:
	-d, --dry-run          Output command that are going to be executed but don't run them.
	--move                 Move the dump file into EXT:introduction
	-h, --help             Display this help message.

EOF;
	$console->output($usage);
	die();
}


// Get the configuration for this website
$configuration = require('../htdocs/typo3conf/LocalConfiguration.php');

$alternativeConfigurationFile = '../private/Database.php';
if (file_exists($alternativeConfigurationFile)) {
	require $alternativeConfigurationFile;
	if (!empty($GLOBALS['TYPO3_CONF_VARS']['DB']['database'])) {
		$configuration['DB']['database'] = $GLOBALS['TYPO3_CONF_VARS']['DB']['database'];
	}
	if (!empty($GLOBALS['TYPO3_CONF_VARS']['DB']['host'])) {
		$configuration['DB']['host'] = $GLOBALS['TYPO3_CONF_VARS']['DB']['host'];
	}
	if (!empty($GLOBALS['TYPO3_CONF_VARS']['DB']['password'])) {
		$configuration['DB']['password'] = $GLOBALS['TYPO3_CONF_VARS']['DB']['password'];
	}
	if (!empty($GLOBALS['TYPO3_CONF_VARS']['DB']['username'])) {
		$configuration['DB']['username'] = $GLOBALS['TYPO3_CONF_VARS']['DB']['username'];
	}
}
if (empty($configuration['DB']['database']) || empty($configuration['DB']['username']) || empty($configuration['DB']['password'])) {
	die('No database credentials found. Are there somewhere else than in typo3conf/LocalConfiguration.php?');
}

if (Argument::has('/^d$|^dry-run$/is')) {
	$console::$dryRun = TRUE;
}


$commands[] = 'echo "Cleaning up database..."';
$tables = array(
	'be_sessions',
	'cache_imagesizes',
	'sys_log',
	'sys_lockedrecords',
	'sys_history',
	'sys_registry',
	'sys_file_processedfile',
	'sys_refindex',
	'tx_extensionmanager_domain_model_extension',
);

// Get a list of cache table which should be cleared beforehand and merge them into the $tables variable.
$tablePrefixes = array(
	'cf_',
	'index_',
	'tx_realurl_',
);
foreach ($tablePrefixes as $prefix) {

	$request = sprintf("SELECT GROUP_CONCAT(DISTINCT table_name) FROM information_schema.tables WHERE table_schema = '%s' AND table_name like '%s%%';",
		$configuration['DB']['database'],
		$prefix
	);
	$command = sprintf('mysql -u root -p%s -e "%s"',
		$configuration['DB']['password'],
		$request
	);

	// get the result
	$result = $console->execute($command);
	if (!empty($result[1])) {
		$tables = array_merge($tables, explode(',', $result[1]));
	}
}

foreach ($tables as $table) {
	$commands[] = sprintf('mysql -u root -p%s -e "TRUNCATE table %s;" %s',
		$configuration['DB']['password'],
		$table,
		$configuration['DB']['database']
	);
}

// Remove record with flag delete = 0

$tables = array(
	'tt_content',
	'pages',
);

foreach ($tables as $table) {
	$commands[] = sprintf('mysql -u root -p%s -e "DELETE FROM %s WHERE deleted=1;" %s',
		$configuration['DB']['password'],
		$table,
		$configuration['DB']['database']
	);
}

$commands[] = 'echo "Dumping database..."';
$commands[] = sprintf('mysqldump -u %s -p%s --skip-quote-names --skip-extended-insert -c %s | sed "s/AUTO_INCREMENT=[0-9]* //" > introduction.sql',
	$configuration['DB']['username'],
	$configuration['DB']['password'],
	$configuration['DB']['database']
);

if (Argument::has('/^move$/is')) {
	$commands[] = 'mv introduction.sql ../htdocs/typo3conf/ext/introduction/Resources/Private/Subpackages/Bootstrap/Database/introduction.sql';
}
$console->execute($commands);


/**
 * Array helper
 */
class Argument {

	/**
	 * @var array
	 */
	protected static $arguments = array();

	/**
	 * Tell whether the regexp is found in one the *key* of the given array.
	 *
	 * @param $regex
	 * @param $array
	 * @return bool
	 */
	public static function has($regex) {
		foreach (self::$arguments as $key => $value) {
			$match = preg_match($regex, $key);
			if ($match === 1) {
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * @return array
	 */
	public static function getArguments() {
		return self::$arguments;
	}

	/**
	 * @param array $arguments
	 */
	public static function setArguments($arguments) {
		self::$arguments = $arguments;
	}
}

/**
 * Console helper
 */
class Console {

	/**
	 * @var boolean
	 */
	static public $dryRun = FALSE;

	/**
	 * @var boolean
	 */
	static public $verbose = FALSE;

	/**
	 * PARSE ARGUMENTS
	 *  php test.php plain-arg --foo --bar=baz --funny="spam=eggs" --alsofunny=spam=eggs \
	 * > 'plain arg 2' -abc -k=value "plain arg 3" --s="original" --s='overwrite' --s
	 * $out = array(12) {
	 *   [0]                => string(9) "plain-arg"
	 *   ["foo"]            => bool(true)
	 *   ["bar"]            => string(3) "baz"
	 *   ["funny"]          => string(9) "spam=eggs"
	 *   ["alsofunny"]      => string(9) "spam=eggs"
	 *   [1]                => string(11) "plain arg 2"
	 *   ["a"]              => bool(true)
	 *   ["b"]              => bool(true)
	 *   ["c"]              => bool(true)
	 *   ["k"]              => string(5) "value"
	 *   [2]                => string(11) "plain arg 3"
	 *   ["s"]              => string(9) "overwrite"
	 * }
	 *
	 * @author              Patrick Fisher <patrick@pwfisher.com>
	 * @since               August 21, 2009
	 * @see                 http://www.php.net/manual/en/features.commandline.php
	 *                      #81042 function arguments($argv) by technorati at gmail dot com, 12-Feb-2008
	 *                      #78651 function getArgs($args) by B Crawford, 22-Oct-2007
	 * @usage               $args = Console::parseArgs($_SERVER['argv']);
	 */
	public static function parseArgs($argv) {

		array_shift($argv);
		$out = array();

		foreach ($argv as $arg) {

			// --foo --bar=baz
			if (substr($arg, 0, 2) == '--') {
				$eqPos = strpos($arg, '=');

				// --foo
				if ($eqPos === false) {
					$key = substr($arg, 2);
					$value = isset($out[$key]) ? $out[$key] : true;
					$out[$key] = $value;
				} // --bar=baz
				else {
					$key = substr($arg, 2, $eqPos - 2);
					$value = substr($arg, $eqPos + 1);
					$out[$key] = $value;
				}
			} // -k=value -abc
			else if (substr($arg, 0, 1) == '-') {

				// -k=value
				if (substr($arg, 2, 1) == '=') {
					$key = substr($arg, 1, 1);
					$value = substr($arg, 3);
					$out[$key] = $value;
				} // -abc
				else {
					$chars = str_split(substr($arg, 1));
					foreach ($chars as $char) {
						$key = $char;
						$value = isset($out[$key]) ? $out[$key] : true;
						$out[$key] = $value;
					}
				}
			} // plain-arg
			else {
				$value = $arg;
				$out[] = $value;
			}
		}
		return $out;
	}

	/**
	 * Execute shell commands
	 *
	 * @param mixed $commands
	 * @return array
	 */
	static public function execute($commands) {

		$result = array();
		// dryRun will output the message
		if (is_string($commands)) {
			$commands = array($commands);
		}

		foreach ($commands as $command) {
			if (self::$dryRun) {
				self::output($command);
			} elseif (self::$verbose || preg_match('/^echo /is', $command)) {
				system($command, $result);
			} else {
				exec($command, $result);
			}
		}
		return $result;
	}

	/**
	 * Output debug message on the console.
	 *
	 * @return void
	 */
	static public function output($message = '') {
		if (is_array($message) || is_object($message)) {
			print_r($message);
		} elseif (is_bool($message)) {
			var_dump($message);
		} else {
			print $message . chr(10);
		}
	}
}

?>