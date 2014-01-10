<?php
namespace TYPO3\UAParser;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3.UAParser".        *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use Symfony\Component\Yaml\Yaml;
use TYPO3\Flow\Annotations as Flow;

/**
 * @author Dominique Feyer <dfeyer@ttree.ch>
 * @Flow\Scope("singleton")
 */
class Parser extends \UAParser\Parser {

	private $resourceUri = 'https://raw.github.com/tobie/ua-parser/master/regexes.yaml';

	/**
	 * @var \TYPO3\Flow\Cache\Frontend\PhpFrontend
	 */
	protected $cache;

	/**
	 * Override the default constructor has we use the caching framework to store the Regexp file
	 *
	 * @param mixed $customRegexesFile
	 */
	public function __construct($customRegexesFile = NULL) {

	}

	/**
	 * Initialize the object
	 */
	public function initializeObject() {
		if (!$this->cache->has('regexp')) {
			$this->cache->set('regexp', $this->convertRegexpFile());
		}
		$this->regexes = $this->cache->requireOnce('regexp');
	}

	/**
	 * @return string
	 * @throws Exception
	 */
	protected function convertRegexpFile() {
		$level = error_reporting(0);
		$result = file_get_contents($this->resourceUri);
		error_reporting($level);

		if ($result === false) {
			throw new \TYPO3\UAParser\Exception('Unable to download remote file: ' . $this->resourceUri, 1389359166);
		}

		return 'return ' . var_export(Yaml::parse($result), true) . ';';
	}
}

?>