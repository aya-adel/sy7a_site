<?php

class Application_Form_Hotel extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
        /* Form Elements & Other Definitions Here ... */
        //  <FORM method="post" class="form-horizontal "> 2wal 7aga lzm 23rf 2n deh form w 2dlha el attributs elly btmzha 
        $this->setMethod('POST');
        $this->setAttrib('class', 'form-horizontal');
// Full texts 	id 	name 	location 	city_id 

        /* Form Elements & Other Definitions Here ... */
// the id note the id hidden s o put it hidden 3shan 2msko w 23ml 3leh el code 
//  id
        $id = new Zend_Form_Element_Hidden('id');

//  name
        $name = new Zend_Form_Element_Text('name');
// h7ot label el label dah 2bal el 5ana elly feha el text field 
        $name->setLabel('The Name of the hotel: ');
// h7ot attribut l fnmae in feha placeholder + class mo7dd 
        $name->setAttribs(array(
            'placeholder' => 'example: FOURSECCION',
            'class' => 'form-control' // dah 3shan el bootstrap bt3y 3ml 2zay 27ot 3leh el class
        ));



// city_id
$location_id = new Zend_Form_Element_Select('location_id');
// h7ot label el label dah 2bal el 5ana elly feha el text field 
$location_id->setLabel('The location_id of the location: ');
// h7ot attribut l fnmae in feha placeholder + class mo7dd 
$location_id->setAttribs(array(
            'class' => 'form-control' // dah 3shan el bootstrap bt3y 3ml 2zay 27ot 3leh el class
        ));
$location_obj = new Application_Model_Location();
$all_locations= $location_obj->listLocation();
foreach ($all_locations as $key=>$value)
{
        $location_id->addMultiOption($value['id'],$value['name']);
}
	// submit
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setValue('Save');
    	$submit->setAttrib('class', 'btn btn-success');
    	
    	//reset
    	$reset = new Zend_Form_Element_Reset('reset');
    	$reset->setValue('Reset');
    	$reset->setAttrib('class', 'btn btn-danger');


        //reset
        $reset = new Zend_Form_Element_Reset('reset');
        $reset->setValue('Reset');
        $reset->setAttrib('class', 'btn btn-danger');


    	// Add Element to my form
    	$this->addElements(array(
    		$id,
    		$name,
      		$location_id,
               
                $submit,
    		$reset
    		));
    }


}
