<?php
namespace TYPO3\Fluid\Core\Widget;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Fluid".                 *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */


use TYPO3\Flow\Object\DependencyInjection\DependencyProxy;

/**
 * @api
 */
abstract class AbstractWidgetViewHelper extends \TYPO3\Base\Core\Widget\AbstractWidgetViewHelper {



	
	/**
	 * Initiate a sub request to $this->controller. Make sure to fill $this->controller
	 * via Dependency Injection.
	 *
	 * @return \TYPO3\Flow\Http\Response the response of this request.
	 * @throws Exception\MissingControllerException
	 * @api
	 */
	protected function initiateSubRequest() {
		if ($this->controller instanceof DependencyProxy) {
			$this->controller->_activateDependency();
		}
		if (!($this->controller instanceof \TYPO3\Fluid\Core\Widget\AbstractWidgetController)) {
			throw new \TYPO3\Fluid\Core\Widget\Exception\MissingControllerException('initiateSubRequest() can not be called if there is no controller inside $this->controller. Make sure to add the @TYPO3\Flow\Annotations\Inject annotation in your widget class.', 1284401632);
		}

		$subRequest = $this->objectManager->get('TYPO3\Flow\Mvc\ActionRequest', $this->controllerContext->getRequest());
		$this->passArgumentsToSubRequest($subRequest);
		$subRequest->setArgument('__widgetContext', $this->widgetContext);
		$subRequest->setControllerObjectName($this->widgetContext->getControllerObjectName());
		$subRequest->setArgumentNamespace('--' . $this->widgetContext->getWidgetIdentifier());

		$subResponse = $this->objectManager->get('TYPO3\Flow\Http\Response');
		$this->controller->processRequest($subRequest, $subResponse);
		return $subResponse;
	}

	

}

?>
