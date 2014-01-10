<?php
namespace TYPO3\UAParser\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3.UAParser".        *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Reflection\ObjectAccess;

/**
 * A UserAgent
 */
class UserAgent {

	/**
	 * @var boolean
	 */
	protected $isMobileDevice;

	/**
	 * @var boolean
	 */
	protected $isMobile;

	/**
	 * @var boolean
	 */
	protected $isSpider;

	/**
	 * @var boolean
	 */
	protected $isTablet;

	/**
	 * @var boolean
	 */
	protected $isComputer;

	/**
	 * @var integer
	 */
	protected $major;

	/**
	 * @var integer
	 */
	protected $minor;

	/**
	 * @var integer
	 */
	protected $build;

	/**
	 * @var integer
	 */
	protected $patch;

	/**
	 * @var string
	 */
	protected $browser;

	/**
	 * @var string
	 */
	protected $family;

	/**
	 * @var string
	 */
	protected $version;

	/**
	 * @var string
	 */
	protected $browserFull;

	/**
	 * @var boolean
	 */
	protected $isUIWebview;

	/**
	 * @var integer
	 */
	protected $osMajor;

	/**
	 * @var integer
	 */
	protected $osMinor;

	/**
	 * @var integer
	 */
	protected $osBuild;

	/**
	 * @var integer
	 */
	protected $osPatch;

	/**
	 * @var string
	 */
	protected $os;

	/**
	 * @var string
	 */
	protected $osVersion;

	/**
	 * @var string
	 */
	protected $osFull;

	/**
	 * @var string
	 */
	protected $full;

	/**
	 * @var string
	 */
	protected $uaOriginal;

	/**
	 * @param $userAgent
	 */
	public function __construct(array $userAgent) {
		foreach ($userAgent as $propertyName => $value) {
			ObjectAccess::setProperty($this, $propertyName, $value);
		}
	}

	/**
	 * @return string
	 */
	public function getBrowser() {
		return $this->browser;
	}

	/**
	 * @return string
	 */
	public function getBrowserFull() {
		return $this->browserFull;
	}

	/**
	 * @return int
	 */
	public function getBuild() {
		return $this->build;
	}

	/**
	 * @return string
	 */
	public function getFamily() {
		return $this->family;
	}

	/**
	 * @return string
	 */
	public function getFull() {
		return $this->full;
	}

	/**
	 * @return boolean
	 */
	public function getIsComputer() {
		return $this->isComputer;
	}

	/**
	 * @return boolean
	 */
	public function getIsMobile() {
		return $this->isMobile;
	}

	/**
	 * @return boolean
	 */
	public function getIsMobileDevice() {
		return $this->isMobileDevice;
	}

	/**
	 * @return boolean
	 */
	public function getIsSpider() {
		return $this->isSpider;
	}

	/**
	 * @return boolean
	 */
	public function getIsTablet() {
		return $this->isTablet;
	}

	/**
	 * @return boolean
	 */
	public function getIsUIWebview() {
		return $this->isUIWebview;
	}

	/**
	 * @return int
	 */
	public function getMajor() {
		return $this->major;
	}

	/**
	 * @return int
	 */
	public function getMinor() {
		return $this->minor;
	}

	/**
	 * @return string
	 */
	public function getOs() {
		return $this->os;
	}

	/**
	 * @return int
	 */
	public function getOsBuild() {
		return $this->osBuild;
	}

	/**
	 * @return string
	 */
	public function getOsFull() {
		return $this->osFull;
	}

	/**
	 * @return int
	 */
	public function getOsMajor() {
		return $this->osMajor;
	}

	/**
	 * @return int
	 */
	public function getOsMinor() {
		return $this->osMinor;
	}

	/**
	 * @return int
	 */
	public function getOsPatch() {
		return $this->osPatch;
	}

	/**
	 * @return string
	 */
	public function getOsVersion() {
		return $this->osVersion;
	}

	/**
	 * @return int
	 */
	public function getPatch() {
		return $this->patch;
	}

	/**
	 * @return string
	 */
	public function getUaOriginal() {
		return $this->uaOriginal;
	}

	/**
	 * @return string
	 */
	public function getVersion() {
		return $this->version;
	}
}