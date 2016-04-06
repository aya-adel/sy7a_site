<?php

/*
    desc country_rate;
   +------------+---------+------+-----+---------+----------------+
   | Field      | Type    | Null | Key | Default | Extra          |
   +------------+---------+------+-----+---------+----------------+
   | id         | int(11) | NO   | PRI | NULL    | auto_increment |
   | country_id | int(11) | NO   | MUL | NULL    |                |
   | user_id    | int(11) | NO   | MUL | NULL    |                |
   | rate       | int(11) | NO   |     | NULL    |                |
   +------------+---------+------+-----+---------+----------------+
   4 rows in set (0.15 sec)

  */
class Application_Model_CountryRate extends Zend_Db_Table_Abstract
{
    
     protected $_name = 'country_rate';

    function addrate($user_id, $country_id, $rate) {

        $row = $this->createRow();
        $row['country_id'] = $country_id;
        $row['user_id'] = $user_id;
        $row['rate'] = $rate;
        $row->save();
    }
    function check($user_id, $country_id) {
        return $this->fetchRow("user_id = $user_id and country_id = $country_id");
    }
    function updaterate($id, $newrate) {
        $new_rate['rate'] = $newrate;
        $this->update($new_rate, "id=$id");
    }
    function listallrates() {
        return $this->fetchAll()->toArray();
    }
    function calcRate($country_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        $checkquery = $db->select()
                ->from("country_rate", array("avg" => "avg(rate)"))
                ->where("country_id = ?", $country_id);
        $checkrequest = $db->fetchRow($checkquery);
        return $checkrequest["avg"];
    }
    function calchighRate() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $checkquery = $db->select()
                ->from("country_rate", array("country_id" => "country_id","avg" => "avg(rate)"))
                ->group("country_id")
                ->order("rate desc")
                ->limit(6);
        $checkrequest = $db->fetchAll($checkquery);
        return $checkrequest;
    }
    

    
}

