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
         var_dump($hotel_obj->getAllHotels(1));
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


}







