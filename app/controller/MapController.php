<?php
require_once 'BaseController.php';

/**
 * Description of MapController
 *
 * @author luis
 */
class MapController extends ControllerBase {
    public function initialize() {
        parent::initialize();
        $this->view->action = "Mapa";
    }
    public function indexAction() {
    }
}
