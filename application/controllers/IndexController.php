<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
       //hier kommt der Code rein
    }

    public function indexAction()
    {
        $form = new Aurin_Form_Login();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                // do something here to log in
            }
        }
        $this->view->form = $form;
    }


}
