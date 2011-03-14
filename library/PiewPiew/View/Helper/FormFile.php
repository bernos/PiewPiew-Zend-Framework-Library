<?php
/**
 * Helper to generate a "radio" element
 *
 * @version     $Id$
 * @author      Brendan McMahon (bernos@gmail.com)
 * @category    PiewPiew
 * @package     PiewPiew_View
 * @subpackage  Helper
 */
class PiewPiew_View_Helper_FormFile extends Zend_View_Helper_FormFile {
  /**
   * Generates a 'file' element.
   *
   * @access public
   *
   * @param string|array $name If a string, the element name.  If an
   * array, all other parameters are ignored, and the array elements
   * are extracted in place of added parameters.
   *
   * @param array $attribs Attributes for the element tag.
   *
   * @return string The element XHTML.
   */
  public function formFile($name, $attribs = null) {
    // Always add the class="file" attribute
    if (null === $attribs) {
      $attribs = array();
    }

    if (array_key_exists('class', $attribs)) {
      $attribs['class'] .= " file";
    } else {
      $attribs['class'] = "file";
    }

    return parent::formFile($name, $attribs);
  }
}

