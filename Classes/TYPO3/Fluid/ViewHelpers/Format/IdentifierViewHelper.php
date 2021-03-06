<?php
namespace TYPO3\Fluid\ViewHelpers\Format;

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
 * This ViewHelper renders the identifier of a persisted object (if it has an identity).
 * Usually the identifier is the UUID of the object, but it could be an array of the
 * identity properties, too.
 * @see \TYPO3\Flow\Persistence\PersistenceManagerInterface::getIdentifierByObject()
 *
 * Useful for using the identifier outside of the form view helpers
 * (e.g. JavaScript and AJAX).
 *
 * = Examples =
 *
 * <code title="Inline notation">
 * {post.blog -> f:format.identifier()}
 * </code>
 * <output>
 * 97e7e90a-413c-44ef-b2d0-ddfa4387b5ca
 * // depending on {post.blog}
 * </output>
 *
 * <code title="JSON encoding">
 * <f:format.json>{identifier: '{someObject -> f:format.identifier()}'}</f:format.json>
 * </code>
 * <output>
 * {"identifier":"bf37f335-b273-4353-af77-fd8dc65cb66f"}
 * // depending on the UUID of {someObject}
 * </output>
 *
 * @api
 */
class IdentifierViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 */
	protected $persistenceManager;

}
?>
