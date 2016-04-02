<?php

class Application_Model_ResCar extends Zend_Db_Table_Abstract
{

    //set table name which represented by this model 
    protected $_name = 'res_car';
    
     
    function listall()
    {
         return $this->fetchAll()->toArray();
    }
    
   function deletereservation($id)
   {
      $this->delete("id=$id");
   }
   
    function addNewRes($resData)
   {
        //var_dump($resData);exit;
        $row = $this->createRow();
        $row->car_id = $resData['car_id'];
        $row->user_id = $resData['user_id'];
        $row->start = $resData['start'];
        $row->end = $resData['end'];
        $row->save();
   }
   
    
}

