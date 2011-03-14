<?php

/**
 * Extends the default Zend_View_Helper_HeadMeta by adding support for the
 * property attribute on <meta> elements
 *
 * @author Brendan McMahon (bernos@gmail.com)
 */
class PiewPiew_View_Helper_HeadMeta extends Zend_View_Helper_HeadMeta {

  /**
   * Types of attributes. Add the 'property' type to support facebook share
   * metadata
   * 
   * @var array
   */
  protected $_typeKeys = array('name', 'http-equiv', 'charset', 'property');

}