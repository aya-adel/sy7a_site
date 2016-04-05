<?php

class Application_Form_Post extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $this->setAttrib('class','form-horizontal');
        $id = new Zend_Form_Element_Hidden('id');
        $city_id = new Zend_Form_Element_Hidden('city_id');
        $city_id->addValidator(new Zend_Validate_Digits(), true);
        //$city_id -> setLabel ('city id: ');
        $city_id ->setAttribs(array(
        			'placeholder'=>'city_id',
        			'class'=>'form-control'
        			));
        $user_id = new Zend_Form_Element_Hidden('user_id');
        $user_id->addValidator(new Zend_Validate_Digits(), true);
        //$user_id -> setLabel ('user id: ');
        $user_id ->setAttribs(array(
        			'placeholder'=>'user_id',
        			'class'=>'form-control'
        			));
        $content = new Zend_Form_Element_Textarea('content');
        $content -> setLabel ('New Post Content: ');
        $content ->setAttribs(array(
        			'placeholder'=>'Content',
        			'class'=>'form-control',
                                'cols' => '10',
                                'rows' => '10'
        			)); 
        $submit = new Zend_Form_Element_Submit('Post');
        $submit->setAttrib('class', 'btn btn-success');
        $reset = new Zend_Form_Element_Reset('Reset');
        $reset->setAttrib('class', 'btn btn-danger');
        
        $this->addElements(
                array(
                        $id,
                        $city_id,
                        $user_id,
                        $content,
                        $submit,
                        $reset
                    )
                );
    }


}

