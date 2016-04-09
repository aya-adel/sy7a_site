<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $authorization = Zend_Auth::getInstance();
        $storage = $authorization->getStorage();
        $sessionRead = $storage->read();
        if ($authorization->hasIdentity())
        {
            $admin = $sessionRead->name;
            if ($this->_request->getActionName() != 'login' && $admin != 'admin')
                {
                $this->redirect("admin/login");
            } 
        }
        else {
                if ($this->_request->getActionName()  != 'login') {
                    $this->redirect("admin/login");
                }
            }
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        // action body
        $login_form = new Application_Form_Login( );
        $db = Zend_Db_Table::getDefaultAdapter();
        $validator = new Zend_Validate_Db_RecordExists(
                array(
            'table' => 'admin',
            'field' => 'email',
            'adapter' => $db
                )
        );
        $login_form->email->addValidator('EmailAddress', TRUE);
        $login_form->email->addValidator($validator, TRUE);
        if ($this->_request->isPost()) {
            if ($login_form->isValid($this->_request->getPost())) {// after check for validation get email and password to start auth
                $email = $this->_request->getParam('email');
                $password = $this->_request->getParam('password');
                // get the default db adapter
                $db = Zend_Db_Table::getDefaultAdapter();
                //create the auth adapter
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'admin', "email", 'password'); //set the email and password
                $authAdapter->setIdentity($email);
                $authAdapter->setCredential($password);
                //authenticate
                $result = $authAdapter->authenticate();
                if ($result->isValid()) {
                    //if the user is valid register his info in session
                    $auth = Zend_Auth::getInstance(); //if the user is valid register his info in session
                    $storage = $auth->getStorage();
                    // write in session email & id & first_name
                    $storage->write($authAdapter->getResultRowObject(array('email', 'id', 'name' , 'image')));
                    // redirect to root index/index
                    return $this->redirect('/admin');
                } else {
                    // if user is not valid send error message to view
                    //$this->view->error_message = "Invalid Email or Password!";
                    $login_form->getElement('password')->addError('Invalid Password!');
                }
            }
        }
        $this->view->login_form = $login_form;
    }

    public function logoutAction()
    {
        // action body
         $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        return $this->redirect('/admin/login');
    }

    public function blockuserAction()
    {
        // action body
        $user_obj = new Application_Model_User();
        $user_id = $this->_request->getParam("uid");
        $user_obj->blockUser($user_id);
        $this->redirect('/admin/listuser');
        
    }

    public function activateuserAction()
    {
        // action body
        $user_obj = new Application_Model_User();
        $user_id = $this->_request->getParam("uid");
        $user_obj->activaetUser($user_id);
        $this->redirect('/admin/listuser');
    }

    public function addcountryAction()
    {
        // action body
        $form = new Application_Form_Country();
        $this->view->addCountryForm = $form;
        $country_obj = new Application_Model_Country();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $upload= new Zend_File_Transfer_Adapter_Http();
                                                    $upload->addFilter('Rename', array('target' => "/var/www/html/fas7ny/public/images/". $name, 'overwrite' => true));

                $upload->receive(); 
                $_POST['image']="/images/".$_POST['name'].".jpg";
                $country_obj->addNewcountry($_POST);
                $this->redirect('/admin/listcountry');
            }
        }
    }

    public function addcityAction()
    {
        // action body
        $form = new Application_Form_City();
        $this->view->addCityForm = $form;
        $city_obj = new Application_Model_City();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $upload= new Zend_File_Transfer_Adapter_Http();
                                                    $upload->addFilter('Rename', array('target' => "/var/www/html/fas7ny/public/images/". $name, 'overwrite' => true));

                $upload->receive(); 
                $_POST['image']="/images/".$_POST['name'].".jpg";
                $city_obj->addNewcity($_POST);
                $this->redirect("/admin/listcity");
            }
        }
    }

    public function addhotelAction()
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
                $this->redirect('/admin/listhotel');
            }
        
        }
    }

    public function addroomAction()
    {
        // action body
    }

    public function editcountryAction()
    {
        // action body
        $form = new Application_Form_Countryedit();
        $country_obj = new Application_Model_Country();
        $id = $this->_request->getParam('id');
        $country_got = $country_obj->countryDetail($id);
        $form->populate($country_got[0]);
        $this->view->editCountryForm = $form;
        $request = $this->getRequest();
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $country_obj->updataCountry($id,$_POST);
                $this->redirect("/admin/listcountry");
            }
        }
    }

    public function editcityAction()
    {
        // action body
        $form = new Application_Form_City();
        $city_obj = new Application_Model_City();
        $id = $this->_request->getParam('id');
        $city_got = $city_obj->cityDetail($id);
        $form->populate($city_got[0]);
        $this->view->editCityForm = $form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $city_obj->updataCity($id, $_POST);
                $this->redirect("/admin/listcity");
            }
        }
    }

    public function edithotelAction()
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
                $this->redirect('/admin/listhotel'); // deh 3shan yrg3 l nfs sf7t el list 3shan y3rd el data b3d el update 

            }
        }
    }

    public function editroomlAction()
    {
        // action body
    }

    public function deletecountryAction()
    {
        // action body
        $country_obj = new Application_Model_Country();
        $country_id = $this->_request->getParam("id");
        $country_obj->deleteCountry($country_id);
        $this->redirect("/admin/listcountry");
    }

    public function deletecityAction()
    {
        // action body
        $city_obj = new Application_Model_City();
        $city_id = $this->_request->getParam("id");
        $city_obj->deleteCity($city_id);
        $this->redirect("/admin/listcity");
    }

    public function deletehotelAction()
    {
        // action body
        $hotel_obj = new Application_Model_Hotel();
        $hotel_id = $this->_request->getParam("id");
        $hotel_obj->deleteHotel($hotel_id);
        $this->redirect("/admin/listhotel");
    }

    public function showcountryAction()
    {
        // action body
    }

    public function showcityAction()
    {
        // action body
    }

    public function showhotelAction()
    {
        // action body
    }

    public function showroomAction()
    {
        // action body
    }

    public function showuserAction()
    {
        // action body
    }

    public function listuserAction()
    {
        // action body
        $user_obj = new Application_Model_User();
        $this->view->users = $user_obj->listUsers();
    }

    public function listcountryAction()
    {
        // action body
        $country_model = new Application_Model_Country();
        $this->view->country = $country_model->listCountry();
        //var_dump($country_model->listCountry());
    }

    public function listcityAction()
    {
        // action body
        
        $city_model = new Application_Model_City();
        $cityFields = $city_model->listCity();
        $this->view->city = $cityFields;
    }

    public function listhotelAction()
    {
        // action body
        $hotel_model = new Application_Model_Hotel();
        $hotelFields = $hotel_model->listHotel();
        $city_obj = new Application_Model_City();
        for($i=0;$i<count($hotelFields);$i++){
            //getcountry name
            $city_got = $city_obj->cityDetail($hotelFields[$i]['id']);
            $cityName= $city_got[0]['name'];//array_values($array)
            if($cityName==""){
                $cityName= "Unknown";                 
            }
            array_push($hotelFields[$i],$cityName);
        }
        $this->view->hotel = $hotelFields;
        //var_dump($hotel_model->listHotel());
    }

    public function listroomAction()
    {
        // action body
//        $room_model = new Application_Model_Room();
//        $this->view->room = $room_model->listRoom();
    }

    public function adduserAction()
    {
        // action body
        $form = new Application_Form_SignUp();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();
                                    $upload->addFilter('Rename', array('target' => "/var/www/html/fas7ny/public/images/". $name, 'overwrite' => true));

                $upload->receive();
                $_POST['image'] = "/images/" . $_POST['name'] . ".jpg";
                $user_obj = new Application_Model_User();
                $user_obj->addNewUser($_POST);
                $this->redirect('/admin/listuser');
            }
        }
        $this->view->user_form = $form;
    }

    public function listlocationAction()
    {
        // action body
        $location_model = new Application_Model_Location();
        $locationFields = $location_model->listLocation();
        $city_obj = new Application_Model_City();
        for($i=0;$i<count($locationFields);$i++){
            //getcity name
            $city_got = $city_obj->cityDetail($locationFields[$i]['id']);
            $cityName=$city_got[0]['name'];
            if($cityName==""){
                $cityName= "Unknown";                 
            }
            array_push($locationFields[$i],$cityName);
        }
        $this->view->location = $locationFields ;
    }

    public function addlocationAction()
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
 $upload->addFilter('Rename', array('target' => "/var/www/html/fas7ny/public/images/". $name, 'overwrite' => true));

                $upload->receive(); 
                $_POST['image']="/images/".$_POST['name'].".jpg";
                $location_obj->addNewlocation($_POST);
                $this->redirect('/admin/listlocation');
            }
        }
    }

    public function editlocationAction()
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
                $this->redirect('/admin/listlocation'); // deh 3shan yrg3 l nfs sf7t el list 3shan y3rd el data b3d el update 
            }
        }
    }

    public function deletelocationAction()
    {
        // action body
        $location_obj = new Application_Model_Location();
        $location_id = $this->_request->getParam("id");
        $location_obj->deleteLocation($location_id);
        $this->redirect("/admin/listlocation");
    }


}


















