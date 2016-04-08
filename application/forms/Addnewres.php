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
        $user_id= new Zend_Form_Element_Hidden('user_id');
	$hotel_name = new Zend_Form_Element_Text('hotelname');
        $hotel_name->setAttrib("id", "name");
        $hotel_name->setAttrib("class", "form-control");
        $hotel_name->setAttrib("placeholder", "enter hotel name");
        
        $start= new Zend_Form_Element_Text('start');
        $start->setAttrib('class','form-control');
        $end= new Zend_Form_Element_Text('end');
        $end->setAttrib("type","datetime-local");
	$end->setLabel('end');
	$end->setAttrib('class','form-control');
       // $email = $this->getEmailField();
        //add submit button
	$sumbit=new Zend_Form_Element_Button('Search');
	$sumbit->setAttrib('class','btn btn-success form-control');
        $sumbit->setAttrib('id','btn');


	//add reset button
	$reset=new Zend_Form_Element_Reset('Reset');
	$reset->setvalue("Reset");
	$reset->setAttrib('class','btn btn-danger');

        
$this->addElements(array(
			
                        $user_id,
                        $hotel_name,
                        $start,
                        $end,
			$sumbit,
			$reset
));
        }


}

