<?php
class Aurin_Auth_Acl extends Zend_Acl
{
    function __construct ()
    {
    	
	   $this->add(new Zend_Acl_Resource('read'));
	   $this->add(new Zend_Acl_Resource('write'));
	   $this->add(new Zend_Acl_Resource('admin'));
	
	   $this->addRole(new Zend_Acl_Role('guest'));
	   $this->addRole(new Zend_Acl_Role('user'), 'guest');
	   $this->addRole(new Zend_Acl_Role('administrator'), 'user');
	
	   $this->allow(null, null);
	   $this->deny('guest', 'read');
	   $this->deny('guest', 'write');
	   $this->allow('user','read');
	   $this->allow('user', 'write');
	   $this->allow('administrator', 'admin');
    }
}
?>