<?php

class Application_Form_Ui extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
        $element = new ZendX_JQuery_Form_Element_DatePicker(
                'dp1', array('jQueryParams' => array('defaultDate' => '2007/10/10'))
        );

        $form->setDecorators(array(
            'FormElements',
            array('AccordionContainer', array(
                    'id' => 'tabContainer',
                    'style' => 'width: 600px;',
                    'jQueryParams' => array(
                        'alwaysOpen' => false,
                        'animated' => "easeslide"
                    ),
                )),
            'Form'
        ));
    }

}
