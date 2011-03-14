<?php
/**
 * Custom form class to use as a base for all forms that want to access the
 * custom elements and decorators from the PiewPiew library.
 *
 * @version $Id$
 * @author  Brendan McMahon (bernos@gmail.com)
 * @category form
 */
class PiewPiew_Form_SubForm extends Zend_Form_SubForm {

  /**
   * Constructor
   *
   * Adds PiewPiew prefix paths to the plugin loader
   *
   * @param mixed $options
   * @return void
   */
  public function  __construct($options = null) {
    $this->addPrefixPath("PiewPiew_Form", "PiewPiew/Form");

    parent::__construct($options);
  }
}