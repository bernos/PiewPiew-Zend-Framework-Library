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
        $model = new Application_Model_Example();
        $model->sometext="Adsf";
        $model->save();
    }


}

