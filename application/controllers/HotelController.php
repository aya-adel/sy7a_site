<?php

class HotelController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
           $hotel_obj = new Application_Model_Hotel();
         var_dump($hotel_obj->getAllHotels(6));
    }

    public function listAction()
    {
        // action body
         // action body
        $hotel_model = new Application_Model_Hotel();
        $this->view->hotel = $hotel_model->listHotel();
    }

    public function detailsAction()
    {
        // action body
         $hotel_model = new Application_Model_Hotel();
        $hotel_id = $this->_request->getParam("id");
         //$city_id = $this->_request->getParam("city_id");
        $hotel = $hotel_model->hotelDetail($hotel_id);
        $this->view->hotel = $hotel[0];
    }

    public function addAction()
    {
        // action body
          // this funtion  that use to add form to the view 
        $form = new Application_Form_Hotel();
        $this->view->hotel_form = $form;

        $hotel_obj = new Application_Model_Hotel();


        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $hotel_obj->addNewHotel($_POST);
                $this->redirect('/hotel/list');
            }
        
        }
    
    }

    public function deleteAction()
    {
        // action body
        // action body
         $hotel_obj = new Application_Model_Hotel();
        $hotel_id = $this->_request->getParam("id");
         //$country_id = $this->_request->getParam("country_id");
        $hotel_obj->deleteHotel($hotel_id);
        $this->redirect("/hotel/list");
    }

    public function updateAction()
    {
        // action body
         $form = new Application_Form_Hotel(); // hgyb object mn el form w deh elly hmleha b data elly htg3ly mn database 3shan 2sht8l 3leh
        $hotel_obj = new Application_Model_Hotel(); // deh el object elly hyrg3 data mn database
        $id = $this->_request->getParam('id'); // deh ana b2os el ide mn ellly htb3tlly lma 2dos 3la button el update 
        $hotel_got = $hotel_obj->hotelDetail($id); // deh hgyb el details bt3t el user dah b id bt3o 
        // var_dump($client_got);exit();

        $form->populate($hotel_got[0]); // deh function wzftha 2nha tmlly el form elly 3ndy b data elly htglly bt3t el one user
        $this->view->form_c = $form; // mfrod hb3t l view el form el gdeda elly htb2a mmlya b data 

        
        $request = $this->getRequest(); // h3dal el data w hdos submit w btally lzm 2ml function wzftha 2nha bt3ml insert l data gdeda fe database
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                
                $hotel_obj->updataHotel($id,$_POST); // deh function wzftha 2nha bt3ml update lzm 23mlha hindel 
                $this->redirect('/hotel/list'); // deh 3shan yrg3 l nfs sf7t el list 3shan y3rd el data b3d el update 

            }
        }
    }


}











