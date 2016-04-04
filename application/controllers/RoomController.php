<?php

class RoomController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
         $room_obj = new Application_Model_Room();
         var_dump($room_obj->getAllRooms(2));
    }

    public function listAction()
    {
       
        $room_model = new Application_Model_Room();
        $this->view->room = $room_model->listRoom();
    }

    public function deleteAction()
    {
        // action body
         // action body
         $room_obj = new Application_Model_Room();
        $room_id = $this->_request->getParam("id");
         //$country_id = $this->_request->getParam("country_id");
        $room_obj->deleteRoom($room_id);
        $this->redirect("/room/list");
    }

    public function addAction()
    {
         // action body
          // this funtion  that use to add form to the view 
        $form = new Application_Form_Room();
        $this->view->room_form = $form;

        $room_obj = new Application_Model_Room();


        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $room_obj->addNewRoom($_POST);
                $this->redirect('/room/list');
            }
        
        }
    }

    public function updateAction()
    {
        // action body
         $form = new Application_Form_Room(); // hgyb object mn el form w deh elly hmleha b data elly htg3ly mn database 3shan 2sht8l 3leh
        $room_obj = new Application_Model_Room(); // deh el object elly hyrg3 data mn database
        $id = $this->_request->getParam('id'); // deh ana b2os el ide mn ellly htb3tlly lma 2dos 3la button el update 
        $room_got = $room_obj->roomDetail($id); // deh hgyb el details bt3t el user dah b id bt3o 
        // var_dump($client_got);exit();

        $form->populate($room_got[0]); // deh function wzftha 2nha tmlly el form elly 3ndy b data elly htglly bt3t el one user
        $this->view->form_c = $form; // mfrod hb3t l view el form el gdeda elly htb2a mmlya b data 

        
        $request = $this->getRequest(); // h3dal el data w hdos submit w btally lzm 2ml function wzftha 2nha bt3ml insert l data gdeda fe database
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                
                $room_obj->updataHotel($id,$_POST); // deh function wzftha 2nha bt3ml update lzm 23mlha hindel 
                $this->redirect('/room/list'); // deh 3shan yrg3 l nfs sf7t el list 3shan y3rd el data b3d el update 

            }
        }
    }

    public function detailsAction()
    {
        // action body
         $room_model = new Application_Model_Room();
        $room_id = $this->_request->getParam("id");
         //$city_id = $this->_request->getParam("city_id");
        $room = $room_model->roomDetail($room_id);
        $this->view->room = $room[0];
    }


}











