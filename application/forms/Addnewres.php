<?php

class Application_Form_Addnewres extends Zend_Form
{

    public function init()
    {
    /* Form Elements & Other  Here ... */
        $documentType = new Zend_View_Helper_Doctype();
        $documentType->doctype('HTML5');
        
        $this->setMethod('POST');
        
        $this->setAttrib('class','form-horizontal');
        $room_id= new Zend_Form_Element_Text('room_id');
	$room_id->setLabel('RoomId');
	$room_id->setAttrib('class','form-control');
        $room_id->setAttrib('id','room');
        
        $user_id= new Zend_Form_Element_Text('user_id');
	$user_id->setLabel('UserID');
	$user_id->setAttrib('class','form-control');
        $user_id->setAttrib('id','user');
    
        $start= new Zend_Form_Element_Text('start');
        $start->setLabel('start');
        $start->setAttrib("type", "date");
	$start->setAttrib('class','form-control');
        
        
        
        
        $end= new Zend_Form_Element_Text('end');
        $end->setAttrib("type","datetime-local");
	$end->setLabel('end');
	$end->setAttrib('class','form-control');
   
       // $email = $this->getEmailField();
        //add submit button
	$sumbit=new Zend_Form_Element_Button('submit');
	$sumbit->setvalue("Save");
	$sumbit->setAttrib('class','btn btn-success');
        $sumbit->setAttrib('id','btn');


	//add reset button
	$reset=new Zend_Form_Element_Reset('Reset');
	$reset->setvalue("Reset");
	$reset->setAttrib('class','btn btn-danger');

        
$this->addElements(array(
			
			$room_id,
                        $user_id,
                        $start,
                        $end,
    //$email,
			$sumbit,
			$reset
));
        }


}

