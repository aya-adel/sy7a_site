<?php

class CarController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        // action body
         $car_obj = new Application_Model_Car();
         var_dump($car_obj->getAllCars(1));
    }

    public function listAction()
    {
        // action body
        $car_model = new Application_Model_Car();
        $this->view->car = $car_model->listCar();
    }

    public function detailsAction()
    {
        // action body
         $car_model = new Application_Model_Car();
        $car_id = $this->_request->getParam("id");
         //$city_id = $this->_request->getParam("city_id");
        $car = $car_model->carDetail($car_id);
        $this->view->car = $car[0];
    }

    public function addAction()
    {
        // action body
          // this funtion  that use to add form to the view 
        $form = new Application_Form_Car();
        $this->view->car_form = $form;

        $car_obj = new Application_Model_Car();


        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $car_obj->addNewCar($_POST);
                $this->redirect('/car/list');
            }
        
        
    
    }
    }

    public function updataAction()
    {
       
         // action body
         $form = new Application_Form_Car(); // hgyb object mn el form w deh elly hmleha b data elly htg3ly mn database 3shan 2sht8l 3leh
        $car_obj = new Application_Model_Car(); // deh el object elly hyrg3 data mn database
        $id = $this->_request->getParam('id'); // deh ana b2os el ide mn ellly htb3tlly lma 2dos 3la button el update 
        $car_got = $car_obj->carDetail($id); // deh hgyb el details bt3t el user dah b id bt3o 
        // var_dump($client_got);exit();

        $form->populate($car_got[0]); // deh function wzftha 2nha tmlly el form elly 3ndy b data elly htglly bt3t el one user
        $this->view->form_c = $form; // mfrod hb3t l view el form el gdeda elly htb2a mmlya b data 

        
        $request = $this->getRequest(); // h3dal el data w hdos submit w btally lzm 2ml function wzftha 2nha bt3ml insert l data gdeda fe database
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                
                $car_obj->updataCar($id,$_POST); // deh function wzftha 2nha bt3ml update lzm 23mlha hindel 
                $this->redirect('/car/list'); // deh 3shan yrg3 l nfs sf7t el list 3shan y3rd el data b3d el update 

            }
        
    }
    }

    public function deleteAction()
    {
        // action body
         $car_obj = new Application_Model_Car();
        $car_id = $this->_request->getParam("id");
         //$country_id = $this->_request->getParam("country_id");
        $car_obj->deleteCar($car_id);
        $this->redirect("/car/list");
    }


}











