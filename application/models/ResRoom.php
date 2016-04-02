<?php

class Application_Model_ResRoom extends Zend_Db_Table_Abstract
{
    //set table name which represented by this model 
    protected $_name = 'res_room';
    
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
        $row->room_id = $resData['room_id'];
        $row->user_id = $resData['user_id'];
        $row->start = $resData['start'];
        $row->end = $resData['end'];
        $row->save();
   }
   
  
 public function getData($id)
    {
        $select = $this->_db->select()
                        ->from($this->_name,
                                    array('user_id','room_id'))
                        ->where('id = ?','1');
        $result = $this->getAdapter()->fetchAll($select);
        return $result;
    }
   
   }
    



