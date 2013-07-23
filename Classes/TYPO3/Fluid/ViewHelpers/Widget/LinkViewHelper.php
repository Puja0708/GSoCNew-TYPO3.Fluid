<?php
namespace TYPO3\Fluid\ViewHelpers\Widget;

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
 * widget.link ViewHelper
 * This ViewHelper can be used inside widget templates in order to render links pointing to widget actions
 *
 * = Examples =
 *
 * <code>
 * <f:widget.link action="widgetAction" arguments="{foo: 'bar'}">some link</f:widget.link>
 * </code>
 * <output>
 *  <a href="--widget[@action]=widgetAction">some link</a>
 *  (depending on routing setup and current widget)
 * </output>
 *
 * @api
 */
class LinkViewHelper extends \TYPO3\Base\ViewHelpers\Widget\LinkViewHelper {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Cryptography\HashService
	 */
	protected $hashService;


}

?>