<?php

require_once 'OpenBase.php';
require_once SERVICE_DIR . 'FeaturedService.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefaultController
 *
 * @author luis
 */
class IndexController extends OpenBase {

    /**
     *
     * @var FeaturedService
     */
    private $service;

    public function initialize() {
        parent::initialize();
        $this->service = new FeaturedService();
        $this->setTitle("Inicio");
    }

    public function indexAction() {
        $this->view->featured = $this->service->search(array(), true);
        if(count($this->view->featured) > 0){
            $this->view->selectedFeaturedId = $this->view->featured[0]->getId();
        }
    }

}
