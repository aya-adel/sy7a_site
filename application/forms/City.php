<?php

class Application_Form_City extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
        //  <FORM method="post" class="form-horizontal "> 2wal 7aga lzm 23rf 2n deh form w 2dlha el attributs elly btmzha 
        $this->setMethod('POST');
        $this->setAttrib('class', 'form-horizontal');
        /* Form Elements & Other Definitions Here ... */
// the id note the id hidden s o put it hidden 3shan 2msko w 23ml 3leh el code 
//  id
        $id = new Zend_Form_Element_Hidden('id');
//  name
        $name = new Zend_Form_Element_Text('name');
// h7ot label el label dah 2bal el 5ana elly feha el text field 
        $name->setLabel('The Name of the country: ');
// h7ot attribut l fnmae in feha placeholder + class mo7dd 
        $name->setAttribs(array(
            'placeholder' => 'example: EGYPT',
            'class' => 'form-control' // dah 3shan el bootstrap bt3y 3ml 2zay 27ot 3leh el class
        ));
// $name->addValidator('db_NoRecordExists', true, array('country', 'name'));// field dah 2sm msh bytkrr lw mwgod fe database 
//  description
        $description = new Zend_Form_Element_Text('description');
// h7ot label el label dah 2bal el 5ana elly feha el text field 
        $description->setLabel('The description of the country: ');
// h7ot attribut l fnmae in feha placeholder + class mo7dd 
        $description->setAttribs(array(
            'class' => 'form-control' // dah 3shan el bootstrap bt3y 3ml 2zay 27ot 3leh el class
        ));
// image
        $image = new Zend_Form_Element_Text('image');
// h7ot label el label dah 2bal el 5ana elly feha el text field 
        $image->setLabel('The image of the country: ');
// h7ot attribut l fnmae in feha placeholder + class mo7dd 
        $image->setAttribs(array(
            'class' => 'form-control' // dah 3shan el bootstrap bt3y 3ml 2zay 27ot 3leh el class
        ));

// longitude
        $longitude = new Zend_Form_Element_Text('longitude');
// h7ot label el label dah 2bal el 5ana elly feha el text field 
        $longitude->setLabel('The longitude of the city: ');
// h7ot attribut l fnmae in feha placeholder + class mo7dd 
        $longitude->setAttribs(array(
            'class' => 'form-control' // dah 3shan el bootstrap bt3y 3ml 2zay 27ot 3leh el class
        ));

 // latitude
        $latitude = new Zend_Form_Element_Text('latitude');
// h7ot label el label dah 2bal el 5ana elly feha el text field 
        $latitude->setLabel('The latitude of the city: ');
// h7ot attribut l fnmae in feha placeholder + class mo7dd 
        $latitude->setAttribs(array(
            'class' => 'form-control' // dah 3shan el bootstrap bt3y 3ml 2zay 27ot 3leh el class
        ));
        
        
 // country_id
        $country_id = new Zend_Form_Element_Select('country_id');
// h7ot label el label dah 2bal el 5ana elly feha el text field 
        $country_id->setLabel('The country_id of the country: ');
// h7ot attribut l fnmae in feha placeholder + class mo7dd 
        $country_id->setAttribs(array(
            'class' => 'form-control' // dah 3shan el bootstrap bt3y 3ml 2zay 27ot 3leh el class
        ));
        $country_obj = new Application_Model_Country();
    	$all_countriers= $country_obj->listCountry();
    	foreach ($all_countriers as $key=>$value)
    	{
    		$country_id->addMultiOption($value['id'],$value['name']);
    	}
//  	id 	name 	description 	longitude 	latitude 	image 	country_id 
        // submit
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setValue('Save');
        $submit->setAttrib('class', 'btn btn-success');
        //reset
        $reset = new Zend_Form_Element_Reset('reset');
        $reset->setValue('Reset');
        $reset->setAttrib('class', 'btn btn-danger');
        // Add Element to my form
        $this->addElements(array(
            $id,
            $name,
            $description,
            $image,
            $longitude,
            $latitude,
            $country_id,
            $submit,
            $reset
        ));
    }
}
