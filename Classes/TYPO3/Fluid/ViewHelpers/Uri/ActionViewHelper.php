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
 * A view helper for creating URIs to actions.
 *
 * = Examples =
 *
 * <code title="Defaults">
 * <f:uri.action>some link</f:uri.action>
 * </code>
 * <output>
 * currentpackage/currentcontroller
 * (depending on routing setup and current package/controller/action)
 * </output>
 *
 * <code title="Additional arguments">
 * <f:uri.action action="myAction" controller="MyController" package="YourCompanyName.MyPackage" subpackage="YourCompanyName.MySubpackage" arguments="{key1: 'value1', key2: 'value2'}">some link</f:uri.action>
 * </code>
 * <output>
 * mypackage/mycontroller/mysubpackage/myaction?key1=value1&amp;key2=value2
 * (depending on routing setup)
 * </output>
 *
 * @api
 */
class ActionViewHelper extends \TYPO3\Base\Uri\ActionViewHelper {

	
}

?>