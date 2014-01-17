<?php

require_once 'BasicService.php';
require_once APP_DIR . 'model/DealDAO.php';

/**
 * Description of ProductTypeService
 *
 * @author luis
 * @since Jan 16, 2014
 * @property DealDAO $dao
 */
class DealService extends BasicService {

    public function __construct() {
        parent::__construct(new DealDAO());
    }

    /**
     * 
     * @param Deal $entity
     * @param boolean $newObject
     */
    public function validate($entity, $newObject = true) {
        $v = new ValidationException();

        if ($entity->getName() == '') {
            $v->addError("Preencha o nome", 'name');
        }

        if ($entity->getDescription() == '') {
            $v->addError("Preencha a descrição", 'description');
        }else if(strlen($entity->getDescription()) > 4000){
            $v->addError("A descrição deve conter no máximo 4000 caracteres", 'description');
        }

        if (!$v->isEmtpy()) {
            throw $v;
        }
    }

}
