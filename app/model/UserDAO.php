<?php

require_once 'BasicDAO.php';
require_once APP_DIR . 'entity/User.php';

/**
 * Description of UserDAO
 *
 * @author luis
 * @since Jan 7, 2014
 */
class UserDAO extends BasicDAO {

    public function __construct() {
        parent::__construct("User");
    }

    public function findById($id) {
        return $this->em->find("User", $id);
    }
    
    /**
     * 
     * @param string $email
     * @return User
     * @throws LogicException
     */
    public function findByEmail($email) {
        $users = $this->find(array('email = ' => $email));
        if (count($users) == 0) {
            return null;
        } else if (count($users) == 1) {
            return $users[0];
        } else {
            throw new LogicException("Found more than one result with email: " . $email);
        }
    }

    /**
     * 
     * @param string $cpf
     * @return User
     * @throws LogicException
     */
    public function findByCPF($cpf) {
        $users = $this->find(array('cpf = ' => $cpf));
        if (count($users) == 0) {
            return null;
        } else if (count($users) == 1) {
            return $users[0];
        } else {
            throw new LogicException("Found more than one result with cpf: " . $cpf);
        }
    }

}
