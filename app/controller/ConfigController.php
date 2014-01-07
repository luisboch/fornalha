<?php
require_once 'AdminBase.php';

/**
 * Description of AdminClass
 *
 * @author luis
 */
class ConfigController extends AdminBase {
    public function initialize() {
        parent::initialize();
        $this->view->action = "Configuração";
    }
    
    public function indexAction() {
        
    }
}
