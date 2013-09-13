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

/**
 * The main template view. Should be used as view if you want Fluid Templating
 *
 * @api
 */
class TemplateView extends \TYPO3\Base\View\TemplateView implements \TYPO3\Flow\Mvc\View\ViewInterface{

	/**
	 * Sets the current controller context
	 *
	 * @param \TYPO3\Flow\Mvc\Controller\ControllerContext $controllerContext Context of the controller associated with this view
	 * @return void
	 * @api
	 */
	public function setControllerContext(\TYPO3\Flow\Mvc\Controller\ControllerContext $controllerContext){
		;
	}



	/**
	 * Checks whether a template can be resolved for the current request context.
	 *
	 * @param \TYPO3\Flow\Mvc\Controller\ControllerContext $controllerContext Controller context which is available inside the view
	 * @return boolean
	 */
	public function canRender(\TYPO3\Flow\Mvc\Controller\ControllerContext $controllerContext) {
		$this->setControllerContext($controllerContext);
		try {
			$this->getTemplateSource();
			return TRUE;
		} catch (\TYPO3\Fluid\View\Exception\InvalidTemplateResourceException $e) {
			return FALSE;
		}
	}

	
	/**
	 * Resolve the template path and filename for the given action. If $actionName
	 * is NULL, looks into the current request.
	 *
	 * @param string $actionName Name of the action. If NULL, will be taken from request.
	 * @return string Full path to template
	 * @throws \TYPO3\Fluid\View\Exception\InvalidTemplateResourceException
	 */
	protected function getTemplateSource($actionName = NULL) {
		$templatePathAndFilename = $this->getTemplatePathAndFilename($actionName);
		$templateSource = \TYPO3\Flow\Utility\Files::getFileContents($templatePathAndFilename, FILE_TEXT);
		if ($templateSource === FALSE) {
			throw new \TYPO3\Fluid\View\Exception\InvalidTemplateResourceException('"' . $templatePathAndFilename . '" is not a valid template resource URI.', 1257246929);
		}
		return $templateSource;
	}

	

	/**
	 * Resolve the path and file name of the layout file, based on
	 * $this->layoutPathAndFilename and $this->layoutPathAndFilenamePattern.
	 *
	 * In case a layout has already been set with setLayoutPathAndFilename(),
	 * this method returns that path, otherwise a path and filename will be
	 * resolved using the layoutPathAndFilenamePattern.
	 *
	 * @param string $layoutName Name of the layout to use. If none given, use "Default"
	 * @return string contents of the layout template
	 * @throws \TYPO3\Fluid\View\Exception\InvalidTemplateResourceException
	 */
	protected function getLayoutSource($layoutName = 'Default') {
		$layoutPathAndFilename = $this->getLayoutPathAndFilename($layoutName);
		$layoutSource = \TYPO3\Flow\Utility\Files::getFileContents($layoutPathAndFilename, FILE_TEXT);
		if ($layoutSource === FALSE) {
			throw new \TYPO3\Fluid\View\Exception\InvalidTemplateResourceException('"' . $layoutPathAndFilename . '" is not a valid template resource URI.', 1257246929);
		}
		return $layoutSource;
	}

	

