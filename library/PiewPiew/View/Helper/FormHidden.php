<?php
/**
 * Helper to generate a "hidden" element
 *
 * @version     $Id$
 * @author      Brendan McMahon (bernos@gmail.com)
 * @category    PiewPiew
 * @package     PiewPiew_View
 * @subpackage  Helper
 */
class PiewPiew_View_Helper_FormHidden extends Zend_View_Helper_FormHidden {
  /**
   * Generates a 'hidden' element.
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
  public function formHidden($name, $value = null, array $attribs = null) {
    // Always add the class="hidden" attribute
    if (null === $attribs) {
      $attribs = array();
    }

    if (array_key_exists('class', $attribs)) {
      $attribs['class'] .= " hidden";
    } else {
      $attribs['class'] = "hidden";
    }

    return parent::formHidden($name, $value, $attribs);
  }
}
