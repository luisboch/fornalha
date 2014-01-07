<?php

require_once 'BaseController.php';

class SecurityController extends BaseController {

    public function initialize() {
        parent::initialize();
        $this->view->action = "Segurança";
    }

    public function loginAction($target = '') {

        $this->view->targetUrl = $target;

        if ($this->request->isPost()) {
            echo "Is Post";
            $this->session->setUser("a");
        }
    }

}
