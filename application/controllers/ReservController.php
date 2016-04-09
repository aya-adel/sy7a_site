<?php

class ReservController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function getallhotelsAction()
    {
        // action body
        //stop the layout from rendring in case you have enabled it
        $this->_helper->layout()->disableLayout();
        //when some one wirte /index/te7aajax they won't be rendered to the view script
        $this->_helper->viewRenderer->setNoRender(true);
        $q = trim(strip_tags($_GET['name']));
        $city_id = $_GET['city_id'];
        $model_hotel = new Application_Model_Hotel();
        $locations = new Application_Model_Location();
        $allloc = $locations->getAllLocations($city_id);
        $allhotel = array();
        foreach ($allloc as $loc) {
            $allhotel[] = $model_hotel->getAllHotels($loc['id']);
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

    public function getroomsAction()
    {
        // action body
        $this->_helper->layout()->disableLayout();
        //when some one wirte /index/te7aajax they won't be rendered to the view script
        $this->_helper->viewRenderer->setNoRender(true);

        $room = new Application_Model_Room();
        $hotelname = $_GET['hotelname'];
        $roomType = $_GET['roomtype'];
        $hotel = new Application_Model_Hotel();
        $hot = $hotel->fetchAll("name = '$hotelname'")->toArray()[0];
        $hotel_id = $hot['id'];
        $allRooms = $room->getAllRooms($hotel_id);
        $response = array();
        foreach ($allRooms as $rom) {
            if($rom['type'] == $roomType)
            {
                $response [] = $rom;
            }
        }
        echo json_encode($response);
    }

    public function getcarsAction()
    {
        // action body
         // action body
        $this->_helper->layout()->disableLayout();
        //when some one wirte /index/te7aajax they won't be rendered to the view script
        $this->_helper->viewRenderer->setNoRender(true);
        
        $locations = new Application_Model_Location();
        $city_id = $_GET['city_id'];
        $allloc = $locations->getAllLocations($city_id);
        $car = new Application_Model_Car();
        
        $allcars = array();
        foreach ($allloc as $loc) {
            $allcars[] = $car->getAllCars($loc['id']);
        }
        echo json_encode($allcars);
        
    }


}


