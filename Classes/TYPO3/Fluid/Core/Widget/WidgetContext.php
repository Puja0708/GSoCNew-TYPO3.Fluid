<?php
namespace TYPO3\Fluid\Core\Widget;

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
 * The WidgetContext stores all information a widget needs to know about the
 * environment.
 *
 * The WidgetContext can be fetched from the current request as internal argument __widgetContext,
 * and is thus available throughout the whole sub-request of the widget. It is used internally
 * by various ViewHelpers (like <f:widget.link>, <f:widget.link>, <f:widget.renderChildren>),
 * to get knowledge over the current widget's configuration.
 *
 * It is a purely internal class which should not be used outside of Fluid.
 *
 */
class WidgetContext extends \TYPO3\Base\Core\Widget\WidgetContext{

	

	/**
	 * The child nodes of the Widget ViewHelper.
	 * Only available inside non-AJAX requests.
	 *
	 * @var \TYPO3\Fluid\Core\Parser\SyntaxTree\RootNode
	 * @Flow\Transient
	 */
	protected $viewHelperChildNodes; // TODO: rename to something more meaningful.

	/**
	 * The rendering context of the ViewHelperChildNodes.
	 * Only available inside non-AJAX requests.
	 *
	 * @var \TYPO3\Fluid\Core\Rendering\RenderingContextInterface
	 * @Flow\Transient
	 */
	protected $viewHelperChildNodeRenderingContext;

	
}
?>
