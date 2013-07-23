<?php
namespace TYPO3\Fluid\ViewHelpers\Widget;

/*
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
 * widget.uri ViewHelper
 * This ViewHelper can be used inside widget templates in order to render URIs pointing to widget actions
 *
 * = Examples =
 *
 * <code>
 * {f:widget.uri(action: 'widgetAction')}
 * </code>
 * <output>
 *  --widget[@action]=widgetAction
 *  (depending on routing setup and current widget)
 * </output>
 *
 * @api
 */
class UriViewHelper extends \TYPO3\Base\ViewHelpers\Widget\UriViewHelper {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Cryptography\HashService
	 */
	protected $hashService;

	
}

?>