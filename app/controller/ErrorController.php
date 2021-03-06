<?php

require_once 'OpenBase.php';

/**
 * Description of ErrorController
 *
 * @author luis
 */
class ErrorController extends OpenBase {

    public function initialize() {
        parent::initialize();
        $this->view->setViewsDir('../app/view/');
        $this->setTitle('Erro');
    }

    public function show404Action() {
        $this->response->setStatusCode(404, "Not Found");
    }

    public function exceptionAction() {
        $this->response->setStatusCode(500, "Internal Error");
        $this->view->action = "Error";
        $this->view->exception = $this->dispatcher->getParam('exception');
        if (is_object($this->view->exception) && $this->view->exception instanceof Exception) {
            $this->view->trace = $this->view->exception->getTraceAsString();
            $this->view->message = $this->view->exception->getMessage();
        }
    }

}
