<?php
/**
 * Helper to generate a "image" element
 *
 * @version     $Id$
 * @author      Brendan McMahon (bernos@gmail.com)
 * @category    PiewPiew
 * @package     PiewPiew_View
 * @subpackage  Helper
 */
class PiewPiew_View_Helper_FormMultiCheckbox extends Zend_View_Helper_FormMultiCheckbox {
  /**
   * Generates a set of checkbox button elements.
   *
   * @access public
   *
   * @param string|array $name If a string, the element name.  If an
   * array, all other parameters are ignored, and the array elements
   * are extracted in place of added parameters.
   *
   * @param mixed $value The checkbox value to mark as 'checked'.
   *
   * @param array $options An array of key-value pairs where the array
   * key is the checkbox value, and the array value is the radio text.
   *
   * @param array|string $attribs Attributes added to each radio.
   *
   * @return string The radio buttons XHTML.
   */
  public function formMultiCheckbox($name, $value = null, $attribs = null,
    $options = null, $listsep = "<br />\n") {
    // Always add the class="checkbox" attribute
    if (null === $attribs) {
      $attribs = array();
    }

    if (array_key_exists('class', $attribs)) {
      $attribs['class'] .= " checkbox";
    } else {
      $attribs['class'] = "checkbox";
    }

    return parent::formMultiCheckbox($name, $value, $attribs, $options, $listsep);
  }
}
