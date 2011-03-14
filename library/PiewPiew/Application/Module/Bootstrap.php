<?php

/**
 * Base class for module bootstraps
 *
 * Extends on the basic Zend_Application_Module_Bootstrap by adding the ability
 * to set include paths and autoloader namespaces from the module config.
 * Normally this is only done in the main application config, prior to starting
 * up the module subsystem, so there is no way to 'modularise' the setting of
 * library paths and so forth. This is useful for modules that include their
 * own library dependencies, as it allows module authors to include these
 * libraries inside the module's directory structure, making it more
 * transportable.
 *
 * @author brendan
 *
 */
class PiewPiew_Application_Module_Bootstrap extends Zend_Application_Module_Bootstrap {

  /**
   * Set include path
   *
   * @param  array $paths
   * @return Mojo_Application_Module_Bootstrap
   */
  public function setIncludePaths(array $paths) {
    $path = implode(PATH_SEPARATOR, $paths);
    set_include_path($path . PATH_SEPARATOR . get_include_path());
    return $this;
  }

  /**
   * Set autoloader namespaces
   *
   * @param  array $namespaces
   * @return Mojo_Application_Module_Bootstrap
   */
  public function setAutoloaderNamespaces(array $namespaces) {
    $autoloader = $this->getAutoloader();

    foreach ($namespaces as $namespace) {
      $autoloader->registerNamespace($namespace);
    }

    return $this;
  }

  /**
   * Get autoloader instance
   *
   * @return Zend_Loader_Autoloader
   */
  public function getAutoLoader() {
    return Zend_Loader_Autoloader::getInstance();
  }
}
