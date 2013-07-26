<?php
namespace TYPO3\Fluid\ViewHelpers\Form;

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
 * This view helper generates a <select> dropdown list for the use with a form.
 *
 * = Basic usage =
 *
 * The most straightforward way is to supply an associative array as the "options" parameter.
 * The array key is used as option key, and the value is used as human-readable name.
 *
 * <code title="Basic usage">
 * <f:form.select name="paymentOptions" options="{payPal: 'PayPal International Services', visa: 'VISA Card'}" />
 * </code>
 *
 * = Pre-select a value =
 *
 * To pre-select a value, set "value" to the option key which should be selected.
 * <code title="Default value">
 * <f:form.select name="paymentOptions" options="{payPal: 'PayPal International Services', visa: 'VISA Card'}" value="visa" />
 * </code>
 * Generates a dropdown box like above, except that "VISA Card" is selected.
 *
 * If the select box is a multi-select box (multiple="true"), then "value" can be an array as well.
 *
 * = Usage on domain objects =
 *
 * If you want to output domain objects, you can just pass them as array into the "options" parameter.
 * To define what domain object value should be used as option key, use the "optionValueField" variable. Same goes for optionLabelField.
 * If neither is given, the Identifier (UUID/uid) and the __toString() method are tried as fallbacks.
 *
 * If the optionValueField variable is set, the getter named after that value is used to retrieve the option key.
 * If the optionLabelField variable is set, the getter named after that value is used to retrieve the option value.
 *
 * If the prependOptionLabel variable is set, an option item is added in first position, bearing an empty string
 * or - if specified - the value of the prependOptionValue variable as value.
 *
 * <code title="Domain objects">
 * <f:form.select name="users" options="{userArray}" optionValueField="id" optionLabelField="firstName" />
 * </code>
 * In the above example, the userArray is an array of "User" domain objects, with no array key specified.
 *
 * So, in the above example, the method $user->getId() is called to retrieve the key, and $user->getFirstName() to retrieve the displayed value of each entry.
 *
 * The "value" property now expects a domain object, and tests for object equivalence.
 *
 * <code title="Prepend option">
 * <f:form.select property="salutation" options="{salutations}" prependOptionLabel="- select one -" />
 * </code>
 * <output>
 * <select name="salutation">
 *   <option value="">- select one -</option>
 *   <option value="Mr">Mr</option>
 *   <option value="Mrs">Mrs</option>
 *   <option value="Ms">Ms</option>
 *   <option value="Dr">Dr</option>
 * </select>
 * (depending on variable "salutations")
 * </output>
 *
 * = Translation of select content =
 *
 * The view helper can be given a "translate" argument with configuration on how to translate option labels.
 * The array can have the following keys:
 * - "by" defines if translation by message id or original label is to be used ("id" or "label")
 * - "using" defines if the option tag's "value" or "label" should be used as translation input, defaults to "value"
 * - "locale" defines the locale identifier to use, optional, defaults to current locale
 * - "source" defines the translation source name, optional, defaults to "Main"
 * - "package" defines the package key of the translation source, optional, defaults to current package
 * - "prefix" defines a prefix to use for the message id – only works in combination with "by id"
 *
 * <code title="Label translation">
 * <f:form.select name="paymentOption" options="{payPal: 'PayPal International Services', visa: 'VISA Card'}" translate="{by: 'id'}" />
 * </code>
 *
 * The above example would use the values "payPal" and "visa" to look up translations for those ids in the current package's "Main" XLIFF file.
 *
 * <code title="Label translation">
 * <f:form.select name="paymentOption" options="{payPal: 'PayPal International Services', visa: 'VISA Card'}" translate="{by: 'id', prefix: 'shop.paymentOptions.'}" />
 * </code>
 *
 * The above example would use the translation ids "shop.paymentOptions.payPal" and "shop.paymentOptions.visa" for translating the labels.
 *
 * @api
 */
