<?php
/**
 * View helper for JWPlayer embed
 *
 * @author Brendan McMahon (bernos@gmail.com)
 */
class PiewPiew_View_Helper_JwPlayer extends Zend_View_Helper_Abstract {

  protected $_element;
  protected $_options;
  protected $_basepath = '/vendor/jwplayer';
  protected $_libIncluded = false;

  public function jwPlayer($element, $options) {
    $this->_element = $element;
    $this->_options = $options;

    if (!$this->_libIncluded) {
      $this->_libIncluded = true;
      $this->view->headScript()->appendFile($this->_basepath.'/jwplayer.js');
    }

    return $this;
  }

  public function  __toString() {
    return $this->toString();
  }

  public function toString() {
    $options = str_replace("\\/", "/", Zend_Json::encode($this->_options));
    $out = '<script type="text/javascript">jwplayer("'.$this->_element.'").setup('.$options.');</script>';

    return $out;
  }
}
