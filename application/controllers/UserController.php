<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
    }

    public function listresroomAction()
    {
        $resform=new Application_Model_ResRoom();
        $this->view->form=$resform->listall();
    }

    public function deleteAction()
    {
      $reservation_model = new Application_Model_ResRoom();
      $reservation_id = $this->_request->getParam("id");
      // echo $reservation_id;
      //exit;
      $reservation_model->deletereservation($reservation_id);
      $this->redirect("/user/listresroom");
    }

    public function addreservationAction()
    {
     
        $form = new Application_Form_Addnewres();
        $request = $this->getRequest();
        if($request->isPost()){
        if($form->isValid($request->getPost())){
        $Res_model = new Application_Model_ResRoom();
        $Res_model-> addNewRes($_POST);
        $this->redirect("/user/listresroom");
         }
         
        }
          $this->view->form=$form;
    }

    public function listrescarAction()
    {
        $resform=new Application_Model_ResCar();
        $this->view->form=$resform->listall();
    }

    public function delrescarAction()
    {
      $reservation_model = new Application_Model_ResCar();
      $reservation_id = $this->_request->getParam("id");
      $reservation_model->deletereservation($reservation_id);
      $this->redirect("/user/listrescar");
    }

    public function addrescarAction()
    {
        $form = new Application_Form_Addnewcar();
        $request = $this->getRequest();
        if($request->isPost()){
        if($form->isValid($request->getPost())){
        $Res_model = new Application_Model_ResCar();
        //var_dump($_POST);exit;
        $Res_model-> addNewRes($_POST);
        $this->redirect("/user/listrescar");
    }


}
          $this->view->form=$form;

    }

    public function testAction()
    {
        $testform= new Application_Form_Test();
        $this->view->form=$testform;
    }

    public function getdataAction()
    {
        //$this->_helper->layout()->disableLayout();
        $users = new Application_Model_ResRoom();                           //create object of your model
       // $this->_helper->viewRenderer->setNoRender();
       //if ($this->getRequest()->isXmlHttpRequest()) {
           // echo "iam here"; exit;
           //$id = $this->_getParam('id');
           
            $userData = $users->getData(1);
            //echo json_encode($userData); 
            //var_dump($userData); exit;
            $dojoData= new Zend_Dojo_Data('id',$userData,'id');
            echo $dojoData->toJson();
            
        
    //}

    }
}























