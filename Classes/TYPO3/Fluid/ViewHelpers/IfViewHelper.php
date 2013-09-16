<?php
namespace TYPO3\Fluid\ViewHelpers;

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
 * This view helper implements an if/else condition.
 * Check \TYPO3\Fluid\Core\Parser\SyntaxTree\ViewHelperNode::convertArgumentValue() to see how boolean arguments are evaluated
 *
 * **Conditions:**
 *
 * As a condition is a boolean value, you can just use a boolean argument.
 * Alternatively, you can write a boolean expression there.
 * Boolean expressions have the following form:
 * XX Comparator YY
 * Comparator is one of: ==, !=, <, <=, >, >= and %
 * The % operator converts the result of the % operation to boolean.
 *
 * XX and YY can be one of:
 * - number
 * - Object Accessor
 * - Array
 * - a ViewHelper
 * Note: Strings at XX/YY are NOT allowed, however, for the time being,
 * a string comparison can be achieved with comparing arrays (see example
 * below).
 * ::
 *
 *   <f:if condition="{rank} > 100">
 *     Will be shown if rank is > 100
 *   </f:if>
 *   <f:if condition="{rank} % 2">
 *     Will be shown if rank % 2 != 0.
 *   </f:if>
 *   <f:if condition="{rank} == {k:bar()}">
 *     Checks if rank is equal to the result of the ViewHelper "k:bar"
 *   </f:if>
 *   <f:if condition="{0: foo.bar} == {0: 'stringToCompare'}">
 *     Will result true if {foo.bar}'s represented value equals 'stringToCompare'.
 *   </f:if>
 *
 * = Examples =
 *
 * <code title="Basic usage">
 * <f:if condition="somecondition">
 *   This is being shown in case the condition matches
 * </f:if>
 * </code>
 * <output>
 * Everything inside the <f:if> tag is being displayed if the condition evaluates to TRUE.
 * </output>
 *
 * <code title="If / then / else">
 * <f:if condition="somecondition">
 *   <f:then>
 *     This is being shown in case the condition matches.
 *   </f:then>
 *   <f:else>
 *     This is being displayed in case the condition evaluates to FALSE.
 *   </f:else>
 * </f:if>
 * </code>
 * <output>
 * Everything inside the "then" tag is displayed if the condition evaluates to TRUE.
 * Otherwise, everything inside the "else"-tag is displayed.
 * </output>
 *
 * <code title="inline notation">
 * {f:if(condition: someCondition, then: 'condition is met', else: 'condition is not met')}
 * </code>
 * <output>
 * The value of the "then" attribute is displayed if the condition evaluates to TRUE.
 * Otherwise, everything the value of the "else"-attribute is displayed.
 * </output>
 *
 * @see \TYPO3\Fluid\Core\Parser\SyntaxTree\ViewHelperNode::convertArgumentValue()
 * @api
 */
class IfViewHelper extends \TYPO3\Base\ViewHelpers\IfViewHelper  {

	
	/**
	 * The compiled ViewHelper adds two new ViewHelper arguments: __thenClosure and __elseClosure.
	 * These contain closures which are be executed to render the then(), respectively else() case.
	 *
	 * @param string $argumentsVariableName
	 * @param string $renderChildrenClosureVariableName
	 * @param string $initializationPhpCode
	 * @param \TYPO3\Base\Core\Parser\SyntaxTree\AbstractNode $syntaxTreeNode
	 * @param \TYPO3\Base\Core\Compiler\TemplateCompiler $templateCompiler
	 * @return string
	 * @Flow\Internal
	 */
	public function compile($argumentsVariableName, $renderChildrenClosureVariableName, &$initializationPhpCode, \TYPO3\Base\Core\Parser\SyntaxTree\AbstractNode $syntaxTreeNode, \TYPO3\Base\Core\Compiler\TemplateCompiler $templateCompiler) {
		foreach ($syntaxTreeNode->getChildNodes() as $childNode) {
			if ($childNode instanceof \TYPO3\Base\Core\Parser\SyntaxTree\ViewHelperNode
				&& $childNode->getViewHelperClassName() === 'TYPO3\Base\ViewHelpers\ThenViewHelper') {

				$childNodesAsClosure = $templateCompiler->wrapChildNodesInClosure($childNode);
				$initializationPhpCode .= sprintf('%s[\'__thenClosure\'] = %s;', $argumentsVariableName, $childNodesAsClosure) . chr(10);
			}
			if ($childNode instanceof \TYPO3\Base\Core\Parser\SyntaxTree\ViewHelperNode
				&& $childNode->getViewHelperClassName() === 'TYPO3\Base\ViewHelpers\ElseViewHelper') {

				$childNodesAsClosure = $templateCompiler->wrapChildNodesInClosure($childNode);
				$initializationPhpCode .= sprintf('%s[\'__elseClosure\'] = %s;', $argumentsVariableName, $childNodesAsClosure) . chr(10);
			}
		}
		return \TYPO3\Base\Core\Compiler\TemplateCompiler::SHOULD_GENERATE_VIEWHELPER_INVOCATION;
	}

	

	
}

?>
