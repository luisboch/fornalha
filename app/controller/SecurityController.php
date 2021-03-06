<?php

require_once 'OpenBase.php';
require_once APP_DIR . 'service/UserService.php';

class SecurityController extends OpenBase {

    /**
     * @var UserService
     */
    private $service;

    public function initialize() {
        parent::initialize();
        $this->view->action = "Segurança";
        $this->service = new UserService();
        $this->setTitle('Segurança');
    }

    public function loginAction($target = '') {
        try {
            $this->view->targetUrl = $target;
            if ($this->request->isPost()) {
                if ($this->security->checkToken()) {
                    $email = $this->request->getPost('email');
                    $passwd = $this->request->getPost('password');

                    $user = $this->service->findByEmail($email);

                    if ($user != null && $this->security->checkHash($passwd, $user->getPassword())) {
                        $this->session->setUser($user);
                        $user->setLastAccess(new DateTime());
                        $this->service->update($user);
                        $this->response->redirect('admin');
                    } else {
                        $this->error("Email/Senha inválido(s)");
                        $this->session->setUser(null);
                    }
                } else {
                    $this->error("A pagina expirou, tente novamente!");
                }
            }
            
            $this->view->tokenKey = $this->security->getTokenKey();
            $this->view->tokenValue = $this->security->getToken();
        } catch (Exception $ex) {
            $this->showError($ex);
        }
    }

    public function logoutAction() {
        $this->session->setUser(null);
        $this->response->redirect("security/login");
    }

}
