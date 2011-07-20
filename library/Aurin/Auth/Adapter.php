<?php

class Aurin_Auth_Adapter extends Zend_Auth_Adapter_DbTable
{
    public function __construct ()
    {
        $registry = Zend_Registry::getInstance();
    	parent::__construct($registry->dbAdapter);
    	$this->setTableName('users');
    	$this->setIdentityColumn('username');
  		$this->setCredentialColumn('password');
  		$this->setCredentialTreatment('SHA1(CONCAT(?,salt))');
    }
}
?>