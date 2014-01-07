<?php
require_once 'BaseController.php';

/**
 * Description of ErrorController
 *
 * @author luis
 */
class ErrorController extends BaseController{
    public function initialize() {
        parent::initialize();
        $this->view->action = "404";
    }
    public function show404Action() {
        $this->response->setStatusCode(404, "Not Found");
    }
}
