<?php
namespace TYPO3\Fluid\Service;

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
 * Common base class for XML generators.
 */
abstract class AbstractGenerator {

	/**
	 * The reflection class for AbstractViewHelper. Is needed quite often, that's why we use a pre-initialized one.
	 *
	 * @var \TYPO3\Flow\Reflection\ClassReflection
	 */
	protected $abstractViewHelperReflectionClass;

	/**
	 * The doc comment parser.
	 *
	 * @var \TYPO3\Flow\Reflection\DocCommentParser
	 * @Flow\Inject
	 */
	protected $docCommentParser;

	/**
	 * @var \TYPO3\Flow\Reflection\ReflectionService
	 * @Flow\Inject
	 */
	protected $reflectionService;

	

}
?>
