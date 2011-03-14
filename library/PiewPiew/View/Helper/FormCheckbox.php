<?php
/**
 * Helper to generate a "checkbox" element
 *
 * @version     $Id$
 * @author      Brendan McMahon (bernos@gmail.com)
 * @category    PiewPiew
 * @package     PiewPiew_View
 * @subpackage  Helper
 */
class PiewPiew_View_Helper_FormCheckbox extends Zend_View_Helper_FormCheckbox {
  /**
   * Generates a 'checkbox' element.
   *
   * @access public
   *
   * @param string|array $name If a string, the element name.  If an
   * array, all other parameters are ignored, and the array elements
   * are extracted in place of added parameters.
   * @param mixed $value The element value.
   * @param array $attribs Attributes for the element tag.
   * @return string The element XHTML.
   */
  public function formCheckbox($name, $value = null, $attribs = null, array $checkedOptions = null) {
    // Always add the class="checkbox" attribute
    if (null === $attribs) {
      $attribs = array();
    }

    if (array_key_exists('class', $attribs)) {
      $attribs['class'] .= " checkbox";
    } else {
      $attribs['class'] = "checkbox";
    }

    return parent::formCheckbox($name, $value, $attribs, $checkedOptions);
  }
}
