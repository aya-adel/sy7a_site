<?php

class CityController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
         $city_obj = new Application_Model_City();
         var_dump($city_obj->getAllCities(2));
    }

    public function listAction()
    {
        // action body
        $city_model = new Application_Model_City();
        $this->view->city = $city_model->listCity();
    }

    public function deleteAction()
    {
        // action body
         $city_obj = new Application_Model_City();
        $city_id = $this->_request->getParam("id");
         //$country_id = $this->_request->getParam("country_id");
        $city_obj->deleteCity($city_id);
        $this->redirect("/city/list");
    }

    public function detailsAction()
    {
        // action body
        $city_model = new Application_Model_City();
        $city_id = $this->_request->getParam("id");
         $county_id = $this->_request->getParam("country_id");
        $city = $city_model->getAllCities($county_id);
        $this->view->city = $city[0];
    }

    public function addAction()
    {
       // this funtion  that use to add form to the view 
        $form = new Application_Form_City();
        $this->view->city_form = $form;

        $city_obj = new Application_Model_City();


        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $city_obj->addNewcity($_POST);
                $this->redirect('/city/list');
            }
        
    
    }
 }

    public function editAction()
    {
        // action body
        // action body
         // 1- get client form to edit view
        $form = new Application_Form_City(); // hgyb object mn el form w deh elly hmleha b data elly htg3ly mn database 3shan 2sht8l 3leh
        $city_obj = new Application_Model_City(); // deh el object elly hyrg3 data mn database
        $id = $this->_request->getParam('id'); // deh ana b2os el ide mn ellly htb3tlly lma 2dos 3la button el update 
        $city_got = $city_obj->cityDetail($id); // deh hgyb el details bt3t el user dah b id bt3o 
        // var_dump($client_got);exit();

        $form->populate($city_got[0]); // deh function wzftha 2nha tmlly el form elly 3ndy b data elly htglly bt3t el one user
        $this->view->form_c = $form; // mfrod hb3t l view el form el gdeda elly htb2a mmlya b data 

        
        $request = $this->getRequest(); // h3dal el data w hdos submit w btally lzm 2ml function wzftha 2nha bt3ml insert l data gdeda fe database
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                
                $city_obj->updataCity($id,$_POST); // deh function wzftha 2nha bt3ml update lzm 23mlha hindel 
                $this->redirect('/city/list'); // deh 3shan yrg3 l nfs sf7t el list 3shan y3rd el data b3d el update 

            }
        }
    }


}











