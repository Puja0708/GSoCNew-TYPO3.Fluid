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
 * A node which handles object access. This means it handles structures like {object.accessor.bla}
 *
 */
class ObjectAccessorNode extends \TYPO3\Base\Core\Parser\SyntaxTree\ObjectAccessorNode {

	
	/**
	 * Internally used for building up cached templates; do not use directly!
	 *
	 * @return string
	 * @Flow\Internal
	 */
	public function getObjectPath() {
		return $this->objectPath;
	}

	
	/**
	 * Gets a property path from a given object or array.
	 *
	 * If propertyPath is "bla.blubb", then we first call getProperty($object, 'bla'),
	 * and on the resulting object we call getProperty(..., 'blubb').
	 *
	 * For arrays the keys are checked likewise.
	 *
	 * @param mixed $subject An object or array
	 * @param string $propertyPath
	 * @param \TYPO3\Fluid\Core\Rendering\RenderingContextInterface $renderingContext
	 * @return mixed Value of the property
	 */
	static public function getPropertyPath($subject, $propertyPath, \TYPO3\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
		$propertyPathSegments = explode('.', $propertyPath);
		foreach ($propertyPathSegments as $pathSegment) {
			try {
				$subject = \TYPO3\Flow\Reflection\ObjectAccess::getProperty($subject, $pathSegment);
			} catch (\TYPO3\Flow\Reflection\Exception\PropertyNotAccessibleException $exception) {
				$subject = NULL;
			}

			if ($subject === NULL) {
				break;
			}

			if ($subject instanceof \TYPO3\Fluid\Core\Parser\SyntaxTree\RenderingContextAwareInterface) {
				$subject->setRenderingContext($renderingContext);
			}
		}
		return $subject;
	}
}
?>
