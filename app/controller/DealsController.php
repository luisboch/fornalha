<?php
require_once 'OpenBase.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DealsController
 *
 * @author luis
 */
class DealsController extends OpenBase{
    
    public function initialize() {
        parent::initialize();
        $this->view->action = "Promoções";
    }

    public function indexAction(){
    }
}
