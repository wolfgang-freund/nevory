<?php

class Aurin_Auth_AccessControl extends Zend_Controller_Plugin_Abstract
{
    public function __construct(Zend_Auth $auth, Zend_Acl $acl)
    {
    	$this->_auth = $auth;
    	$this->_acl = $acl;
    }
    
	public function routeStartup(Zend_Controller_Request_Abstract $request)
    {
      if (!$this->_auth->hasIdentity() && null !== $request->getPost('username') && null !== $request->getPost('password')) {
      $filter = new Zend_Filter_StripTags();
      $username = $filter->filter($request->getPost('username'));
      $password = $filter->filter($request->getPost('password'));
        if (empty($username)) {
        $message = 'Bitte Benutzernamen angeben.';
        }
        elseif (empty($password)) {
        $message = 'Bitte Passwort angeben.';
        }
        else
        {
          $authAdapter = new Aurin_Auth_Adapter();
          $authAdapter->setIdentity($username);
          $authAdapter->setCredential($password);
          $result = $this->_auth->authenticate($authAdapter);
          if (!$result->isValid()) {
            $messages = $result->getMessages();
            $message = $messages[0];
          } else {
            $storage = $this->_auth->getStorage();
            $storage->write($authAdapter->getResultRowObject(null, 'password'));
          }
        }

        if (isset($message)) {
          $view = Zend_Controller_Action_HelperBroker::getExistingHelper("ViewRenderer")->view;
          $view->message = $message;
        }
      }
    }
    
	public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
      if ($this->_auth->hasIdentity() &&is_object($this->_auth->getIdentity())) {
        $role = $this->_auth->getIdentity()->role;
      } else {
        $role = 'guest';
      }

      $controller = $request->getControllerName();
      $resource = $controller;
      //Für Module:
      /*$module = $request->getModuleName();
        $resource = $module;*/
      if (!$this->_acl->has($resource)) {
        $resource = null;
      }
      if (!($this->_acl->isAllowed($role, $resource))) {
          if ($this->_auth->hasIdentity()) {
          // angemeldet, aber keine Rechte -> Fehler!
          $request->setModuleName('default');
          $request->setControllerName('error');
          $request->setActionName('noaccess');
        } else {
          //nicht angemeldet -> Login
          $request->setModuleName('default');
          $request->setControllerName('index');
          $request->setActionName('index');
        }
      }
    }
}
?>