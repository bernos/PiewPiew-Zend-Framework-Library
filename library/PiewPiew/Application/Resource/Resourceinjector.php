<?php

/**
 * Application resource plugin. This class registers the ResourceInjector action
 * controller helper, as well as allowing its configuration from the standard
 * application config file, via the resources.resourceinjector key.
 *
 * @category  ResourceInjector
 * @package   PiewPiew_Application
 * @author    Brendan McMahon (bernos@gmail.com)
 * @version   $Id: Resourceinjector.php 666 2010-10-13 10:49:12Z brendan $
 */
class   PiewPiew_Application_Resource_Resourceinjector
extends Zend_Application_Resource_ResourceAbstract
{
  public function init() {
    $bootstrap = $this->getBootstrap();
    $options = $this->getOptions();

    Zend_Controller_Action_HelperBroker::addHelper(
      new PiewPiew_Controller_Action_Helper_ResourceInjector($options['defaults'])
    );
  }
}