<?php

require_once 'BasicService.php';
require_once APP_DIR . 'model/ProductTypeDAO.php';

/**
 * Description of ProductTypeService
 *
 * @author luis
 * @since Jan 16, 2014
 * @property ProductTypeDAO $dao
 */
class ProductTypeService extends BasicService {

    public function __construct() {
        parent::__construct(new ProductTypeDAO());
    }

    /**
     * 
     * @param ProductType $entity
     * @param boolean $newObject
     */
    public function validate($entity, $newObject = true) {
        $v = new ValidationException();

        if ($entity->getName() == '') {
            $v->addError("Preencha o nome", 'name');
        }

        if (!$v->isEmtpy()) {
            throw $v;
        }
    }

}
