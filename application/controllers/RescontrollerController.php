<?php

class RescontrollerController extends Zend_Controller_Action
{

    public function init()
    {
        $contextswitch=$this->_helper->getHelper('contextSwitch');
         $contextswitch->addActionContext('list','json')
                 ->initContext();
        }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {
        $res_obj=new Application_Model_ResRoom();
        var_dump($res_obj->listall()); exit;
//        $pagnator=new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($res_obj->list));
//        $pagnator->setItemCountPerPage(3)
//                ->setCurrentPageNumber($this->_getParam('page',1))
//                ->setPageRange(3);
//        print_r($pagnator); exit;
        $res=array();
        foreach($pagnator as $reserv)
        {
            $res[]=$reserv;
        }
      //  var_dump($res); exit;
       $this->view->form=$res;
       
        }


}



