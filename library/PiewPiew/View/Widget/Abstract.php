<?php
/**
 * Base class for widgets. Widgets extend the basic Zend_View_Helper_Partial
 * by adding scope for business logic, and inflection based view script
 * selection.
 *
 * View templates use widgets in the same way as they would a regular view
 * helper. That is, if you create a custom widget called, say "MyWidget", the
 * view can access it via the $this->myWidget helper method.
 *
 * Widgets must have a public method that matches thier "helper name", in the
 * same way as normal view helpers must. This is the method that will be called
 * when your view template calls $this->myWidget().
 *
 * In a regular view helper we would implement some logic based on the params
 * passed to the helper method and return a string for the view template to
 * render. Widgets extend on this by allowing the return string to be generated
 * by processing another view template, in much the same way as a partial would.
 *
 * View templates must follow a simple naming convention. A widget with the name
 * "MyWidget" will always look for a view template named "my-widget.phtml" in
 * the APPLICATION_PATH/views/scripts/widgets folder.
 *
 * When creating custom widgets, simply pass an array of variables for use by
 * the widget view template to the $this->renderWidget($model) method.
 *
 * @category  Widget
 * @package   PiewPiew_Widget
 * @author    Brendan McMahon (bernos@gmail.com)
 * @version   $Id$
 */
class   PiewPiew_View_Widget_Abstract
extends Zend_View_Helper_Partial {

  /**
   * Set this explicitly to use a custom template name, rather than the derived
   * name based on our naming convention.
   * 
   * @var string
   */
  protected $_template;

  /**
   * Renders the widget view template
   * 
   * @param array $model
   * @return string
   */
  public function renderWidget($model) {
    return $this->partial($this->getTemplate(), $model);
  }

  /**
   * Returns the path to the view template script for the widget
   *
   * @return string
   */
  protected function getTemplate() {
    if (empty($this->_template)) {
      $class        = get_class($this);
      $tokens       = explode('_', $class);
      $string       = lcfirst($tokens[count($tokens) - 1]);
      $pattern      = '/([A-Z])/';
      $replacement  = '-${0}';

      $this->_template = strtolower(preg_replace($pattern, $replacement, $string));
    }

    return 'widgets/' . $this->_template . '.phtml';
  }
}
?>
