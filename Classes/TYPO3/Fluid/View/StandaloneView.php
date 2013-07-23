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

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Http\Request;


/**
 * A standalone template view.
 * Helpful if you want to use Fluid separately from MVC
 * E.g. to generate template based emails.
 *
 * @api
 */
class StandaloneView extends \TYPO3\Base\View\StandaloneView {

	
	/**
	 * @var \TYPO3\Fluid\Core\Compiler\TemplateCompiler
	 * @Flow\Inject
	 */
	protected $templateCompiler;

	/**
	 * @var \Packages\FluidStandAlone\\Utility\Environment
	 * @Flow\Inject
	 */
	protected $environment;

	/**
	 * @var \Packages\FluidStandAlone\\Mvc\FlashMessageContainer
	 * @Flow\Inject
	 */
	protected $flashMessageContainer;
}
?>