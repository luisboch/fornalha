<?php

require_once 'CrudBase.php';
require SERVICE_DIR . 'DealService.php';

/**
 *
 * @author luis
 * @since Jan 16, 2014
 * @property DealService $service
 */
class DealscrudController extends CrudBase {

    public function initialize() {
        parent::initialize(new DealService());
        $this->setTitle("Promoções");
    }

    protected function createNewInstance() {
        return new Deal();
    }

    protected function getSearchParams() {
        return array('search' => $this->request->getQuery('search'));
    }

    protected function isValid($instance) {
        return true;
    }

    /**
     * 
     * @param Deal $instance
     */
    protected function populatePostData($instance) {
        $instance->setName($this->request->getPost('name'));
        $instance->setDescription($this->request->getPost('description'));
        $instance->setActive($this->request->getPost('active') === 'on');
        
        $startDate = $this->request->getPost('startDate');
        
        if($startDate != ''){
            $instance->setStartDateRange(DateTime::createFromFormat('d/m/y', $startDate));
        }
        
        $endDate = $this->request->getPost('endDate');
        
        if($endDate != ''){
            $instance->setEndDateRange(DateTime::createFromFormat('d/m/y', $endDate));
        }
    }
}