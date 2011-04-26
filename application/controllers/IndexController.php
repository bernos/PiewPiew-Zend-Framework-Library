<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
      
    }

    public function indexAction()
    {
        // action body
        $conn = Doctrine_Manager::connection();
        $conn->export->createTable('test', array('name' => array('type' => 'string')));
$conn->execute('INSERT INTO test (name) VALUES (?)', array('jwage'));
    }


}

