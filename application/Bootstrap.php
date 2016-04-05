<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initSession() {
        Zend_Session::start();
        $session = new Zend_Session_Namespace
                ('Zend_Auth');
        $session->setExpirationSeconds(1800);
    }

    protected function _initViewHelpers() {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
        $view->jQuery()->addStylesheet('/js/jquery-ui-1.11.4/jquery-ui.min.css')
                ->setLocalPath('/js/jquery-ui-1.11.4/jquery.js')
                ->setUiLocalPath('/js/jquery-ui-1.11.4/jquery-ui.js');
    }

}
