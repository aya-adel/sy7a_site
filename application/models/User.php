<?php

// id 	name 	email 	password 	is_enable 	tel 	gender 
class Application_Model_User extends Zend_Db_Table_Abstract {
    protected $_name = 'user';
    function listUsers() {
        return $this->fetchAll()->toArray();
    }
    function showUser($uid) {
        return $this->find($uid)->toArray();
    }
    function deleteUser($uid) {
        $this->delete("id=$uid");
    }
    function addNewUser($userData){
        $row = $this->createRow();
        $row->name = $userData['name'];
        $row->email = $userData['email'];
        $row->password = $userData['password'];
        $row->tel = $userData['tel'];
        $row->gender = $userData['gender'];
        $row->image = $userData['image'];
        $row->save();
    }

    function updateUser($data) {
        $my_data['name'] = $data['name'];
        //$my_data['email'] = $data['email'];
        $my_data['password'] = $data['password'];
        $my_data['tel'] = $data['tel'];
        $my_data['gender'] = $data['gender'];
        $my_data['image'] = $data['image'];
        $id = $data['id'];
        $this->update($my_data, "id=$id");
    }
    
    function blockUser($uid) {
        $my_date['is_enable'] = 0 ;
        $this->update($my_date, "id=$uid");
    }
        
    function activaetUser($uid) {
        $my_date['is_enable'] = 1 ;
        $this->update($my_date, "id=$uid");
    }
}
