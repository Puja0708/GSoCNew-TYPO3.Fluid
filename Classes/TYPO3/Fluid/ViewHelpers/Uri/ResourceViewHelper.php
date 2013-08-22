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

use TYPO3\Flow\Annotations as Flow;

/**
 * A view helper for creating URIs to resources.
 *
 * = Examples =
 *
 * <code title="Defaults">
 * <link href="{f:uri.resource(path: 'CSS/Stylesheet.css')}" rel="stylesheet" />
 * </code>
 * <output>
 * <link href="http://yourdomain.tld/_Resources/Static/YourPackage/CSS/Stylesheet.css" rel="stylesheet" />
 * (depending on current package)
 * </output>
 *
 * <code title="Other package resource">
 * {f:uri.resource(path: 'gfx/SomeImage.png', package: 'DifferentPackage')}
 * </code>
 * <output>
 * http://yourdomain.tld/_Resources/Static/DifferentPackage/gfx/SomeImage.png
 * (depending on domain)
 * </output>
 *
 * <code title="Resource URI">
 * {f:uri.resource(path: 'resource://DifferentPackage/Public/gfx/SomeImage.png')}
 * </code>
 * <output>
 * http://yourdomain.tld/_Resources/Static/DifferentPackage/gfx/SomeImage.png
 * (depending on domain)
 * </output>
 *
 * <code title="Resource object">
 * <img src="{f:uri.resource(resource: myImage.resource)}" />
 * </code>
 * <output>
 * <img src="http://yourdomain.tld/_Resources/Persistent/69e73da3ce0ad08c717b7b9f1c759182d6650944.jpg" />
 * (depending on your resource object)
 * </output>
 *
 * @api
 */
class ResourceViewHelper extends \TYPO3\Base\ViewHelpers\Uri\ResourceViewHelper {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Resource\Publishing\ResourcePublisher
	 */
	protected $resourcePublisher;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\I18n\Service
	 */
	protected $i18nService;

	
}

?>
