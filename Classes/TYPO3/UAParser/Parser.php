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
use TYPO3\UAParser\Service\RegularExpressionService;
use UAParser\Result\Client;

/**
 * @author Dominique Feyer <dfeyer@ttree.ch>
 * @Flow\Scope("singleton")
 */
class Parser extends \UAParser\Parser {

	/**
	 * @Flow\Inject
	 * @var RegularExpressionService
	 */
	protected $regularExpressionService;

	/**
	 * @var boolean
	 */
	protected $initialized = FALSE;

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
	public function initialize() {
		if ($this->initialized === TRUE) {
			return;
		}
		$this->regexes = $this->regularExpressionService->load();
	}

	/**
	 * {@inheritdoc}
	 *
	 * @param string $userAgent
	 * @param array $jsParseBits
	 * @return Client
	 */
	public function parse($userAgent, array $jsParseBits = array()) {
		if ($this->initialized === FALSE) {
			$this->initialize();
		}
		return parent::parse($userAgent, $jsParseBits);
	}
}

?>