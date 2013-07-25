<?php
namespace TYPO3\Fluid\View;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Fluid".                 *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Abstract Fluid Template View.
 *
 * Contains the fundamental methods which any Fluid based template view needs.
 */
abstract class AbstractTemplateView extends \TYPO3\Base\View\AbstractTemplateView implements \TYPO3\Flow\Mvc\View\ViewInterface {



	/**
	 * @var \TYPO3\Flow\Mvc\Controller\ControllerContext
	 */
	protected $controllerContext;

	/**
	 * @var \TYPO3\Flow\Object\ObjectManagerInterface
	 */
	protected $objectManager;

	
	/**
	 * Injects the Object Manager
	 *
	 * @param \TYPO3\Flow\Object\ObjectManagerInterface $objectManager
	 * @return void
	 */
	public function injectObjectManager(\TYPO3\Flow\Object\ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}

	
	/**
	 * Sets the current controller context
	 *
	 * @param \TYPO3\Flow\Mvc\Controller\ControllerContext $controllerContext Controller context which is available inside the view
	 * @return void
	 * @api
	 */
	public function setControllerContext(\TYPO3\Flow\Mvc\Controller\ControllerContext $controllerContext) {
		$this->controllerContext = $controllerContext;
	}

	
	
	/**
	 * Tells if the view implementation can render the view for the given context.
	 *
	 * By default we assume that the view implementation can handle all kinds of
	 * contexts. Override this method if that is not the case.
	 *
	 * @param \TYPO3\Flow\Mvc\Controller\ControllerContext $controllerContext Controller context which is available inside the view
	 * @return boolean TRUE if the view has something useful to display, otherwise FALSE
	 */
	public function canRender(\TYPO3\Flow\Mvc\Controller\ControllerContext $controllerContext) {
		return TRUE;
	}
}

?>
