<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->redirect("/country/");
    }

    public function checkAction()
    {
        // action body
    }

    public function chcAction()
    {
        // action body
        
    }
    public function ajaxAction()
    {
        // action body
        $this->_helper->layout()->disableLayout();
        //when some one wirte /index/te7aajax they won't be rendered to the view script
        $this->_helper->viewRenderer->setNoRender(true);
        //$user_name =$_POST['name'];
        $response = array();
        $q = trim(strip_tags($_GET['name']));
        $city = new Application_Model_City();
        
        $cityname = $city->fetchAll()->toArray();
        //var_dump($cityname);
        
        foreach ($cityname as $n) {
            if (strlen($q) && strpos($n['name'], $q) === 0) {
                $response [] = $n['name'];
            }
        }
        echo json_encode($response);
//        echo json_encode($user_name);
    }

    public function addAction()
    {
                // action body
                //stop the layout from rendring in case you have enabled it
		$this->_helper->layout()->disableLayout();
                //when some one wirte /index/te7aajax they won't be rendered to the view script
		 $this->_helper->viewRenderer->setNoRender(true);
		 $user_name =$_POST['name'];
       		 echo json_encode($user_name);
    }
}