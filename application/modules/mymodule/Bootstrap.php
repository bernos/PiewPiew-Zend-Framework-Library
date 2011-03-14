<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bootstrap
 *
 * @author Brendan McMahon (bernos@gmail.com)
 */
class Mymodule_Bootstrap extends PiewPiew_Application_Module_Bootstrap {
    //put your code here
  public function  __construct($application) {
    parent::__construct($application);
    //print('created my module');
    //print_r($this->getApplication()->getOptions());
  }
}
?>
