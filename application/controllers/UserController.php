<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listusersAction()
    {
        $user_model = new Application_Model_User();
      $th = $user_model->listUsers();
      var_dump($th);
    }
    
    
}



