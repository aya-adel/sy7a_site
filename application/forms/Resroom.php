<?php

class Application_Form_Resroom extends Zend_Form
{

    public function init()
    {

         /* Form Elements & Other  Here ... */
        $documentType = new Zend_View_Helper_Doctype();
        $documentType->doctype('HTML5');
        
        $this->setMethod('POST');
        
        $this->setAttrib('class','form-horizontal');
        
        $room_id= new Zend_Form_Element_Select('room_id');
	$room_id->setLabel('RoomId');
	$room_id->setAttrib('class','form-control');
        $room_id->setAttrib('id','room');
        $room_obj=new  Application_Model_Room();
        $all_room=$room_obj->listRoom();
          foreach($all_room as $key=>$value)
		$room_id->addMultiOption($value['id'],$value['id']." ".$value['type']);
        
       
        
        
        $user_id= new Zend_Form_Element_Select('user_id');
	$user_id->setLabel('UserID');
	$user_id->setAttrib('class','form-control');
        $user_id->setAttrib('id','user');
         $user_obj=new Application_Model_User();
        $all_user=$user_obj-> listUsers();
        foreach($all_user as $key=>$value)
		$user_id->addMultiOption($value['id'],$value['name']);
        
        
        $start= new Zend_Form_Element_Text('start');
        $start->setLabel('start');
        $start->setAttrib("type", "date");
	$start->setAttrib('class','form-control');
        
        
        
        
        $end= new Zend_Form_Element_Text('end');
        $end->setAttrib("type","date");
	$end->setLabel('end');
	$end->setAttrib('class','form-control');
   
      
	$sumbit=new Zend_Form_Element_Submit('submit');
	$sumbit->setvalue("Save");
	$sumbit->setAttrib('class','btn btn-success');

        $show=new Zend_Form_Element_Button('show');
	$show->setvalue("show");
	$show->setAttrib('class','btn btn-success');
    

        
	//add reset button
	$reset=new Zend_Form_Element_Reset('Reset');
	$reset->setvalue("Reset");
	$reset->setAttrib('class','btn btn-danger');

        
$this->addElements(array(
			
			$room_id,
                        $user_id,
                        $start,
                        $end,
                        $sumbit,
                        $show,
			$reset
));
        
    }


}

