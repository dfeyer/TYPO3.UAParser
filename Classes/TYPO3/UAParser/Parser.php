<?php
namespace TYPO3\UAParser;



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
	 */
	public function __construct() {

	}

	/**
	 * Initialize the object
	 */
	public function initialize() {
		if ($this->initialized === TRUE) {
			return;
		}
		$this->regexes = $this->regularExpressionService->load();
		$this->initialized = TRUE;
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