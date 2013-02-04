<?php
namespace TYPO3\CMS\Speciality\Hooks;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 kontakt@gebruederheitz.de
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Handling the inclusion of static templates from extensions by using a hook in
 * $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tstemplate.php']['includeStaticTypoScriptSources']
 *
 * @see http://blog.causal.ch/2012/05/automatically-including-static-ts-from.html
 */
class TypoScriptTemplate implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * Static template of this extension
	 */
	const SELF_DEVELOPMENT_TEMPLATE = 'EXT:speciality/Configuration/Development';

	/**
	 * Path of static templates from extensions
	 *
	 * @var array
	 */
	protected $staticTemplates = array();

	/**
	 * Get an instance of TypoScript Template
	 *
	 * @return \TYPO3\CMS\Speciality\Hooks\TypoScriptTemplate
	 */
	public static function getInstance() {
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Speciality\Hooks\TypoScriptTemplate');
	}

	/**
	 * Includes static template from extensions
	 *
	 * @param array $params
	 * @param t3lib_TStemplate $pObj
	 * @return void
	 */
	public function preprocessIncludeStaticTypoScriptSources(array $params, \TYPO3\CMS\Core\TypoScript\TemplateService $pObj) {
		if (isset($params['row']['root'])) {
			// Add development static templates
			$this->addStaticTemplate(self::SELF_DEVELOPMENT_TEMPLATE);
			$staticTemplatesFromBackend = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $params['row']['include_static_file']);
			$staticTemplates = array_merge($this->getStaticTemplates(), $staticTemplatesFromBackend);
			$params['row']['include_static_file'] = implode(',', array_unique($staticTemplates));
		}
	}

	/**
	 * Adds a static template path
	 *
	 * @param string $staticTemplate
	 * @return void
	 */
	public function addStaticTemplate($staticTemplate) {
		$this->staticTemplates[] = $staticTemplate;
	}

	/**
	 * Adds a static multiple templates path
	 *
	 * @param array $staticTemplates
	 * @return void
	 */
	public function addStaticTemplates(array $staticTemplates) {
		foreach ($staticTemplates as $staticTemplate) {
			$this->staticTemplates[] = $staticTemplate;
		}
	}

	/**
	 * Returns the static template paths
	 *
	 * @return array
	 */
	public function getStaticTemplates() {
		return $this->staticTemplates;
	}
}

?>