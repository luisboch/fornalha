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
        $this->view->ctrl = $this;
    }

    public function indexAction() {
    }

    public function categoryAction($id) {
        $this->view->catId = $id;
    }
    
    public function allAction($id) {
        $this->view->catId = $id;
    }

    public function getItens($t){
        
        $list = $t->getItens();
    	$arr = array();
        
    	for($i = 0; $i< count($list); $i++){
    		$arr[$i] = $list[$i];
    	}

        usort($arr, array($this, "sort"));
        return $arr;
    }
    
    /**
     * This method sort itens.
     * It is used in #getItens
     */
    public function sort($a, $b){
	    return strcmp($a->getName(), $b->getName());
    }

	
}
