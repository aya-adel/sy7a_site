<?php

class Application_Model_Room  extends Zend_Db_Table_Abstract
{
    
    
    protected $_name = 'room';
 // the first function list the all Room
    function listRoom() {
        return $this->fetchAll()->toArray();
    }

    // the second function delete Hotel 
    function deleteRoom($id) {
        $this->delete("id=$id");
    }

    // the third function display specific Hotel with its id 
    function roomDetail($id) {
        return $this->find($id)->toArray();
    }
    
    
    function getAllRooms($hotel_id) {
        return $this->fetchAll("hotel_id=$hotel_id")->toArray();
    }

    // el function rkm 4 2no y add Hotel  
    function addNewRoom($RoomData) {
        $row = $this->createRow();
        $row->type = $RoomData['type']; // 2sgl 2sm el Hotel 
        $row->price = $RoomData['price']; // 2sgl description  el Hotel 
        $row->hotel_id = $RoomData['hotel_id']; // 2sgl image el Hotel 
        $row->save(); // 2amr add elly byst5mo the zend
    }
    // Full texts 	id 	type 	price 	hotel_id 
    //el function el 5 2no y3ml edit fe coutry
    function updataHotel($id,$RoomData) {
       
        $Room_Data['type'] = $RoomData['type']; // 23dl 2sm el Hotel 
         $Room_Data['price'] = $RoomData['price']; // 23dl description  el Hotel 
        $Room_Data['hotel_id'] = $RoomData['hotel_id']; // 23dl image el Hotel 
        $this->update($Room_Data,"id=$id"); // 2amr el update elly byst5dmo el zend
    }
 

}

