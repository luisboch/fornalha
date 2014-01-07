<?php

require_once 'AdminBase.php';

/**
 * Description of UserCrudController
 *
 * @author luis
 */
class UsercrudController extends AdminBase{
    
    public function initialize() {
        parent::initialize();
        $this->action = "Usuários";
    }
    
    public function indexAction() {
        
    }
    
    public function editAction() {
        
    }
}
