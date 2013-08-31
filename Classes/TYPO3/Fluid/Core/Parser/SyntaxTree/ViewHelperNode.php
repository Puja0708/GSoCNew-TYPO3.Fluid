<?php
namespace TYPO3\Fluid\Core\Parser\SyntaxTree;

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
use TYPO3\Flow\Object\DependencyInjection\DependencyProxy;

/**
 * Node which will call a ViewHelper associated with this node.
 */
class ViewHelperNode extends \TYPO3\Base\Core\Parser\SyntaxTree\ViewHelperNode {

	
	/**
	 * INTERNAL - only needed for compiling templates
	 *
	 * @return array
	 * @Flow\Internal
	 */
	public function getArguments() {
		return $this->arguments;
	}

	
}

?>
