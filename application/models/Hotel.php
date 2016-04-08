<?php

class Application_Model_Hotel extends Zend_Db_Table_Abstract {


 protected $_name = 'hotel';
 // the first function list the all Hotel
    function listHotel() {
        return $this->fetchAll()->toArray();
    }

    // the second function delete Hotel 
    function deleteHotel($id) {
        $this->delete("id=$id");
    }

    // the third function display specific Hotel with its id 
    function hotelDetail($id) {
        return $this->find($id)->toArray();
    }
    
    
    function getAllHotels($location_id){
        return $this->fetchAll("location_id=$location_id")->toArray();
    }

    // el function rkm 4 2no y add Hotel  
    function addNewHotel($HotelData) {
        $row = $this->createRow();
        $row->name = $HotelData['name']; // 2sgl 2sm el Hotel 
        $row->location_id = $HotelData['location_id']; // 2sgl description  el Hotel 
        //$row->city_id = $HotelData['city_id']; // 2sgl image el Hotel 
        $row->save(); // 2amr add elly byst5mo the zend
    }
    // Full texts 	id 	name 	location 	city_id 
    //el function el 5 2no y3ml edit fe coutry
    function updataHotel($id,$HotelData) {
       
        $Hotel_Data['name'] = $HotelData['name']; // 23dl 2sm el Hotel 
        $Hotel_Data['location_id'] = $HotelData['location_id']; // 23dl description  el Hotel 
        //$Hotel_Data['city_id'] = $HotelData['city_id']; // 23dl image el Hotel 
        $this->update($Hotel_Data,"id=$id"); // 2amr el update elly byst5dmo el zend
    }
 
}

