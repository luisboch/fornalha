<?php

require_once 'OpenBase.php';

/**
 * Description of MenuController
 *
 * @author luis
 */
class MenuController extends OpenBase {

    public function initialize() {
        parent::initialize();
        $this->view->action = "Cardápio";
    }

    public function indexAction() {
        
    }

    public function categoryAction($id) {
        $this->view->catId = $id;
    }

}
