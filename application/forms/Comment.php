<?php

class Application_Form_Comment extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $this->setAttrib('class','form-horizontal');
        $id = new Zend_Form_Element_Hidden('id');
        $content = new Zend_Form_Element_Text('content');
        $content -> setLabel ('Content: ');
        $content ->setAttribs(array(
        			'placeholder'=>'content',
        			'class'=>'form-control'
        			));
        $post_id = new Zend_Form_Element_Text('post_id');
        $post_id->addValidator(new Zend_Validate_Digits(), true);
        $post_id -> setLabel ('post id: ');
        $post_id ->setAttribs(array(
        			'placeholder'=>'post_id',
        			'class'=>'form-control'
        			));
        $submit = new Zend_Form_Element_Submit('Comment');
        $submit->setAttrib('class', 'btn btn-success');
        
        $reset = new Zend_Form_Element_Reset('Reset');
        $reset->setAttrib('class', 'btn btn-danger');
        
        $this->addElements(array($id,$content,$post_id,$submit,$reset));
    }


}

