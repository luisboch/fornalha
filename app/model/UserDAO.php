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
        parent::__construct();
    }
    
    public function findById($id) {
        return $this->em->find("User", $id);
    }
}
