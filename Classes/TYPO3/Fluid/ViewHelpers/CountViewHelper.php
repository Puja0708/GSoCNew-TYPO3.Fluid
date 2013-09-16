<?php
namespace TYPO3\Fluid\ViewHelpers;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Fluid".                 *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * This ViewHelper counts elements of the specified array or countable object.
 *
 * = Examples =
 *
 * <code title="Count array elements">
 * <f:count subject="{0:1, 1:2, 2:3, 3:4}" />
 * </code>
 * <output>
 * 4
 * </output>
 *
 * <code title="inline notation">
 * {objects -> f:count()}
 * </code>
 * <output>
 * 10 (depending on the number of items in {objects})
 * </output>
 *
 * @api
 */
class CountViewHelper extends \TYPO3\Base\ViewHelpers\CountViewHelper {

/**
	 * Controller Context to use
	 * @var \TYPO3\Flow\Mvc\Controller\ControllerContext
	 * @api
	 */
	protected $controllerContext;

	

	/**
	 * Reflection service
	 * @var \TYPO3\Flow\Reflection\ReflectionService
	 */
	protected $reflectionService;

	/**
	 * @var \TYPO3\Flow\Object\ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * @var \TYPO3\Flow\Log\SystemLoggerInterface
	 */
	protected $systemLogger;

	/**
	 * @param \TYPO3\Flow\Object\ObjectManagerInterface $objectManager
	 * @return void
	 */
	public function injectObjectManager(\TYPO3\Flow\Object\ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}

	/**
	 * @param \TYPO3\Flow\Log\SystemLoggerInterface $systemLogger
	 * @return void
	 */
	public function injectSystemLogger(\TYPO3\Flow\Log\SystemLoggerInterface $systemLogger) {
		$this->systemLogger = $systemLogger;
	}


	/**
	 * Inject a Reflection service
	 * @param \TYPO3\Flow\Reflection\ReflectionService $reflectionService Reflection service
	 */
	public function injectReflectionService(\TYPO3\Flow\Reflection\ReflectionService $reflectionService) {
		$this->reflectionService = $reflectionService;
	}
	
}

?>
