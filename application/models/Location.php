<?php

class Application_Model_Location extends Zend_Db_Table_Abstract {

    protected $_name = 'location';

    // the first function list the all countries 
    function listLocation() {
        return $this->fetchAll()->toArray();
    }

    // the second function delete country 
    function deleteLocation($id) {
        $this->delete("id=$id");
    }

    // the third function display specific country with its id 
    function locationDetail($id) {
        return $this->find($id)->toArray();
    }
    
    
     function getAllLocations($city_id) {
        return $this->fetchAll("city_id=$city_id")->toArray();
    }

    // el function rkm 4 2no y add country 
    function addNewlocation($locationData) {
        $row = $this->createRow();
        $row->name = $locationData['name']; // 2sgl 2sm el country
        $row->city_id = $locationData['city_id']; // 2sgl description  el country
        $row->image = $locationData['image']; // 2sgl image el country
        $row->save(); // 2amr add elly byst5mo the zend
    }
    
    //  Full texts 	id 	city_id 	name 	image 

    //el function el 5 2no y3ml edit fe coutry
    function updataLocation($id, $locationData) {

        $location_Data['name'] = $locationData['name']; // 23dl 2sm el country
        $location_Data['city_id'] = $locationData['city_id']; // 23dl description  el country
        $location_Data['image'] = $locationData['image']; // 23dl image el country
        $this->update($location_Data, "id=$id"); // 2amr el update elly byst5dmo el zend
    }

}