class SelectViewHelper extends \TYPO3\Base\ViewHelpers\Form\SelectViewHelper {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\I18n\Translator
	 */
	protected $translator;

	
	/**
	 * Render the option tags.
	 *
	 * @return array an associative array of options, key will be the value of the option tag
	 * @throws \TYPO3\Fluid\Core\ViewHelper\Exception
	 */
	protected function getOptions() {
		if (!is_array($this->arguments['options']) && !($this->arguments['options'] instanceof \Traversable)) {
			return array();
		}
		$options = array();
		foreach ($this->arguments['options'] as $key => $value) {
			if (is_object($value)) {
				if ($this->hasArgument('optionValueField')) {
					$key = \TYPO3\Flow\Reflection\ObjectAccess::getPropertyPath($value, $this->arguments['optionValueField']);
					if (is_object($key)) {
						if (method_exists($key, '__toString')) {
							$key = (string)$key;
						} else {
							throw new \TYPO3\Fluid\Core\ViewHelper\Exception('Identifying value for object of class "' . get_class($value) . '" was an object.' , 1247827428);
						}
					}
				} elseif ($this->persistenceManager->getIdentifierByObject($value) !== NULL) {
					$key = $this->persistenceManager->getIdentifierByObject($value);
				} elseif (method_exists($value, '__toString')) {
					$key = (string)$value;
				} else {
					throw new \TYPO3\Fluid\Core\ViewHelper\Exception('No identifying value for object of class "' . get_class($value) . '" found.' , 1247826696);
				}

				if ($this->hasArgument('optionLabelField')) {
					$value = \TYPO3\Flow\Reflection\ObjectAccess::getPropertyPath($value, $this->arguments['optionLabelField']);
					if (is_object($value)) {
						if (method_exists($value, '__toString')) {
							$value = (string)$value;
						} else {
							throw new \TYPO3\Fluid\Core\ViewHelper\Exception('Label value for object of class "' . get_class($value) . '" was an object without a __toString() method.' , 1247827553);
						}
					}
				} elseif (method_exists($value, '__toString')) {
					$value = (string)$value;
				} elseif ($this->persistenceManager->getIdentifierByObject($value) !== NULL) {
					$value = $this->persistenceManager->getIdentifierByObject($value);
				}
			}
			$options[$key] = $value;
		}
		if ($this->arguments['sortByOptionLabel']) {
			asort($options);
		}
		return $options;
	}


	/**
	 * Get the option value for an object
	 *
	 * @param mixed $valueElement
	 * @return string
	 */
	protected function getOptionValueScalar($valueElement) {
		if (is_object($valueElement)) {
			if ($this->hasArgument('optionValueField')) {
				return \TYPO3\Flow\Reflection\ObjectAccess::getPropertyPath($valueElement, $this->arguments['optionValueField']);
			} elseif ($this->persistenceManager->getIdentifierByObject($valueElement) !== NULL) {
				return $this->persistenceManager->getIdentifierByObject($valueElement);
			} else {
				return (string)$valueElement;
			}
		} else {
			return $valueElement;
		}
	}

	

	/**
	 * Returns a translated version of the given label
	 *
	 * @param string $value option tag value
	 * @param string $label option tag label
	 * @return string
	 * @throws \TYPO3\Fluid\Core\ViewHelper\Exception
	 * @throws \TYPO3\Fluid\Exception
	 */
	protected function getTranslatedLabel($value, $label) {
		$translationConfiguration = $this->arguments['translate'];

		$translateBy = isset($translationConfiguration['by']) ? $translationConfiguration['by'] : 'id';
		$sourceName = isset($translationConfiguration['source']) ? $translationConfiguration['source'] : 'Main';
		$packageKey = isset($translationConfiguration['package']) ? $translationConfiguration['package'] : $this->controllerContext->getRequest()->getControllerPackageKey();
		$prefix = isset($translationConfiguration['prefix']) ? $translationConfiguration['prefix'] : '';

		if (isset($translationConfiguration['locale'])) {
			try {
				$localeObject = new \TYPO3\Flow\I18n\Locale($translationConfiguration['locale']);
			} catch (\TYPO3\Flow\I18n\Exception\InvalidLocaleIdentifierException $e) {
				throw new \TYPO3\Fluid\Core\ViewHelper\Exception('"' . $translationConfiguration['locale'] . '" is not a valid locale identifier.' , 1330013193);
			}
		} else {
			$localeObject = NULL;
		}

		switch ($translateBy) {
			case 'label':
				$label =  isset($translationConfiguration['using']) && $translationConfiguration['using'] === 'value' ? $value : $label;
				return $this->translator->translateByOriginalLabel($label, array(), NULL, $localeObject, $sourceName, $packageKey);
			case 'id':
				$id =  $prefix . (isset($translationConfiguration['using']) && $translationConfiguration['using'] === 'label' ? $label : $value);
				return $this->translator->translateById($id, array(), NULL, $localeObject, $sourceName, $packageKey);
			default:
				throw new \TYPO3\Fluid\Exception('You can only request to translate by "label" or by "id", but asked for "' . $translateBy . '" in your SelectViewHelper tag.', 1340050647);
		}
	}
}

?>
