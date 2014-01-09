<?php

require_once 'CrudBase.php';
require_once APP_DIR . 'service/UserService.php';

/**
 * Description of UserCrudController
 *
 * @author luis
 * @property UserService $service 
 */
class UsercrudController extends CrudBase {

    public function initialize() {

        parent::initialize(new UserService());

        $this->action = "Usuários";
    }

    public function indexAction() {
        
    }

    /**
     * 
     * @param User $user
     */
    protected function populatePostData($user) {

        $user->setName($this->request->getPost("name"));
        $user->setEmail($this->request->getPost("email"));
        $user->setCpf($this->request->getPost("cpf"));

        $user->setId($this->request->getPost("id"));

        if ($user->getId() == null || $this->request->getPost("passwd1") != '') {
            $user->setPassword($this->security->hash($this->request->getPost("passwd1")));
        }
    }

    /**
     * 
     * @param User $user
     */
    protected function isValid($user) {

        $passwd1 = $this->request->getPost("passwd1");

        $passwd2 = $this->request->getPost("passwd2");

        if ($user->getId() == null || $passwd1 != '') {
            if ($passwd1 !== $passwd2) {
                $this->error('As duas senhas devem ser iguais');
                return FALSE;
            }
        }
        return TRUE;
    }

    protected function createNewInstance() {
        return new User();
    }

}