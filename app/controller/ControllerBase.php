<?php

require_once SERVICE_DIR . 'SessionManager.php';
require_once SERVICE_DIR . 'Config.php';
require_once APP_DIR . 'model/BasicDAO.php';

// Include helpers
require_once APP_DIR . 'components/volt/helpers.php';

/**
 * Description of BaseController
 * @author luis
 */
class ControllerBase extends \Phalcon\Mvc\Controller {

    /**
     *
     * @var Phalcon\Logger\Adapter\File
     */
    protected $logger;

    /**
     * @var SessionManager
     */
    protected $session;

    /**
     * @var Config
     */
    protected $config;

    public function initialize() {

        // Start session
        $this->session = SessionManager::getInstance();

        $this->view->title = "";

        $this->view->_session = $this->session;

        $this->config = Config::getInstance();

        $this->view->currentController = $this->dispatcher->getControllerName();

        $this->logger = new Phalcon\Logger\Adapter\File(ROOT_DIR . 'logs/app.log');
    }

    protected function setTitle($title) {
        $this->view->title = $title;
    }

    protected function showError($ex) {
        $this->dispatcher->setParams(array('exception' => $ex));
        $this->dispatcher->forward(array(
            'controller' => 'error',
            'action' => 'exception'));
    }

    /**
     * Dispath the request to another action.
     * 
     * @param string $controller
     * @param string $action
     * @param array $params
     */
    public function dispatch($controller, $action, $params = NULL) {

        $this->dispatcher->setParams($params);

        if ($params !== NULL && is_array($params)) {
            $this->dispatcher->setParams($params);
        }
        $this->dispatcher->forward(array(
            'controller' => $controller,
            'action' => $action));
    }

    /**
     * Dispath the request to another action.
     * 
     * @param string $page can be "controller/action"
     */
    public function redirect($page) {
        $this->response->redirect($page);
    }

    protected function info($message) {
        $this->session->getMessage()->info($message);
    }

    protected function warn($message) {
        $this->session->getMessage()->warn($message);
    }

    protected function success($message) {
        $this->session->getMessage()->success($message);
    }

    protected function error($message) {
        $this->session->getMessage()->error($message);
    }

    public function hashAction($ap) {
        die($this->security->hash($ap));
    }

}
