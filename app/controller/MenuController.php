<?php

require_once 'BaseController.php';

/**
 * Description of MenuController
 *
 * @author luis
 */
class MenuController extends BaseController {

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
