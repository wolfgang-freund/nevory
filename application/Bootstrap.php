<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function _initAurin(){
		Zend_Loader_Autoloader::getInstance()->registerNamespace('Aurin_');
	}


}

