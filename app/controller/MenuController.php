<?php

require_once 'OpenBase.php';
require_once SERVICE_DIR.'ProductTypeService.php';

/**
 * Description of MenuController
 *
 * @author luis
 */
class MenuController extends OpenBase {
    /**
     *
     * @var ProductTypeService
     */
    private $typeService;
    public function initialize() {
        parent::initialize();
        $this->setTitle("Cardápio");
        $this->typeService = new ProductTypeService();
        $this->view->types = $this->typeService->search(array(), true);
    }

    public function indexAction() {
    }

    public function categoryAction($id) {
        $this->view->catId = $id;
    }
    
    public function allAction($id) {
        $this->view->catId = $id;
    }

}