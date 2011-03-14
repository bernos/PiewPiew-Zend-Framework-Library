<?php

/**
 * Application resource plugin. This application resource initialises the Logger
 * using options set in the application config file, and sets up the view and
 * action controller helpers.
 *
 * @category  Logger
 * @package   PiewPiew_Application
 * @author    Brendan McMahon (bernos@gmail.com)
 * @version   $Id: Logger.php 666 2010-10-13 10:49:12Z brendan $
 */
class   PiewPiew_Application_Resource_Logger
extends Zend_Application_Resource_ResourceAbstract {

  /**
   * @var Zend_Log
   */
  protected $_logger;

  /**
   * Sets up the Logger controller and view helpers.
   *
   * @return Zend_Log
   */
  public function init() {
    $logger = $this->getLogger();

    // Set up view helper
    $this->getBootstrap()->bootstrap("view");
    $this->getBootstrap()->getResource("view")->logger()->setLogger($logger);

    // Set up controller helper
    Zend_Controller_Action_HelperBroker::addHelper(
        new PiewPiew_Controller_Action_Helper_Logger()
    );

    return $logger;
  }

  /**
   *
   * @return Zend_Log
   */
  public function getLogger() {
    if (null === $this->_logger) {
      $options = $this->getOptions();

      $filter = new Zend_Log_Filter_Priority((int) $options['priority']);

      $this->_logger = new Zend_Log();
      $this->_logger->addFilter($filter);

      if (isset($options['enableFirebug']) && $options['enableFirebug']) {
        $this->_logger->addWriter(new Zend_Log_Writer_Firebug());
      }

      if (isset($options['file'])) {
        $this->_logger->addWriter(new Zend_Log_Writer_Stream($options['file']));
      }
    }
    return $this->_logger;
  }
}