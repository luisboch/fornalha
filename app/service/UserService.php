<?php

require_once APP_DIR . 'model/UserDAO.php';
require_once 'exceptions/ValidationException.php';

/**
 * Description of UserService
 *
 * @author luis
 * @since Jan 7, 2014
 */
class UserService {

    /**
     * @var UserDAO
     */
    protected $dao;

    function __construct() {
        $this->dao = new UserDAO();
    }

    function save($user) {
        $this->validate($user);
        try {
            // Begin Transaction
            $this->dao->save($user);
            $this->dao->getEntityManager()->flush();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @param User $user
     * @throws Exception
     */
    function update($user) {
        $this->validate($user, false);
        try {
            // Begin Transaction
            $this->dao->update($user);
            $this->dao->getEntityManager()->flush();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @param User $user
     * @param boolean $save
     * @throws InvalidArgumentException
     * @throws ValidationException
     */
    public function validate($user, $save = true) {
        $v = new ValidationException();
        if ($user->getId() == null && !$save) {
            throw new InvalidArgumentException("The object need an id to update");
        } else {
            // Check cpf
            if ($user->getCpf() == '') {
                $v->addError("Por favor insira um CPF válido", 'cpf');
            }

            // Check email
            if ($user->getEmail() == '') {
                $v->addError("Por favor insira um email válido", 'email');
            }

            // Check name
            if ($user->getName() == '') {
                $v->addError("Por favor insira seu nome", 'name');
            }

            // Check password
            if ($user->getPassword() == '') {
                $v->addError("Por favor preencha a senha", 'password');
            }

            if (!$v->isEmtpy()) {
                throw $v;
            }
        }
    }
    
    public function findById($id) {
        return $this->dao->findById($id);
    }

}
