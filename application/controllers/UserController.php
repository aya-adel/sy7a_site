<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        $authorization = Zend_Auth::getInstance();
        $fbsession = new Zend_Session_Namespace('facebook');
        if (!$authorization->hasIdentity() &&
                !isset($fbsession->name)) {
            if ($this->_request->getActionName() != 'log-in' &&$this->_request->getActionName() != 'add-user' && $this->_request->getActionName() != 'fpauth') {
                $this->redirect("user/log-in");
            }
        }
    }

    public function indexAction()
    {
        
    }

    public function listusersAction()
    {

        $user_obj = new Application_Model_User();
        $this->view->users = $user_obj->listUsers();
        
        
        
        
    }

    public function listresroomAction()
    {
        $room = new Application_Model_ResRoom();
         $paginator = Zend_Paginator::factory($room->listall());
         //var_dump($Rescar->listall()); exit;
        $paginator->setDefaultItemCountPerPage(2);
        $allItems = $paginator->getTotalItemCount();
        $countPages = $paginator->count();

        $p = $this->getRequest()->getParam('p');
        if(isset($p))
        {
          $paginator->setCurrentPageNumber($p);
        } else $paginator->setCurrentPageNumber(1);

        $currentPage = $paginator->getCurrentPageNumber();

        $this->view->trees = $paginator;
        $this->view->countItems = $allItems;
        $this->view->countPages = $countPages;
        $this->view->currentPage = $currentPage;

        if($currentPage == $countPages)
        {
             $this->view->nextPage = $countPages;
             $this->view->previousPage = $currentPage-1;
        }
        else if($currentPage == 1)
        {
             $this->view->nextPage = $currentPage+1;
             $this->view->previousPage = 1;
        }
        else {
            $this->view->nextPage = $currentPage+1;
            $this->view->previousPage = $currentPage-1;
        } 
    }

    public function showUserAction()
    {
// action body      

        $user_obj = new Application_Model_User();
        $user_id = $this->_request->getParam("uid");
        $user = $user_obj->showUser($user_id);
        $this->view->ul = $user[0];
    }

    public function blockUserAction()
    {
// action body
        $user_obj = new Application_Model_User();
        $user_id = $this->_request->getParam("uid");
        $user_obj->blockUser($user_id);
        $this->redirect('/user/listusers');
    }

    public function editUserAction()
    {
// action body
        $form = new Application_Form_SignUp();
        $user_obj = new Application_Model_User();
        $id = $this->_request->getParam('uid');
        $user_data = $user_obj->showUser($id)[0];
        $form->populate($user_data);
       // $form->getElement('email')->setAttrib('readonly', 'readonly');
        $form->getElement('submit')->setName('Update');
        $form->removeElement('email');
//$form->getElement('email')->setAttrib('disabled','disabled' );
        $this->view->user_form = $form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();
                $upload->addFilter('Rename', "/var/www/html/fas7ny/public/images/" . $_POST['name'] . ".jepg");
                $upload->receive();
                $_POST['image'] = "/images/" . $_POST['name'] . ".jepg";
                $user_obj->updateUser($_POST);
                $this->redirect('/user/listusers');
            }
        }
        $resform = new Application_Model_ResRoom();
        $this->view->form = $resform->listall();
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
        $city_id = $this->_request->getParam("city_id");
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $Res_model = new Application_Model_ResRoom();
                $Res_model->addNewRes($_POST);
                $this->redirect("/user/listresroom");
            }
        }
        $this->view->form = $form;
        $this->view->city_id = $city_id;
    }

    public function listrescarAction()
    {
        // body
         $Rescar=new Application_Model_ResCar();
         $paginator = Zend_Paginator::factory($Rescar->listall());
         //var_dump($Rescar->listall()); exit;
        $paginator->setDefaultItemCountPerPage(2);
        $allItems = $paginator->getTotalItemCount();
        $countPages = $paginator->count();

        $p = $this->getRequest()->getParam('p');
        if(isset($p))
        {
          $paginator->setCurrentPageNumber($p);
        } else $paginator->setCurrentPageNumber(1);

        $currentPage = $paginator->getCurrentPageNumber();

        $this->view->trees = $paginator;
        $this->view->countItems = $allItems;
        $this->view->countPages = $countPages;
        $this->view->currentPage = $currentPage;

        if($currentPage == $countPages)
        {
             $this->view->nextPage = $countPages;
             $this->view->previousPage = $currentPage-1;
        }
        else if($currentPage == 1)
        {
             $this->view->nextPage = $currentPage+1;
             $this->view->previousPage = 1;
        }
        else {
            $this->view->nextPage = $currentPage+1;
            $this->view->previousPage = $currentPage-1;
        }       
        
        
        
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
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $Res_model = new Application_Model_ResCar();
                //var_dump($_POST);exit;
                $Res_model->addNewRes($_POST);
                $this->redirect("/user/listrescar");
            }
        }
        $this->view->form = $form;
    }

    public function testAction()
    {
        $testform = new Application_Form_Test();
        $this->view->form = $testform;
    }

    public function getdataAction()
    {
        $this->_helper->layout()->disableLayout();
        $users = new Application_Model_ResRoom();                           //create object of your model
        $this->_helper->viewRenderer->setNoRender();
        if ($this->getRequest()->isXmlHttpRequest()) {

            $id = $this->_getParam('id');
            $userData = $users->getData('1');
            //var_dump($userData);exit;
            $dojoData = new Zend_Dojo_Data('id', $userData, 'id');
            echo $dojoData->toJson();
        }
    }

    public function addUserAction()
    {
// action body
        $form = new Application_Form_SignUp();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();
                $upload->addFilter('Rename', "/var/www/html/fas7ny/public/images/" . $_POST['name'] . ".jpg");
                $upload->receive();
                $_POST['image'] = "/images/" . $_POST['name'] . ".jpg";
                $user_obj = new Application_Model_User();
                $user_obj->addNewUser($_POST);
                $this->redirect('/user');
            }
        }
        $this->view->user_form = $form;
    }

    public function logInAction()
    {
        // action body
        // get login form and check for validation
        $login_form = new Application_Form_Login( );
        if ($this->_request->isPost()) {
            if ($login_form->isValid($this->_request->getPost())) {// after check for validation get email and password to start auth
                $email = $this->_request->getParam('email');
                $password = $this->_request->getParam('password');
                // get the default db adapter
                $db = Zend_Db_Table::getDefaultAdapter();
                //create the auth adapter
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'user', "email", 'password'); //set the email and password
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
                    return $this->redirect('/country/');
                } else {
                    // if user is not valid send error message to view
                    //$this->view->error_message = "Invalid Email or Password!";
                    $login_form->getElement('password')->addError('Invalid Password!');
                }
            }
        }
        $this->view->login_form = $login_form;



        $fb = new Facebook\Facebook([
            'app_id' => '566537100167424', // Replace {app-id} with your app id
            'app_secret' => '0e72350a1ff5d34e4a0a487f4be811cd',
            'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $loginUrl = $helper->getLoginUrl($this->view->serverUrl() .
                $this->view->baseUrl() . '/user/fpauth');
        $this->view->facebook_url = $loginUrl;
    }

    public function logOutAction()
    {

        // action body
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        return $this->redirect('/user/log-in');
    }

    public function activateUserAction()
    {
// action body
        $user_obj = new Application_Model_User();
        $user_id = $this->_request->getParam("uid");
        $user_obj->activaetUser($user_id);
        $this->redirect('/user/listusers');
    }

    public function fpauthAction()
    {

        // action body
        $fb = new Facebook\Facebook([
            'app_id' => '566537100167424', // Replace {app-id} with your app id
            'app_secret' => '0e72350a1ff5d34e4a0a487f4be811cd',
            'default_graph_version' => 'v2.2',
        ]);


        // use helper method of facebook for login
        $helper = $fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error (headers link)
            echo 'Graph returned an error: ' . $e->getMessage();
            Exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            Exit;
        }// handle access toaken & print full error message
        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() .
                "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            Exit;
        }// Logged in
