<?php

class CountryController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        // action body
        $country_model = new Application_Model_Country();
        $this->view->country = $country_model->listCountry();
        $rate = new Application_Model_CountryRate;
        $result = $rate->calchighRate();

        $s = array();
        foreach ($result as $key => $value) {          // $country[]=$value['country_id'];
            $xx = $country_model->countryDetail($value['country_id']);
            $s[] = $xx;
        }
//var_dump($s); exit;
        $this->view->countryarr = $s;
        $city = new Application_Model_City();
        $city_model = new Application_Model_CityRate();
        $result_1 = $city_model->calchighRate();

        $ss = array();
        foreach ($result_1 as $key => $value) {          // $country[]=$value['country_id'];
            $xx = $city->cityDetail($value['city_id']);
            $ss[] = $xx;
        }
//var_dump($s); exit;
        $this->view->cityarr = $ss;
    }

    public function listAction() {
        $country_model = new Application_Model_Country();
        $this->view->country = $country_model->listCountry();
    }

    public function detailsAction() {
        $country_model = new Application_Model_Country();
        $city_model = new Application_Model_City();
        $country_id = $this->_request->getParam("id");
        $allcities = $city_model->getAllCities($country_id);
        $country = $country_model->countryDetail($country_id);
        $this->view->country = $country[0];
        $this->view->cites = $allcities;

        $paginator = Zend_Paginator::factory($allcities);
        $paginator->setDefaultItemCountPerPage(2);
        $allItems = $paginator->getTotalItemCount();
        $countPages = $paginator->count();
        $p = $this->getRequest()->getParam('p');
        if (isset($p)) {
            $paginator->setCurrentPageNumber($p);
        } else
            $paginator->setCurrentPageNumber(1);
        $currentPage = $paginator->getCurrentPageNumber();
        $this->view->cites = $paginator;
        $this->view->countItems = $allItems;
        $this->view->countPages = $countPages;
        $this->view->currentPage = $currentPage;
        if ($currentPage == $countPages) {
            $this->view->nextPage = $countPages;
            $this->view->previousPage = $currentPage - 1;
        } else if ($currentPage == 1) {
            $this->view->nextPage = $currentPage + 1;
            $this->view->previousPage = 1;
        } else {
            $this->view->nextPage = $currentPage + 1;
            $this->view->previousPage = $currentPage - 1;
        }
    }

    public function addAction() {
        // this funtion  that use to add form to the view 
        $form = new Application_Form_Country();
        $this->view->country_form = $form;

        $country_obj = new Application_Model_Country();


        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();
                $upload->addFilter('Rename', "/var/www/html/fas7ny/public/images/" . $_POST['name'] . ".jpg");
                $upload->receive();
                $_POST['image'] = "/images/" . $_POST['name'] . ".jpg";
                $country_obj->addNewcountry($_POST);
                $this->redirect('/country/list');
            }
        }
    }

    public function deleteAction() {
        $country_obj = new Application_Model_Country();
        $country_id = $this->_request->getParam("id");
        $country_obj->deleteCountry($country_id);
        $this->redirect("/country/list");
    }

    public function updateAction() {
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
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();
                $upload->addFilter('Rename', "/var/www/html/fas7ny/public/images/" . $_POST['name'] . ".jpeg");
                $upload->receive();
                $_POST['image'] = "/images/" . $_POST['name'] . ".jpeg";
                $country_obj->updataCountry($id, $_POST); // deh function wzftha 2nha bt3ml update lzm 23mlha hindel 
                $this->redirect('/country/list'); // deh 3shan yrg3 l nfs sf7t el list 3shan y3rd el data b3d el update 
            }
        }
    }

}
