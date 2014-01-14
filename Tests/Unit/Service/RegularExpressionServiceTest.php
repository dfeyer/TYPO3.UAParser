<?php
namespace TYPO3\UAParser\Tests\Unit\Service;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3.UAParser".        *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */
use TYPO3\UAParser\Service\RegularExpressionService;

/**
 * Class RegularExpressionServiceTest
 * @package TYPO3\UAParser\Tests\Unit\Service
 */
class RegularExpressionServiceTest extends \TYPO3\Flow\Tests\UnitTestCase {

	/**
	 * @test
	 */
	public function updateReturnTrueIfTheProcessingOfTheYamlFileIsSuccessful() {
		$regularExpressionService = new RegularExpressionService(__DIR__ . '/Fixtures/regexes.yaml');
		$mockPhpFrontend = $this->getMockBuilder('TYPO3\Flow\Cache\Frontend\PhpFrontend')
			->disableOriginalConstructor()
			->getMock();
		$this->inject($regularExpressionService, 'cache', $mockPhpFrontend);
		$mockPhpFrontend->expects($this->once())->method('set');

		$this->assertTrue($regularExpressionService->update());
	}

	/**
	 * @test
	 * @expectedException \TYPO3\UAParser\Exception
	 * @expectedExceptionCode 1389359166
	 */
	public function updateThrowAnExceptionIfTheRegexesYamlFileIsNotFound() {
		$regularExpressionService = new RegularExpressionService(__DIR__ . '/Fixtures/notfound-regexes.yaml');

		$regularExpressionService->update();
	}

	/**
	 * @test
	 * @expectedException \TYPO3\UAParser\Exception
	 * @expectedExceptionCode 1389688349
	 */
	public function updateThrowAnExceptionIfTheRegexesYamlFileIsNotValid() {
		$regularExpressionService = new RegularExpressionService(__DIR__ . '/Fixtures/invalid-regexes.yaml');
		$mockPhpFrontend = $this->getMockBuilder('TYPO3\Flow\Cache\Frontend\PhpFrontend')
			->disableOriginalConstructor()
			->getMock();
		$this->inject($regularExpressionService, 'cache', $mockPhpFrontend);

		$regularExpressionService->update();
	}

	/**
	 * @test
	 */
	public function loadCheckIfTheCacheEntryExistAndReturnAnArray() {
		$regularExpressionService = new RegularExpressionService(__DIR__ . '/Fixtures/regexes.yaml');
		$mockPhpFrontend = $this->getMockBuilder('TYPO3\Flow\Cache\Frontend\PhpFrontend')
			->disableOriginalConstructor()
			->getMock();
		$mockPhpFrontend->expects($this->once())->method('has')->with(RegularExpressionService::CACHE_KEY)->will($this->returnValue(TRUE));
		$mockPhpFrontend->expects($this->once())->method('requireOnce')->with(RegularExpressionService::CACHE_KEY)->will($this->returnValue(array()));
		$this->inject($regularExpressionService, 'cache', $mockPhpFrontend);

		$this->assertSame(array(), $regularExpressionService->load());
	}

	/**
	 * @test
	 */
	public function loadAutomaticalyUpdateTheCacheEntryIfNeeded() {
		$regularExpressionService = new RegularExpressionService(__DIR__ . '/Fixtures/regexes.yaml');
		$mockPhpFrontend = $this->getMockBuilder('TYPO3\Flow\Cache\Frontend\PhpFrontend')
			->disableOriginalConstructor()
			->getMock();
		$mockPhpFrontend->expects($this->once())->method('has')->with(RegularExpressionService::CACHE_KEY)->will($this->returnValue(FALSE));
		$mockPhpFrontend->expects($this->once())->method('requireOnce')->with(RegularExpressionService::CACHE_KEY)->will($this->returnValue(array()));
		$this->inject($regularExpressionService, 'cache', $mockPhpFrontend);

		$this->assertSame(array(), $regularExpressionService->load());
	}
}

?>