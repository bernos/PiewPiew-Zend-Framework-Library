<?php

/**
 * Extends the standard Zend_Application_Resource_Modules resource by adding functionality
 * to look for and load module specific configuration files. The ModuleManager will load
 * each of the found module config files and merge them with the main application config
 * data before bootstrapping each of the modules. This means that module bootstraps will
 * have access to their configuration options.
 *
 * @author Brendan McMahon (bernos@gmail.com)
 *
 */
class   PiewPiew_Application_Resource_Moduleconfig
extends Zend_Application_Resource_Modules
{
	/**
	 * Initialise the ModuleManager. We load any module config files before handing control
	 * back to the Zend_Application_Resource_Modules to resume the normal module bootstrapping
	 * process
	 */
	public function init() {
		$this->_loadModuleOptions();
		parent::init();
  }

  /**
   * Locate and load all of the module configuration files. Module configuration files must
   * live in a directory called "configs" relative to the module dir, and be named "module"
   * Both ini and xml formats are supported.
   *
   * @return unknown_type
   */
	protected function _loadModuleOptions() {
		$bootstrap = $this->getBootstrap();

		if (!($bootstrap instanceof Zend_Application_Bootstrap_Bootstrap)) {
			throw new Zend_Application_Exception('Invalid bootstrap class');
		}

		$bootstrap->bootstrap('frontcontroller');
		$front 		= $bootstrap->getResource('frontcontroller');
		$modules 	= $front->getControllerDirectory();

		foreach (array_keys($modules) as $module) {
			$configPath  = $front->getModuleDirectory($module) . DIRECTORY_SEPARATOR . 'configs';

			if (file_exists($configPath)) {
				$cfgdir 		= new DirectoryIterator($configPath);
				$appOptions = $this->getBootstrap()->getOptions();

				foreach ($cfgdir as $file) {
					if ($file->isFile()) {
						$filename = $file->getFilename();
						$options 	= $this->_loadOptions($configPath . DIRECTORY_SEPARATOR . $filename);

						if (($len = strpos($filename, '.')) !== false) {
							$cfgtype = substr($filename, 0, $len);
						} else {
							$cfgtype = $filename;
						}

						if (strtolower($cfgtype) == 'module') {
							if (array_key_exists($module, $appOptions)) {
              	if (is_array($appOptions[$module])) {
                	$appOptions[$module] = array_merge($appOptions[$module], $options);
                } else {
                	$appOptions[$module] = $options;
                }
              } else {
              	$appOptions[$module] = $options;
              }
            } else {
              $appOptions[$module]['resources'][$cfgtype] = $options;
            }
          }
        }

        $this->getBootstrap()->setOptions($appOptions);
      } else {
      	continue;
      }
    }
	}

  /**
   * Load the config file
   *
   * @param string $fullpath
   * @return array
   */
  protected function _loadOptions($fullpath) {
		if (file_exists($fullpath)) {
			switch(substr(trim(strtolower($fullpath)), -3)) {

				case 'ini':
					$cfg = new Zend_Config_Ini($fullpath, $this->getBootstrap()->getEnvironment());
				break;

				case 'xml':
					$cfg = new Zend_Config_Xml($fullpath, $this->getBootstrap()->getEnvironment());
				break;

				default:
					throw new Zend_Config_Exception('Invalid format for config file');
        break;
      }
    } else {
    	throw new Zend_Application_Resource_Exception('File does not exist');
    }

    return $cfg->toArray();
  }
}