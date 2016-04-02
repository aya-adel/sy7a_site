<?php

class Application_Model_Car  extends Zend_Db_Table_Abstract {
   
    protected $_name = 'car';
 // the first function list the all Car
    function listCar() {
        return $this->fetchAll()->toArray();
    }

    // the second function delete Car
    function deleteCar($id) {
        $this->delete("id=$id");
    }

    // the third function display specific Car with its id 
    function carDetail($id) {
        return $this->find($id)->toArray();
    }
    
    
    function getAllCars($city_id) {
        return $this->fetchAll("city_id=$city_id")->toArray();
    }

    // el function rkm 4 2no y add Car  
    function addNewCar($CarData) {
        $row = $this->createRow();
        $row->location= $CarData['location']; // 2sgl 2sm el Hotel 
        $row->price = $CarData['price']; // 2sgl description  el Hotel 
        $row->city_id = $CarData['city_id']; // 2sgl image el Hotel 
        $row->save(); // 2amr add elly byst5mo the zend
    }
    // Full texts 	id 	location 	price 	city_id 
    //el function el 5 2no y3ml edit fe coutry
    function updataCar($id,$CarData) {
       
        $Car_Data['location'] = $CarData['location']; // 23dl 2sm el Hotel 
         $Car_Data['price'] = $CarData['price']; // 23dl description  el Hotel 
        $Car_Data['city_id'] = $CarData['city_id']; // 23dl image el Hotel 
        $this->update($Car_Data,"id=$id"); // 2amr el update elly byst5dmo el zend
    }
 


}

