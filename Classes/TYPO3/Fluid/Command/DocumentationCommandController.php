<?php
namespace TYPO3\Fluid\Command;

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
 * Command controller for Fluid documentation rendering
 *
 * @Flow\Scope("singleton")
 */
class DocumentationCommandController extends \TYPO3\Base\Command\DocumentationCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Fluid\Service\XsdGenerator
	 */
	protected $xsdGenerator;

}

?>
