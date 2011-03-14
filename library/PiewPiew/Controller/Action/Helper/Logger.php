<?php
/**
 * $Id: Logger.php 666 2010-10-13 10:49:12Z brendan $
 */
class   PiewPiew_Controller_Action_Helper_Logger
extends Zend_Controller_Action_Helper_Abstract
{
    /**
     *
     * @var Zend_Log
     */
    protected $_logger;

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
     * @return PiewPiew_Controller_Action_Helper_Logger
     */
    public function setLogger(Zend_Log $logger) {
        $this->_logger = $logger;
        return $this;
    }

    public function preDispatch() {
        parent::preDispatch();

        $controller = $this->getActionController();
        $bootstrap  = $this->getBootstrap();

        $controller->logger = $bootstrap->getResource('logger');
    }

    /**
     *
     * @return Zend_Appplication_Bootstrap
     */
    public function getBootstrap() {
        return $this->getFrontController()->getParam('bootstrap');
    }
}