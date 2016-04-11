<?php

class Application_Form_Addnewcar extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        /* Form Elements & Other  Here ... */
        $documentType = new Zend_View_Helper_Doctype();
        $documentType->doctype('HTML5');
        
        $this->setMethod('POST');
        
        $this->setAttrib('class','form-horizontal');
     

        
        $city_id= new Zend_Form_Element_Hidden('city_id');
	
        $user_id= new Zend_Form_Element_Hidden('user_id');
	
        
        $start= new Zend_Form_Element_Text('start');
        $start->setLabel('start');
	$start->setAttrib('class','form-control-lg');
        
        
        
        
        $end= new Zend_Form_Element_Text('end');
	$end->setLabel('end');
	$end->setAttrib('class','form-control-lg');
   
       // $email = $this->getEmailField();
        //add submit button
	$sumbit=new Zend_Form_Element_Button('Search');
	$sumbit->setvalue("Save");
	$sumbit->setAttrib('class','btn btn-success form-control');
        $sumbit->setAttrib('id','btn');


	//add reset button
	$reset=new Zend_Form_Element_Reset('Reset');
	$reset->setvalue("Reset");
	$reset->setAttrib('class','btn btn-danger');

        
$this->addElements(array(
			$city_id,
                        $user_id,
                        $start,
                        $end,
			$sumbit,
			$reset
));
        }




}

