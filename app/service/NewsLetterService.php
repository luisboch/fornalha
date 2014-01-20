<?php
require_once APP_DIR . 'model/NewsLetterDAO.php';
require_once 'BasicService.php';

/**
 * Description of ContactService
 *
 * @author luis
 */
class NewsLetterService extends BasicService{
    public function __construct() {
        parent::__construct(new NewsLetterDAO());
    }
    
    /**
     * 
     * @param NewsLetter $c
     * @param boolean $newObject
     */
    public function validate($c, $newObject = true) {
        $v = new ValidationException();
        
        if($c->getName() == ''){
            $v->addError("Preencha o nome corretamente", 'name');
        }
        
        if($c->getEmail() == ''){
            $v->addError("Preencha o email corretamente", 'email');
        }
        
        if(!StringValidation::checkEmail($c->getEmail())){
            $v->addError("Preencha com um email válido", 'email');
        }
                
        if($c->getGender() == ""){
            $v->addError("Selecione o sexo", 'gender');
        }
        
        if(!$v->isEmtpy()){
            throw $v;
        }
    }
}
