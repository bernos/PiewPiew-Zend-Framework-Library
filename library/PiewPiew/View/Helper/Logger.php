<?php
/**
 * $Id: Logger.php 666 2010-10-13 10:49:12Z brendan $
 *
 * Adds logger support to views.
 */
class   PiewPiew_View_Helper_Logger
extends Zend_View_Helper_Abstract {
    /**
     *
     * @var Zend_Log
     */
    private $_logger;

    /**
     *
     * @return Zend_Log
     */
    public function getLogger() {
        return $this->_logger;
    }

    /**
     *
     * @param Zend_Log $logger
     * @return Undefined_Logger_View_Helper_Logger
     */
    public function setLogger(Zend_Log $logger) {
        $this->_logger = $logger;
        return $this;
    }

    /**
     *
     * @param String $message
     * @param Int $priority
     * @return PiewPiew_View_Helper_Logger
     */
    public function logger($message=null, $priority=null) {
        if (null !== $message) {
            $this->getLogger()->log($message, $priority);
        }
        
        return $this;
    }

    public function __call($name, $arguments) {
        $this->getLogger()->__call($name, $arguments);
    }
}
