<?php

require_once 'BasicDAO.php';
require_once APP_DIR . 'entity/NewsLetter.php';

/**
 * Description of ContactDAO
 *
 * @author luis
 */
class NewsLetterDAO extends BasicDAO{
    public function __construct() {
        parent::__construct('Contact');
    }
    
    public function search($filters = array(), $activeOnly = NULL, $limit = NULL, $offset = NULL) {
        throw new Exception('Not implemented yet!');
    }

    public function searchCount($filters = array(), $activeOnly = NULL) {
        throw new Exception('Not implemented yet!');
    }

}
