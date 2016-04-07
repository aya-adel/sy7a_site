<?php

class Application_Model_Country extends Zend_Db_Table_Abstract {

    protected $_name = 'country';

    // the first function list the all countries 
    function listCountry() {
        return $this->fetchAll()->toArray();
    }

    // the second function delete country 
    function deleteCountry($id) {
        $this->delete("id=$id");
    }

    // the third function display specific country with its id 
    function countryDetail($id) {
        return $this->find($id)->toArray();
    }

    // el function rkm 4 2no y add country 
    function addNewcountry($countryData) {
        $row = $this->createRow();
        $row->name = $countryData['name']; // 2sgl 2sm el country
        $row->description = $countryData['description']; // 2sgl description  el country
        $row->image = $countryData['image']; // 2sgl image el country
        $row->save(); // 2amr add elly byst5mo the zend
    }
    
    //el function el 5 2no y3ml edit fe coutry
    function updataCountry($id,$countryData) {
       
        $country_Data['name'] = $countryData['name']; // 23dl 2sm el country
         $country_Data['description'] = $countryData['description']; // 23dl description  el country
         if ($countryData['image']!=""){
        $country_Data['image'] = $countryData['image']; // 23dl image el country
         }
        $this->update($country_Data,"id=$id"); // 2amr el update elly byst5dmo el zend
    }

}
