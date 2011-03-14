<?php
/**
 * Description of Yearselector
 *
 * @author Brendan McMahon (bernos@gmail.com)
 */
class   PiewPiew_Form_Element_YearSelector
Extends Zend_Form_Element_Select
{
  var $_minYear = 0;
  var $_maxYear = 0;

  public function init() {

  }

  public function setMinYear($value) {
    $this->_minYear = $value;
    $this->setMultiOptions(array('') + $this->_getYearOptions());
    $this->_updateValidator();
    return $this;
  }

  public function getMinYear() {
    return $this->_minYear;
  }

  public function setMaxYear($value) {
    $this->_maxYear = $value;
    $this->setMultiOptions(array('') + $this->_getYearOptions());
    $this->_updateValidator();
    return $this;
  }

  public function getMaxYear() {
    return $this->_maxYear;
  }

  protected function  _getYearOptions() {
    $return = array();

    for($x = $this->_minYear; $x <= $this->_maxYear; $x++) {
      $return[$x] = $x;
    }

    return $return;
  }

  protected function _updateValidator() {
    $this->removeValidator('InArray');
    $this->addValidator('InArray', true, array(
        'haystack' => array_keys($this->_getYearOptions()),
        'messages' => array(
          Zend_Validate_InArray::NOT_IN_ARRAY => 'Please select a year'
        )
    ));
  }
}