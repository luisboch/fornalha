<?php

require_once APP_DIR . 'model/CompanyDAO.php';
require_once SERVICE_DIR . 'BasicService.php';
require_once SERVICE_DIR . 'utils/validation/StringValidation.php';

/**
 * Description of CompanyService
 *
 * @author luis
 * @since Jan 16, 2014
 * @property CompanyDAO $dao
 */
class CompanyService extends BasicService {

    function __construct() {
        parent::__construct(new CompanyDAO());
    }

    /**
     * 
     * @param Company $entity
     * @param boolean $newObject
     */
    public function validate($entity, $newObject = true) {

        $v = new ValidationException();

        if ($entity->getName() == '') {
            $v->addError('Preencha o nome da empresa', 'name');
        }

        if ($entity->getAddress()->getStreet() == '') {
            $v->addError("Insira o logradouro", 'street');
        }

        if ($entity->getAddress()->getNumber() == '') {
            $v->addError("Insira o numero do endereço", 'number');
        }
        
        if ($entity->getAddress()->getNeighborhood() == '') {
            $v->addError("Preencha o bairro", 'neighborhood');
        }
        
        if ($entity->getAddress()->getStreetCode() == '') {
            $v->addError("Preencha o cep", 'streetCode');
        }

        if ($entity->getAddress()->getState() == null) {
            $v->addError("Selecione o estado", 'state');
        }

        if ($entity->getAddress()->getCity() == null) {
            $v->addError("Selecione a cidade", 'city');
        }

        if ($entity->getContact()->getEmail() == null) {
            $v->addError("Preencha o email", 'email');
        } else if (!StringValidation::checkEmail($entity->getContact()->getEmail())) {
            $v->addError("Preencha com um email válido", 'email');
        }

        if (count($entity->getContact()->getPhones()) === 0) {
            $v->addError("Insira pelo menos um telefone", 'phones');
        }

        if (!$v->isEmtpy()) {
            throw $v;
        }
    }

    /**
     * @return Company
     */
    public function getCompany() {
        return $this->dao->getCompany();
    }

}
