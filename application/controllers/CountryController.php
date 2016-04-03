<?php

class CountryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $country_model = new Application_Model_Country();
        $this->view->country = $country_model->listCountry();
    }

    public function listAction()
    {
        $country_model = new Application_Model_Country();
        $this->view->country = $country_model->listCountry();
    }

    public function detailsAction()
    {
        $country_model = new Application_Model_Country();
        $city_model = new Application_Model_City();
        $country_id = $this->_request->getParam("id");
        $allcities = $city_model->getAllCities($country_id);
        $country = $country_model->countryDetail($country_id);
        $this->view->country = $country[0];
        $this->view->cites = $allcities;
        
    }

    public function addAction()
    {
        // this funtion  that use to add form to the view 
        $form = new Application_Form_Country();
        $this->view->country_form = $form;

        $country_obj = new Application_Model_Country();


        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {

                $country_obj->addNewcountry($_POST);
                $this->redirect('/country/list');
            }
        
    }
 }

    public function deleteAction()
    {
        $country_obj = new Application_Model_Country();
        $country_id = $this->_request->getParam("id");
        $country_obj->deleteCountry($country_id);
        $this->redirect("/country/list");
    }

    public function updateAction()
    {
        // action body
         // 1- get client form to edit view
        $form = new Application_Form_Countryedit(); // hgyb object mn el form w deh elly hmleha b data elly htg3ly mn database 3shan 2sht8l 3leh
        $country_obj = new Application_Model_Country(); // deh el object elly hyrg3 data mn database
        $id = $this->_request->getParam('id'); // deh ana b2os el ide mn ellly htb3tlly lma 2dos 3la button el update 
        $country_got = $country_obj->countryDetail($id); // deh hgyb el details bt3t el user dah b id bt3o 
        // var_dump($client_got);exit();

        $form->populate($country_got[0]); // deh function wzftha 2nha tmlly el form elly 3ndy b data elly htglly bt3t el one user
        $this->view->form_c = $form; // mfrod hb3t l view el form el gdeda elly htb2a mmlya b data 

        
        $request = $this->getRequest(); // h3dal el data w hdos submit w btally lzm 2ml function wzftha 2nha bt3ml insert l data gdeda fe database
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                
                $country_obj->updataCountry($id,$_POST); // deh function wzftha 2nha bt3ml update lzm 23mlha hindel 
                $this->redirect('/country/list'); // deh 3shan yrg3 l nfs sf7t el list 3shan y3rd el data b3d el update 

            }
        }
    }


}


