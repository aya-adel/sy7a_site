<?php

class LocationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {
        // action body
         $location_model = new Application_Model_Location();
        $this->view->location = $location_model->listLocation();
    }

    public function addAction()
    {
        // action body
          // this funtion  that use to add form to the view 
        $form = new Application_Form_Location();
        $this->view->location_form = $form;
        $location_obj = new Application_Model_Location();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                    $upload= new Zend_File_Transfer_Adapter_Http();
                $upload->addFilter('Rename',"/var/www/html/fas7ny/public/images/".$_POST['name'].".jpg");
                $upload->receive(); 
                $_POST['image']="/images/".$_POST['name'].".jpg";
                $location_obj->addNewlocation($_POST);
                $this->redirect('/location/list');
            }
        }
    }

    public function updateAction()
    {
        // action body
         $form = new Application_Form_Location(); // hgyb object mn el form w deh elly hmleha b data elly htg3ly mn database 3shan 2sht8l 3leh
        $location_obj = new Application_Model_Location(); // deh el object elly hyrg3 data mn database
        $id = $this->_request->getParam('id'); // deh ana b2os el ide mn ellly htb3tlly lma 2dos 3la button el update 
        $location_got = $location_obj->locationDetail($id); // deh hgyb el details bt3t el user dah b id bt3o 
        // var_dump($client_got);exit();

        $form->populate($location_got[0]); // deh function wzftha 2nha tmlly el form elly 3ndy b data elly htglly bt3t el one user
        $this->view->form_c = $form; // mfrod hb3t l view el form el gdeda elly htb2a mmlya b data 


        $request = $this->getRequest(); // h3dal el data w hdos submit w btally lzm 2ml function wzftha 2nha bt3ml insert l data gdeda fe database
        if ($request->isPost()) {
               if ($form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();

                $name = $_FILES['image']['name'];


                if ($name != "") {
                    $upload->addFilter('Rename', array('target' => "/var/www/html/fas7ny/public/images/". $name, 'overwrite' => true));
                    $_POST['image'] = "/images/" .$name;
                } else {
                    $_POST['image'] = "";
                }

                $upload->receive();
              
                $location_obj->updataLocation($id, $_POST); // deh function wzftha 2nha bt3ml update lzm 23mlha hindel 
                $this->redirect('/location/list'); // deh 3shan yrg3 l nfs sf7t el list 3shan y3rd el data b3d el update 
            }
        }
    }

    public function detailsAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
        $location_obj = new Application_Model_Location();
        $location_id = $this->_request->getParam("id");
        $location_obj->deleteLocation($location_id);
        $this->redirect("/location/list");
    }


}











