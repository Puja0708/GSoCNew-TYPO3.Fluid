<?php
namespace TYPO3\Fluid\Core\Parser\Interceptor;

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
 * An interceptor adding the escape viewhelper to the suitable places.
 *
 */
class Escape extends \TYPO3\Base\Core\Parser\Interceptor\Escape {

	/**
	 * Is the interceptor enabled right now?
	 * @var boolean
	 */
	protected $interceptorEnabled = TRUE;

	/**
	 * A stack of ViewHelperNodes which currently disable the interceptor.
	 * Needed to enable the interceptor again.
	 *
	 * @var array<\TYPO3\Fluid\Core\Parser\SyntaxTree\NodeInterface>
	 */
	protected $viewHelperNodesWhichDisableTheInterceptor = array();

	/**
	 * @var \TYPO3\Flow\Object\ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * Inject object manager
	 *
	 * @param \TYPO3\Flow\Object\ObjectManagerInterface $objectManager
	 * @return void
	 */
	public function injectObjectManager(\TYPO3\Flow\Object\ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}

	
}
?>
