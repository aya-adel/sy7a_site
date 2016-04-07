<?php
// id 	name 	email 	password
//  	is_enable 	tel 	gender 

class Application_Form_SignUp extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        
        $this->setMethod('POST');
        $id = new Zend_Form_Element_Hidden('id');
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Your Name: ');
        $name->setAttribs(Array(
            'placeholder' => 'Example: Mohamed',
            'class' => 'form-control'
        ));
        $name->setRequired();
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email Address');
        $email->setAttribs(Array(
            'placeholder' => 'Example: Ali@yahoo.com',
            'class' => 'form-control'
        ));
        $email->setRequired();
        $db = Zend_Db_Table::getDefaultAdapter();
        $validator = new Zend_Validate_Db_NoRecordExists(
                array(
                    'table' => 'user',
                    'field' => 'email',
                    'adapter' => $db
                )
        );
        $email->addValidator('EmailAddress', TRUE);
        $email->addValidator($validator,TRUE);
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password: ');
        $password->setAttribs(Array(
            'class' => 'form-control'
        ));
        $password->setRequired();
        $confirm = new Zend_Form_Element_Password('confirm');
        $confirm->setLabel('Retype-Password: ');
        $confirm->setAttribs(Array(
            'class' => 'form-control'
        ));
        $confirm->setRequired();
        $v = new Zend_Validate_Identical("password");
        $confirm->addValidator($v);
        $gender = new Zend_Form_Element_Select('gender');
        $gender->setRequired();
        $gender->addMultiOption('male', 'Male')->
                addMultiOption('female', 'Female')->
                addMultiOption('non', 'Prefer not to mention');
        $gender->setAttrib('class', 'form-control');
        $tel = new Zend_Form_Element_Text('tel');
        $tel->setLabel('Tel Number : ');
        $tel->setAttrib('class', 'form-control');
         $image = new Zend_Form_Element_File('image');
        $image->setLabel('Upload an image:');
        $image->addValidator('Count', false, 1);
        $image->addValidator('Extension',false, 'jpg,jpeg,png,gif');

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
            $email,
            $password,
            $confirm,
            $gender,
            $tel,
             $image,
            $submit,
            $reset
        ));
        
        
    }


}

