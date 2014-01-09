<?php

require_once 'AdminBase.php';

/**
 * Description of CrudBase
 *
 * @author luis
 * @since Jan 8, 2014
 */
abstract class CrudBase extends AdminBase {

    private $_initialized = false;
    protected $instance;
    private $controllerName;

    /**
     *
     * @var BasicService
     */
    protected $service;

    public function initialize(BasicService $service) {
        parent::initialize();

        $this->service = $service;
        $this->_initialized = true;
        $this->controllerName = $this->getControllerName();
    }

    private function getControllerName() {
        return strtolower(str_replace('Controller', '', get_class($this)));
    }

    public function viewAction($id) {
        $this->checkInitialization();

        $this->resolveInstance($id);

        $this->view->instance = $this->instance;
    }

    public function saveAction() {

        $this->checkInitialization();

        if ($this->request->isPost()) {

            $this->resolveInstance($this->request->getPost("id"));

            $this->populatePostData($this->instance);

            if ($this->isValid($this->instance)) {
                $this->saveOrUpdate($this->instance);
            } else {
                $this->dispatcher->setParams(array('instance' => $this->instance));
                $this->dispatcher->forward(array('action' => 'view'));
                return false;
            }
        } else {
            throw new LogicException("For security reasons GET method is not allowed");
        }
    }

    private function resolveInstance($id) {
        if ($id != '') {
            $this->instance = $this->service->findById($id);
        } else {
            $params = $this->dispatcher->getParams();

            if (isset($params['instance']) && $params['instance'] != null) {
                $this->instance = $params['instance'];
            } else {
                $this->instance = $this->getNewInstance();
            }
        }
        
        if ($this->instance == null) {
            $this->response->redirect('error/show404');
        }
        
    }

    protected function saveOrUpdate($instance) {

        $this->view->instance = $instance;

        try {
            if ($instance->getId() == '') {
                $this->service->save($instance);
                $this->success("Registro salvo com sucesso");
                $this->response->redirect($this->controllerName . '/view/' . $instance->getId());

                return false;
            } else {
                $this->service->update($instance);
                $this->success("Registro atualizado com sucesso");
                $this->response->redirect($this->controllerName . '/view/' . $instance->getId());
            }
        } catch (ValidationException $ex) {

            foreach ($ex->getErrors() as $err) {
                $this->error($err->getMessage());
            }

            $this->dispatcher->setParams(array('instance' => $this->instance));
            $this->dispatcher->forward(array('action' => 'view'));
        } catch (Exception $ex) {
            $this->showError($ex);
        }
    }

    private function getNewInstance() {
        $instance = $this->createNewInstance();
        if ($instance == null) {
            throw new LogicException(" Method #createNewInstance must return a new instance of currente managed class");
        }
        return $instance;
    }

    /**
     * @throws LogicException
     */
    private function checkInitialization() {
        if (!$this->_initialized) {
            throw new LogicException("Method called before #initialize(BasicService)");
        }
    }

    protected abstract function createNewInstance();

    protected abstract function populatePostData($instance);

    protected abstract function isValid($instance);

    protected function beforeSave($instance) {
        
    }

    protected function afterSave($instance) {
        
    }

}
