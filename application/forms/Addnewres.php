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
        $room_id= new Zend_Form_Element_Hidden('room_id');
	
        
        $user_id= new Zend_Form_Element_Hidden('user_id');
	
       
      
//        $hotel_name = new Zend_Form_Element_Select('hotel_name');
//
//        $hotel_name->setLabel('The hotels name  ');
//
//        $hotel_name->setAttribs(array(
//            'class' => 'form-control' // dah 3shan el bootstrap bt3y 3ml 2zay 27ot 3leh el class
//        ));
//        $hotel_obj = new Application_Model_Hotel();
//    	$all_hotels= $hotel_obj->getAllHotels(1);
//    	foreach ($all_hotels as $key=>$value)
//    	{
//    		$hotel_name->addMultiOption($value['id'],$value['name']);
//    	}
//        
//        
        
        
        
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
//     $hotel_name ,
                        $start,
                        $end,
			$sumbit,
			$reset
));
        }


}

