<?php

class Application_Form_Login extends Zend_Form
{
    public function init()
    {
        $this->setMethod('POST');
        $id = new Zend_Form_Element_Hidden('id');
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Put Your Email Adress : ');
        $email->setAttribs(Array(
            'class' => 'form-control'
        ));
        
        $db = Zend_Db_Table::getDefaultAdapter();
        $validator = new Zend_Validate_Db_RecordExists(
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
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setValue('Add');
    	$submit->setAttrib('class', 'btn btn-success');
    	
    	//reset
    	$reset = new Zend_Form_Element_Reset('reset');
    	$reset->setValue('Reset');
    	$reset->setAttrib('class', 'btn btn-danger');
        
//        $fcbtn = new Zend_Form_Element_Button('fcbtn');
//    	$fcbtn->setName("log in with facebook");
//    	$fcbtn->setAttrib('class', 'btn btn-primary');
//    	
        
        
        
        
        
        $this->addElements(array(
    		$id,
    		$email,
                $password,
    		$submit,
    		$reset,
    		));

    }


}
