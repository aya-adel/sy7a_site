<?php
class Application_Form_Addnewres extends Zend_Form
{
    public function init()
    {
    /* Form Elements & Other  Here ... */
       // $documentType = new Zend_View_Helper_Doctype();
        //$documentType->doctype('HTML5');
        $this->setMethod('POST');
        $this->setAttrib('class','form-horizontal');
        $user_id= new Zend_Form_Element_Hidden('user_id');
        $city_id= new Zend_Form_Element_Hidden('city_id');
        
	$hotel_name = new Zend_Form_Element_Text('hotelname');
        $hotel_name->setAttrib("id", "name");
        $hotel_name->setAttrib("class", "form-control-lg");
        $hotel_name->setAttrib("placeholder", "enter hotel name");
        $hotel_name->setRequired();
        $start= new Zend_Form_Element_Text('start');
        $start->setAttrib('class','form-control-lg');
        $start->setAttrib("readonly", "readonly");
        $start->setRequired();
        $end= new Zend_Form_Element_Text('end');
        $end->setLabel('end');
	$end->setAttrib('class','form-control-lg');
        $end->setRequired();
        // $email = $this->getEmailField();
        //add submit button
        
        $room_type = new Zend_Form_Element_Select('room_type');
        $room_type->addMultiOption('0',"Please Select Room Type");
        $room_type->addMultiOption('1','Single');
        $room_type->addMultiOption('2','Double');
        $room_type->addMultiOption('3','Three');
        $room_type->addMultiOption('4','Four');
        $room_type->setRequired();
        
        $room_type->setAttrib('class', 'form-control');
        
	$sumbit=new Zend_Form_Element_Button('Search');
	$sumbit->setAttrib('class','btn btn-success form-control');
        $sumbit->setAttrib('id','btn');
	//add reset button
	$reset=new Zend_Form_Element_Reset('Reset');
	$reset->setvalue("Reset");
	$reset->setAttrib('class','btn btn-danger');
        $this->addElements(array(
			
                        $user_id,
                        $city_id,
                        $hotel_name,
                        $start,
                        $end,
                        $room_type,
			$sumbit,
			$reset
            ));
    }
}

