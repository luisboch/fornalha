<?php
require_once 'BasicDAO.php';
require_once APP_DIR . 'entity/State.php';
/**
 * Description of StateClass
 *
 * @author luis
 * @since Jan 10, 2014
 */
class StateDAO extends BasicDAO{
    function __construct() {
        parent::__construct('State');
    }
    
    public function findAll() {
        return $this->find(array(), "name");
    }

    public function search($filters = array(), $activeOnly = NULL, $limit = NULL, $offset = NULL) {
        throw new Exception('Not implemented yet!');
    }

    public function searchCount($filters = array(), $activeOnly = NULL) {
        throw new Exception('Not implemented yet!');
    }


}
