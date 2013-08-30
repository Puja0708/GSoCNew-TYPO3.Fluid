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

/**
 * A node which is used inside boolean arguments
 */
class BooleanNode extends \TYPO3\Base\Core\Parser\SyntaxTree\BooleanNode {


	/**
	 * @return string
	 * @Flow\Internal
	 */
	public function getComparator() {
		return $this->comparator;
	}

	/**
	 * @return \TYPO3\Fluid\Core\Parser\SyntaxTree\AbstractNode
	 * @Flow\Internal
	 */
	public function getSyntaxTreeNode() {
		return $this->syntaxTreeNode;
	}

	/**
	 * @return \TYPO3\Fluid\Core\Parser\SyntaxTree\AbstractNode
	 * @Flow\Internal
	 */
	public function getLeftSide() {
		return $this->leftSide;
	}

	/**
	 * @return \TYPO3\Fluid\Core\Parser\SyntaxTree\AbstractNode
	 * @Flow\Internal
	 */
	public function getRightSide() {
		return $this->rightSide;
	}

}

?>
