<?php

require_once 'BasicService.php';
require_once APP_DIR . 'model/ProductDAO.php';

/**
 * Description of ProductService
 *
 * @author luis
 * @since Jan 16, 2014
 */
class ProductService extends BasicService{
    public function __construct() {
        parent::__construct(new ProductDAO());
    }
    /**
     * 
     * @param Product $entity
     * @param boolean $newObject
     */
    public function validate($entity, $newObject = true) {
        
        $v = new ValidationException();
        
        if($entity->getName() == ''){
            $v->addError("Preencha o nome", 'name');
        }
        
        if($entity->getDescription() == ""){
            $v->addError("Preencha a descrição", 'description');
        }
        
        if($entity->getType() ==  null){
            $v->addError("Selecione o tipo de produto", 'type');
        }
        
        if(!$v->isEmtpy()){
            throw $v;
        }
    }
}
