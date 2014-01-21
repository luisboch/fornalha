<?php

require_once 'CrudBase.php';
require_once SERVICE_DIR . 'ProductTypeService.php';

/**
 * Description of ProductTypeController
 *
 * @author luis
 * @since Jan 16, 2014
 * @property ProductTypeService $service
 */
class ProducttypeController extends CrudBase {

    public function initialize() {
        parent::initialize(new ProductTypeService());
        $this->setTitle("Tipo de Produto");
    }

    protected function createNewInstance() {
        return new ProductType();
    }

    protected function getSearchParams() {
        return array('search' => $this->request->getQuery('search'));
    }

    protected function isValid($instance) {
        return true;
    }

    /**
     * 
     * @param ProductType $instance
     */
    protected function populatePostData($instance) {
        $instance->setName($this->request->getPost('name'));
        
        $instance->setViewPriority($this->request->getPost('view_priority'));
        
        $instance->setActive($this->request->getPost('active') === 'on');
    }
}