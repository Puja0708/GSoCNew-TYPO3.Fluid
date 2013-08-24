<?php
namespace TYPO3\Fluid\Service;

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
 * XML Schema (XSD) Generator. Will generate an XML schema which can be used for autocompletion
 * in schema-aware editors like Eclipse XML editor.
 */
class XsdGenerator extends \TYPO3\Base\Service\XsdGenerator {

	/**
	 * @var \TYPO3\Flow\Object\ObjectManagerInterface
	 * @Flow\Inject
	 */
	protected $objectManager;

	

	/**
	 * Generate the XML Schema for a given class name.
	 *
	 * @param string $className Class name to generate the schema for.
	 * @param string $viewHelperNamespace Namespace prefix. Used to split off the first parts of the class name.
	 * @param \SimpleXMLElement $xmlRootNode XML root node where the xsd:element is appended.
	 * @return void
	 */
	protected function generateXmlForClassName($className, $viewHelperNamespace, \SimpleXMLElement $xmlRootNode) {
		$reflectionClass = new \TYPO3\Flow\Reflection\ClassReflection($className);
		if (!$reflectionClass->isSubclassOf($this->abstractViewHelperReflectionClass)) {
			return;
		}

		$tagName = $this->getTagNameForClass($className, $viewHelperNamespace);

		$xsdElement = $xmlRootNode->addChild('xsd:element');
		$xsdElement['name'] = $tagName;
		$this->docCommentParser->parseDocComment($reflectionClass->getDocComment());
		$this->addDocumentation($this->docCommentParser->getDescription(), $xsdElement);

		$xsdComplexType = $xsdElement->addChild('xsd:complexType');
		$xsdComplexType['mixed'] = 'true';
		$xsdSequence = $xsdComplexType->addChild('xsd:sequence');
		$xsdAny = $xsdSequence->addChild('xsd:any');
		$xsdAny['minOccurs'] = '0';
		$xsdAny['maxOccurs'] = 'unbounded';

		$this->addAttributes($className, $xsdComplexType);
	}

	
}
?>
