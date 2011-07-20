<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAurin(){
		Zend_Loader_Autoloader::getInstance()->registerNamespace('Aurin_');
	}
	
	protected function _initAuth()
    {
      $this->bootstrap('frontController');
      $auth = Zend_Auth::getInstance();
      $acl = new Aurin_Auth_Acl();
      $this->getResource('frontController')->registerPlugin(new Aurin_Auth_AccessControl($auth, $acl))->setParam('auth', $auth);
    }


}

