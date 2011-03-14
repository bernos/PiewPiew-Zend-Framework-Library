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
class PiewPiew_View_Helper_FormImage extends Zend_View_Helper_FormImage {
  /**
   * Generates an 'image' element.
   *
   * @access public
   *
   * @param string|array $name If a string, the element name.  If an
   * array, all other parameters are ignored, and the array elements
   * are extracted in place of added parameters.
   *
   * @param mixed $value The source ('src="..."') for the image.
   *
   * @param array $attribs Attributes for the element tag.
   *
   * @return string The element XHTML.
   */
  public function formImage($name, $value = null, $attribs = null) {
    // Always add the class="image" attribute
    if (null === $attribs) {
      $attribs = array();
    }

    if (array_key_exists('class', $attribs)) {
      $attribs['class'] .= " image";
    } else {
      $attribs['class'] = "image";
    }

    return parent::formImage($name, $value, $attribs);
  }
}
