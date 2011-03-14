$Id: README.txt 666 2010-10-13 10:49:12Z brendan $

PiewPiew Zend framework libraries. Handy, reusable utilities for use with the
zend framework. To use, ensure the following lines are added to your application
configuration at application/configs/application.ini

  ; Register the PiewPiew namespace
autoloaderNamespaces.piewpiew = "PiewPiew_"

  ; Application resource plugin path.
pluginPaths.PiewPiew_Application_Resource = "PiewPiew/Application/Resource"

  ; Action Controller helper setup
resources.frontController.actionHelperPaths.PiewPiew_Controller_Action_Helper = APPLICATION_PATH "/../library/PiewPiew/Controller/Action/Helper"

  ; View helper setup
resources.view.helperPath.PiewPiew_View_Helper = APPLICATION_PATH "/../library/PiewPiew/View/Helper"

--------------------------------------------------------------------------------
Logger
--------------------------------------------------------------------------------
Logging application resource plugin supports logging to file and to Firebug out
of the box.

Action Controllers can access the logger via $this->logger and log messages as
follows. The logger is assigned to controllers in the preDispatch hook by the
Undefined_Logger_Application_Resource_Logger class

$this->logger->err('CONTROLLER ERROR');

From a view script we can log like this:

$this->logger("Hello", Zend_Log::DEBUG);
$this->logger()->err("ERROR FROM VIEW");

Configuration options (add the following to your application.ini)

  ; Initialise the logger application resource
  ; Log levels are:
  ; EMERG   = 0;  // Emergency: system is unusable
  ; ALERT   = 1;  // Alert: action must be taken immediately
  ; CRIT    = 2;  // Critical: critical conditions
  ; ERR     = 3;  // Error: error conditions
  ; WARN    = 4;  // Warning: warning conditions
  ; NOTICE  = 5;  // Notice: normal but significant condition
  ; INFO    = 6;  // Informational: informational messages
  ; DEBUG   = 7;  // Debug: debug messages

resources.logger.priority 	= 7
resources.logger.file  		= APPLICATION_PATH "/../logs/system.log"
resources.logger.enableFirebug 	= true

--------------------------------------------------------------------------------
ResourceInjector
--------------------------------------------------------------------------------
The ResourceInjector allows application resources to be injected directly into
Action Controllers. A set of "default" resources can be made available to all
Action Controllers via the main application configuration, and individual Action
Controllers may also require their own resource dependencies.

Set up "default" resources in the application config file. Default resources
will be available to all Action Controllers in the application. Default resources
are added as follows:

resources.resourceinjector.defaults[] = "db"

Even if you do not wish to initialise any default resources, you should at least
include an empty config for the resource injector, to ensure that it gets
properly bootstrapped. Do it like this:

resources.resourceinjector.defaults[] =

Action controllers can add their own unique resource dependencies by providing
an array of resource names in a public property called $resources. Resource names
must correspond with the name of Application Resources registered with the
application bootstrap.

class IndexController extends Zend_Controller_Action
{
    /**
     * Resource dependencies. ResourceInjector will use the contents of this
     * array to initialise resources during preDispatch
     */
    public $resources = array('db');

    public function indexAction()
    {
        // We can retrieve resources via $this->$resourceName
        // For example, to access the 'db' resource we can say...
        $this->db->query("SELECT * FROM USERS");
    }
}




