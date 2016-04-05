<?php

class AjaxtestController extends Zend_Controller_Action
{

    public function init()
    {
        /*  action controller here */
        $contextswitch=$this->_helper->getHelper('contextSwitch');
        $contextswitch->addActionContext('ajaxlist','json');
    }

    public function indexAction()
    {
        // action body
    }

    public function ajaxlistAction()
    {
        $user_obj=new Application_Model_User();
        $all_user=$user_obj->listUsers();
        $this->view->$all_user;//  var_dump($all_user); exit;
        
                
    }


}



