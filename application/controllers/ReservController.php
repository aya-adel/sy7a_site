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
        $city_id = $_GET['id'];
        $model_hotel = new Application_Model_Hotel();
        $locations = new Application_Model_Location();
        $allloc = $locations->getAllLocations($city_id);
        $allhotel = array();
        foreach ($allloc as $loc)
        {
            $allhotel[]= $model_hotel->getAllHotels($loc['id']);
        }
         $response = array();
        foreach ($allhotel as $hotel) {
            
            foreach ($hotel as $hot) {

                    if (strlen($q) && strpos($hot['name'], $q) === 0) {
                        $response [] = $hot['name'];
                    }
            }
            
        }
        echo json_encode($response);
    }

}
