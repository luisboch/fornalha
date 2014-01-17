<?php

require_once 'BasicDAO.php';
require_once APP_DIR . 'entity/Company.php';

/**
 * Description of CompanyDAO
 *
 * @author luis
 * @since Jan 16, 2014
 */
class CompanyDAO extends BasicDAO {

    function __construct() {
        parent::__construct('Company');
    }

    public function getCompany() {
        return $this->findById(1);
    }
    
    public function search($filters = array(), $activeOnly = NULL, $limit = NULL, $offset = NULL) {
        throw new Exception('Not implemented yet!');
    }

    public function searchCount($filters = array(), $activeOnly = NULL) {
        throw new Exception('Not implemented yet!');
    }

}
