<?php

require_once 'OpenBase.php';
require_once SERVICE_DIR . 'DealService.php';

/**
 * Description of DealsController
 *
 * @author luis
 */
class DealsController extends OpenBase {
    
    /**
     *
     * @var DealService
     */
    private $service;
    public function initialize() {
        parent::initialize();
        $this->setTitle("Promoções");
        $this->service = new DealService();
    }

    public function indexAction() {
        $this->view->deals = $this->service->search(array(), true);
    }

}
