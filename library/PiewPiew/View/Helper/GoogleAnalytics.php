<?php
/**
 * View helper for the google analytics asynchronous snippet
 *
 * See http://code.google.com/apis/analytics/docs/tracking/asyncTracking.html
 *
 * To use the helper, first ensure you set the property ID, ideally from you
 * bootstrap or controller, or even better, use the Google analytics application
 * resource to streamline the process.
 *
 * Extra commands can easily be pushed onto the _gaq stack by calling addCommand
 * or addCommands
 *
 * @author Brendan McMahon (bernos@gmail.com)
 */
class PiewPiew_View_Helper_GoogleAnalytics extends Zend_View_Helper_Abstract {

  /**
   * Google property ID to use
   * 
   * @var string 
   */
  protected $_propertyId = 'UA-XXXXX-X';

  /**
   * command stack for the _gaq object
   * 
   * @var array
   */
  protected $_commandStack = array();

  /**
   * View helper entry point
   *
   * @return PiewPiew_View_Helper_GoogleAnalytics
   */
  public function googleAnalytics() {
    return $this;
  }

  /**
   * Get the Google analytics property ID
   * 
   * @return string
   */
  public function getPropertyId() {
    return $this->_propertyId;
  }

  /**
   * Set the Google analytics property ID
   *
   * @param string $value
   * @return PiewPiew_View_Helper_GoogleAnalytics
   */
  public function setPropertyId($value) {
    $this->_propertyId = $value;
    return $this;
  }

  /**
   * Adds a command to the _gaq javascript object
   *
   * @param array $commandArray
   * @return PiewPiew_View_Helper_GoogleAnalytics
   */
  public function addCommand(array $commandArray) {
    $this->_commandStack[] = $commandArray;
    return $this;
  }

  /**
   * Adds multiple commands to the _gaq javascript object
   *
   * @param array $commandsArray
   * @return PiewPiew_View_Helper_GoogleAnalytics
   */
  public function addCommands(array $commandsArray) {
    foreach($commandsArray as $commandArray) {
      $this->addCommand($commandArray);
    }
    return $this;
  }

  /**
   * Implicit string representation
   *
   * @return string
   */
  public function  __toString() {
    return $this->toString();
  }

  /**
   * Explicit string representation
   *
   * @return string
   */
  public function toString() {
    $out  = "<script type=\"text/javascript\">\n";
    $out .= "  var _gaq = _gaq || [];\n";
    $out .= "  _gaq.push(['_setAccount', '{$this->getPropertyId()}']);\n";

    foreach($this->_commandStack as $commandArray) {
      $out .= "  _gaq.push(".str_replace("\\/", "/", Zend_Json::encode($commandArray)).");\n";
    }

    $out .= "  _gaq.push(['_trackPageview']);\n";
    $out .= "  (function() {\n";
    $out .= "    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;\n";
    $out .= "    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';\n";
    $out .= "    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);\n";
    $out .= "  })();\n";
    $out .= "</script>\n";

    return $out;
  }
}
