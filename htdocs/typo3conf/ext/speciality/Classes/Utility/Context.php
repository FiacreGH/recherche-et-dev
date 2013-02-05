<?php
namespace TYPO3\CMS\Speciality\Utility;
/***************************************************************
*  Copyright notice
*
*  (c) 2013
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * A class dealing with context.
 *
 * @see issue on forge: http://forge.typo3.org/issues/39441
 */
class Context implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * Returns a class instance.
	 *
	 * @return \TYPO3\CMS\Speciality\Utility\Context
	 */
	static public function getInstance() {
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Speciality\Utility\Context');
	}

	/**
	 * Constructor
	 *
	 * @return \TYPO3\CMS\Speciality\Utility\Context
	 */
	public function __construct() {
		$settings = \TYPO3\CMS\Speciality\Utility\Configuration::getInstance()->getSettings();
		$this->name = empty($settings['context']) ? 'Development' : $settings['context'];

		// value in .htaccess has priority
		if (getenv('TYPO3_CONTEXT')) {
			$this->name = getenv('TYPO3_CONTEXT');
		}
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return bool
	 */
	public function isProduction() {
		return $this->name === 'Production';
	}

	/**
	 * @return bool
	 */
	public function isNotProduction() {
		return !$this->isProduction();
	}

	/**
	 * @return bool
	 */
	public function isDevelopment() {
		return $this->name === 'Development';
	}

	/**
	 * @return bool
	 */
	public function isNotDevelopment() {
		return !$this->isDevelopment();
	}

	/**
	 * @return bool
	 */
	public function isTesting() {
		return $this->name === 'Testing';
	}

	/**
	 * @return bool
	 */
	public function isNotTesting() {
		return !$this->isTesting();
	}
}

?>