<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
// action body
    }

    public function listusersAction()
    {
        $user_obj = new Application_Model_User();
        $this->view->clients = $user_obj->listUsers();
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
        $form->getElement('email')->setAttrib('readonly', 'readonly');
        $form->getElement('submit')->setName('Update');
//$form->getElement('email')->setAttrib('disabled','disabled' );
        $this->view->user_form = $form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $user_obj->updateClient($_POST);
                $this->redirect('/user/listusers');
            }
        }
    }

    public function addUserAction()
    {
// action body
        $form = new Application_Form_SignUp();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $user_obj = new Application_Model_User();
                $user_obj->addNewUser($request->getParams());
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
                    $storage->write($authAdapter->getResultRowObject(array('email', 'id', 'name')));
                    // redirect to root index/index
                    return $this->redirect('/user/listusers');
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
        
        
        
    }


}


