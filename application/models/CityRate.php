<?php

/*
  +---------+---------+------+-----+---------+----------------+
  | Field   | Type    | Null | Key | Default | Extra          |
  +---------+---------+------+-----+---------+----------------+
  | id      | int(11) | NO   | PRI | NULL    | auto_increment |
  | city_id | int(11) | NO   | MUL | NULL    |                |
  | user_id | int(11) | NO   | MUL | NULL    |                |
  | rate    | int(11) | NO   |     | NULL    |                |
  +---------+---------+------+-----+---------+----------------+

 */

class Application_Model_CityRate extends Zend_Db_Table_Abstract {

    protected $_name = 'city_rate';

    function addrate($user_id, $city_id, $rate) {

        $row = $this->createRow();
        $row['city_id'] = $city_id;
        $row['user_id'] = $user_id;
        $row['rate'] = $rate;
        $row->save();
    }
    function check($user_id, $city_id) {
        return $this->fetchRow("user_id = $user_id and city_id = $city_id");
    }
    function updaterate($id, $newrate) {
        $new_rate['rate'] = $newrate;
        $this->update($new_rate, "id=$id");
    }
    function listallrates() {
        return $this->fetchAll()->toArray();
    }
    function calcRate($city_id) {
        $db = Zend_Db_Table::getDefaultAdapter();
        $checkquery = $db->select()
                ->from("city_rate", array("avg" => "avg(rate)"))
                ->where("city_id = ?", $city_id);
        $checkrequest = $db->fetchRow($checkquery);
        return $checkrequest["avg"];
    }
    function calchighRate() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $checkquery = $db->select()
                ->from("city_rate", array("city_id" => "city_id","avg" => "avg(rate)"))
                ->group("city_id")
                ->order("rate desc")
                ->limit(6);
        $checkrequest = $db->fetchAll($checkquery);
        return $checkrequest;
    }
    

}
