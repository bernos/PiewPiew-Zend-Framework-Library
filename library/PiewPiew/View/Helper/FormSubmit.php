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
class PiewPiew_View_Helper_FormSubmit extends Zend_View_Helper_FormSubmit {
  /**
   * Generates a 'submit' button.
   *
   * @access public
   *
   * @param string|array $name If a string, the element name.  If an
   * array, all other parameters are ignored, and the array elements
   * are extracted in place of added parameters.
   *
   * @param mixed $value The element value.
   *
   * @param array $attribs Attributes for the element tag.
   *
   * @return string The element XHTML.
   */
  public function formSubmit($name, $value = null, $attribs = null) {
    // Always add the class="submit" attribute
    if (null === $attribs) {
      $attribs = array();
    }

    if (array_key_exists('class', $attribs)) {
      $attribs['class'] .= " submit";
    } else {
      $attribs['class'] = "submit";
    }

    return parent::formSubmit($name, $value, $attribs);
  }
}
