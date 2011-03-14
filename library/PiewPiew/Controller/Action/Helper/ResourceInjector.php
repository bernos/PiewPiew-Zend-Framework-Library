<?php
/**
 * $Id: ResourceInjector.php 666 2010-10-13 10:49:12Z brendan $
 *
 * Description of ResourceInjector
 *
 * @author brendan
 */
class   PiewPiew_Controller_Action_Helper_ResourceInjector
extends Zend_Controller_Action_Helper_Abstract
{
    /**
     *
     * @var array
     */
    private $_defaults;

    /**
     *
     * @param array $defaults
     */
    public function __construct(array $defaults=array()) {
        $this->_defaults = $defaults;
    }

    /**
     * Pre dispatch hook. Assign all resources to the current Action Controller
     */
    public function preDispatch() {
        parent::preDispatch();

        $bootstrap  = $this->getBootstrap();
        $controller = $this->getActionController();

        // Get default resources
        $resources = $this->_defaults;

        // Merge any further resources required by the action controller
        if (isset($controller->resources) && is_array($controller->resources)) {
            $resources = array_merge($this->_defaults, $controller->resources);
        }

        foreach ($resources as $name) {
            if ($bootstrap->hasResource($name)) {
                $controller->$name = $bootstrap->getResource($name);
            }
        }
    }

    /**
     *
     * @return Zend_Application_Bootstrap_BootstrapAbstract
     */
    public function getBootstrap() {
        return $this->getFrontController()->getParam('bootstrap');
    }
}