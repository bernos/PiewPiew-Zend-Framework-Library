<?php
/**
 * Description of PiewPiew_Model_AbstractModel
 *
 * @version   $Id$
 * @author    Brendan McMahon (bernos@gmail.com)
 * @category  PiewPiew
 * @package   PiewPiew_Model
 */
class PiewPiew_Model_AbstractModel
{
	protected $_mapper;
	protected $_mapperClass = "PiewPiew_Model_Mapper_AbstractMapper";
  protected $_options = array();
  
  /**
   * Subclasses should override this array with the names of all valid 
   * properties that will be automatically handled by the magic __get, __set and
   * __call methods.
   * 
   * @var array
   */
  protected $_allowedOptions = array();

	/**
   * Constructor
   *
	 * @param array $options
	 * @return PiewPiew_Model_AbstractModel
	 */
	public function __construct(array $options = null) {
		if (is_array($options)) {
			$this->setOptions($options);
		}
		return $this;
	}

	public function __set($name, $value) {
		$method = 'set' . $name;

		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid model property '$name'");
		}

		$this->$method($value);
	}

	public function __get($name) {
		$method = 'get' . $name;

		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid model property '$name'");
		}

		return $this->$method();
	}

  public function  __call($name, $arguments) {
    // If it was a getXXX or setXXX method, then store or retrieve the requested
    // property in our $_options array
    $head = substr($name, 0, 3);

    if (count($name > 3)&& ($head == 'get' || $head == 'set')) {
      $property = substr($name, 3);
      $property{0} = strtolower($property{0});
      switch ($head) {
        case 'set' :
          if (('mapper' == $property) || !in_array($property, $this->_allowedOptions)) {
            throw new Exception("Invalid model property '$property'");
          }

          $this->_options[$property] = array_shift($arguments);
          return $this;
        case 'get' :
        default :
          return $this->_options[$property];
      }
    }

    return false;
  }

	/**
	 * @param array $options
	 * @return PiewPiew_Model_AbstractModel
	 */
	public function setOptions(array $options) {
		$methods = get_class_methods($this);

		foreach($options as $name=>$value) {
			$method = 'set'.ucfirst($name);
			if (in_array($method, $methods) || in_array($name, $this->_allowedOptions)) {
				$this->$method($value);
			}
		}

		return $this;
	}

	/**
	 * @return PiewPiew_Model_AbstractModel
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->_mapper = new $this->_mapperClass();
		}
		return $this->_mapper;
	}

	/**
	 * @return array
	 */
	public function toArray() {
		$methods = get_class_methods($this);
		$array   = $this->_options;

		foreach ($methods as $method) {
			if ("getMapper" != $method &&
				"getMapperClass" != $method &&
				"get" == substr($method, 0, 3)) {
				$array[strtolower(substr($method, 3, 1)).substr($method, 4)] = $this->$method();
			}
		}

		return $array;
	}

	/**
	 * @return string
	 */
	public function toJson() {
		return Zend_Json::encode($this->toArray());
	}
}
