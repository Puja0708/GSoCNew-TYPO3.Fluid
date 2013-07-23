<?php
namespace TYPO3\Fluid\ViewHelpers\Uri;

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
 * A view helper for creating URIs to external targets.
 * Currently the specified URI is simply passed through.
 *
 * = Examples =
 *
 * <code>
 * <f:uri.external uri="http://www.typo3.org" />
 * </code>
 * <output>
 * http://www.typo3.org
 * </output>
 *
 * <code title="custom default scheme">
 * <f:uri.external uri="typo3.org" defaultScheme="ftp" />
 * </code>
 * <output>
 * ftp://typo3.org
 * </output>
 *
 * @api
 */
class ExternalViewHelper extends \TYPO3\Base\ViewHelpers\Uri\ExternalViewHelper {

}

?>