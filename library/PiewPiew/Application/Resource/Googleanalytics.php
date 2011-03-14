<?php
/**
 * An application resource to streamline bootstrapping of the Google Analytics
 * view helper
 *
 * @author Brendan McMahon (bernos@gmail.com)
 */
class   PiewPiew_Application_Resource_Googleanalytics
extends Zend_Application_Resource_ResourceAbstract
{
  public function init() {
    $this->getBootstrap()->bootstrap("view");

    $options = $this->getOptions();
    $helper  = $this->getBootstrap()->getResource("view")->googleAnalytics();

    $helper->setPropertyId($options['propertyId']);

    if (isset($options['commands'])) {
      foreach($options['commands'] as $name => $value) {
        $helper->addCommand($value);
      }
    }

    return $helper;
  }
}
