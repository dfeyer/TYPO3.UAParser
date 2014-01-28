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
class Parser {

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
	 * @var \UAParser\Parser
	 */
	protected $userAgentParser;

	/**
	 * Initialize the object
	 */
	public function initialize() {
		if ($this->initialized === TRUE) {
			return;
		}
		$this->userAgentParser = new \UAParser\Parser($this->regularExpressionService->load());
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
		return $this->userAgentParser->parse($userAgent, $jsParseBits);
	}
}

?>