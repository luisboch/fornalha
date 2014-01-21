<?php

require_once 'BasicService.php';
require_once APP_DIR . 'model/FeaturedDAO.php';

/**
 * Description of FeaturedService
 *
 * @author luis
 */
class FeaturedService extends BasicService{
    public function __construct() {
        parent::__construct(new FeaturedDAO());
    }
    
    /**
     * 
     * @param Featured $e
     * @param boolean $newObject
     */
    public function validate($e, $newObject = true) {
        $v = new ValidationException();
        
        if($e->getTitle() == ''){
            $v->addError("Preencha o título", 'title');
        }
        
        if($e->getSubtitle() == ''){
            $v->addError("Preencha o subtítulo", 'subtitle');
        }
        
        if($e->getImage() == ''){
            $v->addError("Inclua uma imagem", 'image');
        }
        
        if(!$v->isEmtpy()){
            throw $v;
        }
    }
}
