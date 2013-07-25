<?php
namespace TYPO3\Fluid\ViewHelpers\Form;

/*                                                                        *
 * This script belongs to the Flow package "TYPO3.Fluid".                *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Creates a button.
 *
 * = Examples =
 *
 * <code title="Defaults">
 * <f:form.button>Send Mail</f:form.button>
 * </code>
 * <output>
 * <button type="submit" name="" value="">Send Mail</button>
 * </output>
 *
 * <code title="Disabled cancel button with some HTML5 attributes">
 * <f:form.button type="reset" name="buttonName" value="buttonValue" disabled="disabled" formmethod="post" formnovalidate="formnovalidate">Cancel</f:form.button>
 * </code>
 * <output>
 * <button disabled="disabled" formmethod="post" formnovalidate="formnovalidate" type="reset" name="myForm[buttonName]" value="buttonValue">Cancel</button>
 * </output>
 *
 * @api
 */
class ButtonViewHelper extends \TYPO3\Base\ViewHelpers\Form\ButtonViewHelper {

	
}

?>
