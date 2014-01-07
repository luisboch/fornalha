<?php
require_once 'BaseController.php';

/**
 * Description of MapController
 *
 * @author luis
 */
class MapController extends BaseController {
    public function initialize() {
        parent::initialize();
        $this->view->action = "Mapa";
    }
    public function indexAction() {
    }
}
