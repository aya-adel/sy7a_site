<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
protected $_name = 'user';

function listUsers()
{
return $this->fetchAll()->toArray();
}

}

