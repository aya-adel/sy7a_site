<?php

class Application_Form_Location extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

        
    //id 	city_id 	name 	image   
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
$name->setLabel('The Location Name: ');
// h7ot attribut l fnmae in feha placeholder + class mo7dd 
$name->setAttribs(array(
'placeholder' => 'example: EGYPT',
 'class' => 'form-control' // dah 3shan el bootstrap bt3y 3ml 2zay 27ot 3leh el class
));
//$name->addValidator('db_NoRecordExists', true, array('country', 'name'));// field dah 2sm msh bytkrr lw mwgod fe database 



//// image
//$image = new Zend_Form_Element_Text('image');
//// h7ot label el label dah 2bal el 5ana elly feha el text field 
//$image->setLabel('The image of the country: ');
//// h7ot attribut l fnmae in feha placeholder + class mo7dd 
//$image->setAttribs(array(
//'class' => 'form-control' // dah 3shan el bootstrap bt3y 3ml 2zay 27ot 3leh el class
//));

$image = new Zend_Form_Element_File('image');
        $image->setLabel('Upload an image:');
        $image->addValidator('Count', false, 1);
        $image->addValidator('Extension',false, 'jpg,jpeg,png,gif');


 // city_id
        $city_id = new Zend_Form_Element_Select('city_id');
// h7ot label el label dah 2bal el 5ana elly feha el text field 
        $city_id->setLabel('The name of the city: ');
// h7ot attribut l fnmae in feha placeholder + class mo7dd 
        $city_id->setAttribs(array(
            'class' => 'form-control' // dah 3shan el bootstrap bt3y 3ml 2zay 27ot 3leh el class
        ));
        $city_obj = new Application_Model_City();
    	$all_cities= $city_obj->listCity();
    	foreach ($all_cities as $key=>$value)
    	{
    		$city_id->addMultiOption($value['id'],$value['name']);
    	}


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
    		$city_id,
    		$image,
                $submit,
    		$reset
    		));

    }


}

