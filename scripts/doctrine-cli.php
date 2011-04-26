<?php
/**
 * Doctrine CLI script
 *
 * @author Juozas Kaziukenas (juozas@juokaz.com)
 */

define('APPLICATION_ENV', 'development');
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

// Default doctrine cli options for working with a standard Zend Framework
// director structure
$default_options = array(
  'data_fixtures_path'  => APPLICATION_PATH . "/doctrine/fixtures",
  'models_path'         => APPLICATION_PATH . "/models",
  'migrations_path'     => APPLICATION_PATH . "/doctrine/migrations",
  'sql_path'            => APPLICATION_PATH . "/doctrine/sql",
  'yaml_schema_path'    => APPLICATION_PATH . "/doctrine/schema",
  'generate_models_options' => array(
    'pearStyle'             => true,
    'generateTableClasses'  => true,
    'classPrefix'           => 'Model_',
    'baseClassPrefix'       => 'Base_',
    'baseClassesDirectory'  => null,
    'classPrefixFiles'      => false,
    'generateAccessors'     =>false
  )
);

$application->getBootstrap()->bootstrap('doctrine');

$custom_options = $application->getBootstrap()->getOptions();

$options = $default_options + $custom_options['resources']['doctrine'];

$cli = new Doctrine_Cli($options);

// Load tasks from custom location
$tasks = './Doctrine/Task';
if (file_exists($tasks))
{
	$cli->loadTasks($tasks);
}

$cli->run($_SERVER['argv']);