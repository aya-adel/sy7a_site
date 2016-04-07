<?php

class ReservController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function getallhotelsAction() {
        // action body
        //stop the layout from rendring in case you have enabled it
        $this->_helper->layout()->disableLayout();
        //when some one wirte /index/te7aajax they won't be rendered to the view script
        $this->_helper->viewRenderer->setNoRender(true);
        $q = trim(strip_tags($_GET['name']));
        $model_hotel = new Application_Model_Hotel();
        $allhotel = $model_hotel->getAllHotels(1);
        $response = array();
        foreach ($allhotel as $hotel) {
            if (strlen($q) && strpos($hotel['name'], $q) === 0) {
                $response [] = $hotel['name'];
            }
        }
        echo json_encode($response);
    }

}
