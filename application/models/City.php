<?php

class Application_Model_City extends Zend_Db_Table_Abstract {

    protected $_name = 'city';

    // the first function list the all cites (s7)
    function listCity() {
        return $this->fetchAll()->toArray();
    }

    // the second function delete city (s7)
    function deleteCity($id) {

        $this->delete("id=$id");
    }

    // the third function display specific city with its id 
    function cityDetail($id) {

        return $this->find($id)->toArray();
    }

    function getAllCities($country_id) {
        return $this->fetchAll("country_id=$country_id")->toArray();
    }

    // el function rkm 4 2no y add city 
    function addNewcity($cityData) {
        $row = $this->createRow();
        $row->name = $cityData['name']; // 2sgl 2sm el city
        $row->description = $cityData['description']; // 2sgl description  el city
        $row->longitude = $cityData['longitude']; // 2sgl image el city
        $row->latitude = $cityData['latitude']; // 2sgl image el city 
        $row->image = $cityData['image']; // 2sgl image el city
        $row->country_id = $cityData['country_id']; // 2sgl image el city
        $row->save(); // 2amr add elly byst5mo the zend
        // database colum 	id 	name 	description 	longitude 	latitude 	image 	country_id 
    }

    //el function el 5 2no y3ml edit fe city
    function updataCity($id,$cityData) {

        $city_Data['name'] = $cityData['name']; // 23dl 2sm el city
        $city_Data['description'] = $cityData['description']; // 23dl description  el city
        $city_Data['longitude'] = $cityData['longitude']; // 23dl longitude el city
        $city_Data['latitude'] = $cityData['latitude']; // 23dl latitude el city
        $city_Data['image'] = $cityData['image']; // 23dl image el city
        $city_Data['country_id'] = $cityData['country_id']; // 23dl image el city
        $this->update($city_Data,"id=$id"); // 2amr el update elly byst5dmo el zend
    }

}
