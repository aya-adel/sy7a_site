<?php

class AdminController extends Zend_Controller_Action {

    public function init() {
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

    public function indexAction() {
        // action body
    }

    public function loginAction() {
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
                    $storage->write($authAdapter->getResultRowObject(array('email', 'id', 'name')));
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

    public function logoutAction() {
        // action body
         $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        return $this->redirect('/user/log-in');
    }

    public function blockuserAction() {
        // action body
        
        
    }

    public function activateuserAction() {
        // action body
    }

    public function addcountryAction() {
        // action body
    }

    public function addcityAction() {
        // action body
    }

    public function addhotelAction() {
        // action body
    }

    public function addroomAction() {
        // action body
    }

    public function editcountryAction() {
        // action body
    }

    public function editcityAction() {
        // action body
    }

    public function edithotelAction() {
        // action body
    }

    public function editroomlAction() {
        // action body
    }

    public function deletecountryAction() {
        // action body
    }

    public function deletecityAction() {
        // action body
    }

    public function deletehotelAction() {
        // action body
    }

    public function showcountryAction() {
        // action body
    }

    public function showcityAction() {
        // action body
    }

    public function showhotelAction() {
        // action body
    }

    public function showroomAction() {
        // action body
    }

    public function showuserAction() {
        // action body
    }
}
