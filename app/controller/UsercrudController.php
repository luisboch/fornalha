<?php

require_once 'AdminBase.php';
require_once APP_DIR . 'service/UserService.php';

/**
 * Description of UserCrudController
 *
 * @author luis
 */
class UsercrudController extends AdminBase {

    /**
     *
     * @var UserService
     */
    private $service;

    public function initialize() {

        parent::initialize();

        $this->action = "Usuários";

        $this->service = new UserService();
    }

    public function indexAction() {
        
    }

    public function editAction($id = null) {
        if ($id == null) {
            $user = new User();
        } else {
            $user = $this->service->findById($id);
            if ($user === null) {
                $this->dispatcher->forward(array('controller' => 'error', 'action' => 'show404'));
                return;
            } else if($this->request->getQuery('saved') == 'true'){
                $this->flashSession->success('Usuário salvo com sucesso');
            }
        }

        if ($this->request->isPost()) {

            $user->setName($this->request->getPost("name"));
            $user->setEmail($this->request->getPost("email"));
            $user->setCpf($this->request->getPost("cpf"));
            $user->setPassword($this->request->getPost("passwd1"));
            $user->setId($this->request->getPost("id"));
            
            if ($this->request->getPost("passwd1") !== $this->request->getPost("passwd2")) {
                $this->flashSession->error('As duas senhas devem ser iguais');
            } else {
                $this->saveOrUpdate($user);
            }
        }

        $this->view->user = $user;
    }

    private function saveOrUpdate($user) {

        $this->view->user = $user;

        try {
            if ($user->getId() == '') {
                $this->service->save($user);
                $this->response->redirect('usercrud/edit/' . $user->getId().'?saved=true');
                return false;
            } else {
                $this->service->update($user);
                $this->flashSession->success('Usuário atualizado com sucesso');
            }
        } catch (ValidationException $ex) {
            foreach ($ex->getErrors() as $err) {
                $this->flashSession->error($err->getMessage());
            }
        } catch (Exception $ex) {
            $this->showError($ex);
        }
    }

}