// The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2User = $fb->getOAuth2Client();
//check if access token expired
        if (!$accessToken->isLongLived()) {
// Exchanges a short-lived access token for a long-lived one
            try {
// try to get another access token
                $accessToken = $oAuth2User->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                Exit;
            }
        }//Sets the default fallback access token so we don't have to pass it to each request
        $fb->setDefaultAccessToken($accessToken);
        try {
            $response = $fb->get('/me');
            $userNode = $response->getGraphUser();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            Exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            Exit;
        }
        $fpsession = new Zend_Session_Namespace('facebook');
// write in session email & id & fname
        $fpsession->name = $userNode->getName();
        $this->redirect('/user/listusers');
    }

    public function fblogoutAction()
    {
    Zend_Session::namespaceUnset('facebook');
    $this->redirect("/user/log-in");
    }

    public function pagtestAction()
    {
        // body
         $Rescar=new Application_Model_ResCar();
         $paginator = Zend_Paginator::factory($Rescar->listall());
         //var_dump($Rescar->listall()); exit;
        $paginator->setDefaultItemCountPerPage(2);
        $allItems = $paginator->getTotalItemCount();
        $countPages = $paginator->count();

        $p = $this->getRequest()->getParam('p');
        if(isset($p))
        {
          $paginator->setCurrentPageNumber($p);
        } else $paginator->setCurrentPageNumber(1);

        $currentPage = $paginator->getCurrentPageNumber();

        $this->view->trees = $paginator;
        $this->view->countItems = $allItems;
        $this->view->countPages = $countPages;
        $this->view->currentPage = $currentPage;

        if($currentPage == $countPages)
        {
             $this->view->nextPage = $countPages;
             $this->view->previousPage = $currentPage-1;
        }
        else if($currentPage == 1)
        {
             $this->view->nextPage = $currentPage+1;
             $this->view->previousPage = 1;
        }
        else {
            $this->view->nextPage = $currentPage+1;
            $this->view->previousPage = $currentPage-1;
        }       
    }

    public function ratetestAction()
    {
           

           }


}

