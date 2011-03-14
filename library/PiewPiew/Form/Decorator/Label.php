<?php

/**
 * Extends the default zend label decorator by adding extra html formatting to
 * the "Required" and "optional" prefix and suffix options.
 *
 * By default both the optional and required prefix and suffix will be rendered
 * in an <em> element. This behaviour can be changed by calling the following
 * methods
 *
 * -  setReqTag()
 * -  setReqPrefixTag()
 * -  setReqSuffixTag()
 * -  setOptTag()
 * -  setOptPrefixTag()
 * -  setOptSuffixTag()
 *
 * @version     $Id$
 * @author      Brendan McMahon (bernos@gmail.com)
 * @category    PiewPiew
 * @package     PiewPiew_Form
 * @subpackage  Decorator
 */
class PiewPiew_Form_Decorator_Label extends Zend_Form_Decorator_Label {

  /**
   * The default tag to use for required prefix and suffix
   *
   * @var string
   */
  protected $_reqTag = 'em';
  
  /**
   * The default tag to use for the optional prefix and suffix
   * 
   * @var string
   */
  protected $_optTag = 'em';

  /**
   * The default tag to use for the required prefix
   *
   * @var string
   */
  protected $_reqPrefixTag;

  /**
   * The default tag to use for the required suffix
   *
   * @var string
   */
  protected $_reqSuffixTag;

  /**
   * The default tag to use for the optional prefix
   *
   * @var string
   */
  protected $_optPrefixTag;

  /**
   * The default tag to use for the optional suffix
   *
   * @var string
   */
  protected $_optSuffixTag;


  /**
   * Constructor
   *
   * Disables escaping of label content by default. We need to do this in order
   * to allow for the label to contain child html elements
   *
   * @param mixed $options
   */
  public function  __construct($options = null) {
    parent::__construct($options);
    $this->setOption('escape', false);
  }

  /**
   * Get the required tag
   *
   * @return string
   */
  public function getReqTag() {
    return $this->_reqTag;
  }

  /**
   * Set the required tag
   *
   * @param string $value
   * @return PiewPiew_Form_Decorator_Label
   */
  public function setReqTag($value) {
    $this->_reqTag = $value;
    return $this;
  }

  /**
   * Get the optional tag
   *
   * @return string
   */
  public function getOptTag() {
    return $this->_optTag;
  }

  /**
   * Set the optional tag
   *
   * @param string $value
   * @return PiewPiew_Form_Decorator_Label
   */
  public function setOptTag($value) {
    $this->_optTag = $value;
    return $this;
  }

  /**
   * Get the required prefix tag.
   *
   * @return string
   */
  public function getReqPrefixTag() {
    return (isset($this->_reqPrefixTag)) ? $this->_reqPrefixTag : $this->getReqTag();
  }

  /**
   * Set the required prefix tag.
   *
   * @param string $value
   * @return PiewPiew_Form_Decorator_Label
   */
  public function setReqPrefixTag($value) {
    $this->_reqPrefixTag = $value;
    return $this;
  }

  /**
   * Get the required suffix tag
   *
   * @return string
   */
  public function getReqSuffixTag() {
    return (isset($this->_reqSuffixTag)) ? $this->_reqSuffixTag : $this->getReqTag();
  }

  /**
   * Set the required suffix tag
   *
   * @param string $value
   * @return PiewPiew_Form_Decorator_Label
   */
  public function setReqSuffixTag($value) {
    $this->_reqSuffixTag = $value;
    return $this;
  }

  /**
   * Get the optional prefix tag
   *
   * @return string
   */
  public function getOptPrefixTag() {
    return (isset($this->_optPrefixTag)) ? $this->_optPrefixTag : $this->getOptTag();
  }

  /**
   * Set the optional prefix tag
   *
   * @param string $value
   * @return PiewPiew_Form_Decorator_Label
   */
  public function setOptPrefixTag($value) {
    $this->_optPrefixTag = $value;
    return $this;
  }

  /**
   * Get the optional suffix tag
   *
   * @return string
   */
  public function getOptSuffixTag() {
    return (isset($this->_optSuffixTag)) ? $this->_optSuffixTag : $this->getOptTag();
  }

  /**
   * Set the optional suffix tag
   *
   * @param string $value
   * @return PiewPiew_Form_Decorator_Label
   */
  public function setOptSuffixTag($value) {
    $this->_optSuffixTag = $value;
    return $this;
  }

  /**
   * Get the required prefix for the label
   *
   * @return string
   */
  public function getReqPrefix() {
    // Fetch the normal string
    $value = parent::getReqPrefix();
    $tag   = $this->getReqPrefixTag();

    // Wrap in html tag decorator
    if (!empty($value)) {
      $value = $this->renderHtmlWrapper($tag, $value, 'required');
    }
    
    return $value;
  }

  /**
   * Get the required suffix for the label
   *
   * @return String
   */
  public function getReqSuffix() {
    // Fetch the normal string
    $value = parent::getReqSuffix();
    $tag   = $this->getReqSuffixTag();

    // Wrap in html tag decorator
    if (!empty($value)) {
      $value = $this->renderHtmlWrapper($tag, $value, 'required');
    }

    return $value;
  }

  /**
   * Get the optional prefix for the label
   *
   * @return string
   */
  public function getOptPrefix() {
    // Fetch the normal string
    $value = parent::getOptPrefix();
    $tag   = $this->getOptPrefixTag();

    // Wrap in html tag decorator
    if (!empty($value)) {
      $value = $this->renderHtmlWrapper($tag, $value, 'required');
    }

    return $value;
  }

  /**
   * Get the optional suffix for the label
   *
   * @return string
   */
  public function getOptSuffix() {
    // Fetch the normal string
    $value = parent::getOptSuffix();
    $tag   = $this->getOptSuffixTag();

    // Wrap in html tag decorator
    if (!empty($value)) {
      $value = $this->renderHtmlWrapper($tag, $value, 'required');
    }

    return $value;
  }

  /**
   * Helper function to render the label content
   *
   * @param string $tag
   * @param string> $value
   * @param string $class
   * @return string
   */
  protected function renderHtmlWrapper($tag, $value, $class) {
    $decorator = new Zend_Form_Decorator_HtmlTag();
    $decorator->setOptions(array('tag' => $tag, 'class' => $class));

    return $decorator->render($value);
  }
}
