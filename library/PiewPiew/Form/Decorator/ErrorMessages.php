<?php
/**
 * A form level error messages decorator. Borrowed from Phil Browns excellent
 * Tolerable Zend library. http://github.com/philBrown/Tolerable
 *
 * @version     $Id$
 * @author      Brendan McMahon (bernos@gmail.com)
 * @category    PiewPiew
 * @package     PiewPiew_Form
 * @subpackage  Decorator
 */
class PiewPiew_Form_Decorator_ErrorMessages extends Zend_Form_Decorator_Abstract {
  public function render($content) {
    $element = $this->getElement();
    $view    = $element->getView();

    if (null === $view) {
      return $content;
    }

    $errors = $element->getErrorMessages();

    if (empty($errors)) {
      return $content;
    }

    $separator = $this->getSeparator();
    $placement = $this->getPlacement();
    $errors    = $view->formErrors($errors, $this->getOptions());

    switch($placement) {
      case self::APPEND :
        return $content . $separator . $errors;
      case self::PREPEND :
        return $errors . $separator . $content;
    }
  }
}
?>
