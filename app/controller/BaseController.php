<?php

require_once SERVICE_DIR.'SessionManager.php';

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

}
