<?php
require_once 'OpenBase.php';
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
   
    public function initialize() {
        parent::initialize();
    }
    
    public function indexAction() {
        $this->view->action = 'Home';
    }

}
