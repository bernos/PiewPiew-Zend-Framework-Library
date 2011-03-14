<?php

class PiewPiew_View_Helper_FormText extends Zend_View_Helper_FormText
{
    /**
     * Generates a 'text' element.
     *
     * @access public
     *
     * @param string|array $name If a string, the element name.  If an
     * array, all other parameters are ignored, and the array elements
     * are used in place of added parameters.
     *
     * @param mixed $value The element value.
     *
     * @param array $attribs Attributes for the element tag.
     *
     * @return string The element XHTML.
     */
    public function formText($name, $value = null, $attribs = null)
    {
        // Always add the class="text" attribute
        if (null === $attribs) {
          $attribs = array();
        }

        if (array_key_exists('class', $attribs)) {
          $attribs['class'] .= " text";
        } else {
          $attribs['class'] = "text";
        }
        
        return parent::formText($name, $value, $attribs);
    }
}
