<?php

require_once SERVICE_DIR . 'ProductService.php';
require_once SERVICE_DIR . 'ProductTypeService.php';

/**
 * Description of ProductController
 * @author luis
 * @since Jan 17, 2014
 * @property ProductService $service
 */
class ProductController extends CrudBase {

    /**
     * @var ProductTypeService
     */
    private $typeService;

    public function initialize() {
        parent::initialize(new ProductService());
        $this->typeService = new ProductTypeService();
        $this->setTitle("Item");
    }

    public function viewAction($id = null) {
        parent::viewAction($id);
        $this->view->types = $this->typeService->search(array(), true);
    }

    public function searchAction($page = 1) {
        parent::searchAction($page);
        $this->view->types = $this->typeService->search(array(), true);
    }

    public function indexAction() {
        parent::indexAction();
        $this->view->types = $this->typeService->search(array(), true);
    }

    protected function createNewInstance() {
        return new Product();
    }

    protected function getSearchParams() {
        return array(
            'search' => $this->request->getQuery('search'),
            'type' => $this->request->getQuery('type'));
    }

    protected function isValid($instance) {
        return true;
    }

    /**
     * @param Product $p
     */
    protected function populatePostData($p) {

        $p->setName($this->request->getPost('name'));
        $p->setDescription($this->request->getPost('description'));

        $type_id = $this->request->getPost('type_id');

        if ($type_id != '') {
            $p->setType($this->typeService->findById($type_id));
        }

        $p->setActive($this->request->getPost('active') === 'on');
    }

    protected function beforeSearch() {
        $active = $this->request->getQuery('active');
        $this->showActiveResults = $active === 'on';
        $this->view->active = $this->showActiveResults;
        $this->view->selectedType = $this->request->getQuery('type');
        return true;
    }

}