	/**
	 * Figures out which partial to use.
	 *
	 * @param string $partialName The name of the partial
	 * @return string contents of the partial template
	 * @throws \TYPO3\Fluid\View\Exception\InvalidTemplateResourceException
	 */
	protected function getPartialSource($partialName) {
		$partialPathAndFilename = $this->getPartialPathAndFilename($partialName);
		$partialSource = \TYPO3\Flow\Utility\Files::getFileContents($partialPathAndFilename, FILE_TEXT);
		if ($partialSource === FALSE) {
			throw new \TYPO3\Fluid\View\Exception\InvalidTemplateResourceException('"' . $partialPathAndFilename . '" is not a valid template resource URI.', 1257246929);
		}
		return $partialSource;
	}

	
	/**
	 * Processes "@templateRoot", "@subpackage", "@controller", and "@format" placeholders inside $pattern.
	 * This method is used to generate "fallback chains" for file system locations where a certain Partial can reside.
	 *
	 * If $bubbleControllerAndSubpackage is FALSE and $formatIsOptional is FALSE, then the resulting array will only have one element
	 * with all the above placeholders replaced.
	 *
	 * If you set $bubbleControllerAndSubpackage to TRUE, then you will get an array with potentially many elements:
	 * The first element of the array is like above. The second element has the @ controller part set to "" (the empty string)
	 * The third element now has the @ controller part again stripped off, and has the last subpackage part stripped off as well.
	 * This continues until both "@subpackage" and "@controller" are empty.
	 *
	 * Example for $bubbleControllerAndSubpackage is TRUE, we have the MyCompany\MyPackage\MySubPackage\Controller\MyController
	 * as Controller Object Name and the current format is "html"
	 *
	 * If pattern is "@templateRoot/@subpackage/@controller/@action.@format", then the resulting array is:
	 *  - "Resources/Private/Templates/MySubPackage/My/@action.html"
	 *  - "Resources/Private/Templates/MySubPackage/@action.html"
	 *  - "Resources/Private/Templates/@action.html"
	 *
	 * If you set $formatIsOptional to TRUE, then for any of the above arrays, every element will be duplicated  - once with "@format"
	 * replaced by the current request format, and once with ."@format" stripped off.
	 *
	 * @param string $pattern Pattern to be resolved
	 * @param boolean $bubbleControllerAndSubpackage if TRUE, then we successively split off parts from "@controller" and "@subpackage" until both are empty.
	 * @param boolean $formatIsOptional if TRUE, then half of the resulting strings will have ."@format" stripped off, and the other half will have it.
	 * @return array unix style path
	 */
	protected function expandGenericPathPattern($pattern, $bubbleControllerAndSubpackage, $formatIsOptional) {
		$pattern = str_replace('@templateRoot', $this->getTemplateRootPath(), $pattern);
		$pattern = str_replace('@partialRoot', $this->getPartialRootPath(), $pattern);
		$pattern = str_replace('@layoutRoot', $this->getLayoutRootPath(), $pattern);

		$subpackageKey = $this->controllerContext->getRequest()->getControllerSubpackageKey();
		$controllerName = $this->controllerContext->getRequest()->getControllerName();

		$subpackageParts = ($subpackageKey !== NULL) ? explode(\TYPO3\Fluid\Fluid::NAMESPACE_SEPARATOR, $subpackageKey) : array();

		$results = array();

		$i = ($controllerName === NULL) ? 0 : -1;
		do {
			$temporaryPattern = $pattern;
			if ($i < 0) {
				$temporaryPattern = str_replace('@controller', $controllerName, $temporaryPattern);
			} else {
				$temporaryPattern = str_replace('//', '/', str_replace('@controller', '', $temporaryPattern));
			}
			$temporaryPattern = str_replace('@subpackage', implode('/', ($i < 0 ? $subpackageParts : array_slice($subpackageParts, $i))), $temporaryPattern);

			$results[] = \TYPO3\Flow\Utility\Files::getUnixStylePath(str_replace('@format', $this->controllerContext->getRequest()->getFormat(), $temporaryPattern));
			if ($formatIsOptional) {
				$results[] = \TYPO3\Flow\Utility\Files::getUnixStylePath(str_replace('.@format', '', $temporaryPattern));
			}
		} while ($i++ < count($subpackageParts) && $bubbleControllerAndSubpackage);

		return $results;
	}

	/**
	 * Returns a unique identifier for the given file in the format
	 * <PackageKey>_<SubPackageKey>_<ControllerName>_<prefix>_<SHA1>
	 * The SH1 hash is a checksum that is based on the file path and last modification date
	 *
	 * @param string $pathAndFilename
	 * @param string $prefix
	 * @return string
	 */
	protected function createIdentifierForFile($pathAndFilename, $prefix) {
		$request = $this->controllerContext->getRequest();
		$packageKey = $request->getControllerPackageKey();
		$subPackageKey = $request->getControllerSubpackageKey();
		if ($subPackageKey !== NULL) {
			$packageKey .= '_' . $subPackageKey;
		}
		$controllerName = $request->getControllerName();
		$templateModifiedTimestamp = filemtime($pathAndFilename);
		$templateIdentifier = sprintf('%s_%s_%s_%s', $packageKey, $controllerName, $prefix, sha1($pathAndFilename . '|' . $templateModifiedTimestamp));
		return $templateIdentifier;
	}

	/**
	 * Add a variable to the view data collection.
	 * Can be chained, so $this->view->assign(..., ...)->assign(..., ...); is possible
	 *
	 * @param string $key Key of variable
	 * @param mixed $value Value of object
	 * @return \TYPO3\Flow\Mvc\View\ViewInterface an instance of $this, to enable chaining
	 * @api
	 */
	public function assign($key, $value){
			;
	}

	/**
	 * Add multiple variables to the view data collection
	 *
	 * @param array $values array in the format array(key1 => value1, key2 => value2)
	 * @return \TYPO3\Flow\Mvc\View\ViewInterface an instance of $this, to enable chaining
	 * @api
	 */
	public function assignMultiple(array $values){
		;
	}

	/**
	 * Renders the view
	 *
	 * @return string The rendered view
	 * @api
	 */
	public function render() {
		;
	}



	/**
	 * @var \TYPO3\Flow\Mvc\Controller\ControllerContext
	 */
	protected $controllerContext;

	/**
	 * @var \TYPO3\Flow\Object\ObjectManagerInterface
	 */
	protected $objectManager;

	
	/**
	 * Injects the Object Manager
	 *
	 * @param \TYPO3\Flow\Object\ObjectManagerInterface $objectManager
	 * @return void
	 */
	public function injectObjectManager(\TYPO3\Flow\Object\ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}

}

?>
