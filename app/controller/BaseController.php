<?php

require_once SERVICE_DIR . 'SessionManager.php';

/**
 * Description of BaseController
 *
 * @author luis
 */
class BaseController extends \Phalcon\Mvc\Controller {

    /**
     * @var SessionManager
     */
    protected $session;

    public function initialize() {

        // Start session
        $this->session = SessionManager::getInstance();

        $this->view->title = 'Pizzaria Fornalha Vinhedo';
    }

    protected function showError($ex) {
        $this->dispatcher->setParams(array('exception' => $ex));
        $this->dispatcher->forward(array(
            'controller' => 'error',
            'action' => 'exception'));
    }

}
