<?php
/**
 * Description of AustralianStateSelector
 *
 * @version $Id$
 * @author Brendan McMahon (bernos@gmail.com)
 */
class   PiewPiew_Form_Element_AustralianStateSelector
extends Zend_Form_Element_Select
{
  public function  init() {
    $this->setMultiOptions(array('') + $this->getStateOptions());

    $this->addValidator('InArray', false, array(
        'haystack' => array_keys($this->getStateOptions()),
        'messages' => array(
          Zend_Validate_InArray::NOT_IN_ARRAY => 'Please select a state'
        )
    ));
  }

  protected function getStateOptions() {
    $states = array(
        'NSW' => 'NSW',
        'VIC' => 'VIC',
        'QLD' => 'QLD',
        'TAS' => 'TAS',
        'SA'  => 'SA',
        'WA'  => 'WA',
        'NT'  => 'NT',
        'ACT' => 'ACT'
    );

    asort($states);

    return $states;
  }
}