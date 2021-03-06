<?php
namespace TYPO3\Fluid\Core\Compiler;

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
 * @Flow\Scope("singleton")
 */
class TemplateCompiler extends \TYPO3\Base\Core\Compiler\TemplateCompiler{

	
	/**
	 * @param \TYPO3\Flow\Cache\Frontend\PhpFrontend $templateCache
	 * @return void
	 */
	public function injectTemplateCache(\TYPO3\Flow\Cache\Frontend\PhpFrontend $templateCache) {
		$this->templateCache = $templateCache;
	}

	


}

?>
