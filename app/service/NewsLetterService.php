<?php

require_once APP_DIR . 'model/NewsLetterDAO.php';
require_once 'BasicService.php';

/**
 * Description of ContactService
 *
 * @author luis
 */
class NewsLetterService extends BasicService {

    public function __construct() {
        parent::__construct(new NewsLetterDAO());
    }

    public function save(BasicEntity $entity) {
        $this->validate($entity);
        $this->checkEmail($entity);
        // Set creation date and last upadte values
        $this->updateEntityDates($entity);

        try {

            // Begin Transaction
            if ($entity->getId() === NULL) {
                $this->dao->save($entity);
            } else {
                $this->dao->update($entity);
            }

            // Commit
            $this->dao->getEntityManager()->flush();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @param BasicEntity $e
     */
    private function checkEmail($e) {

        if ($e->getEmail() != '' && StringValidation::checkEmail($e->getEmail())) {
            
            $news = $this->dao->simpleSearch(array('email=' => $e->getEmail()));

            /**
             * @var NewsLetter[] $news 
             */
            if (count($news) == 1 && $news[0]->getId() != $e->getId()) {
                $e->setId($news[0]->getId());
            }
        }
    }

    /**
     * In this service, this method is a alias to #save
     * @param \BasicEntity $entity
     */
    public function update(\BasicEntity $entity) {
        $this->save($entity);
    }

    /**
     * 
     * @param NewsLetter $c
     * @param boolean $newObject
     */
    public function validate($c, $newObject = true) {

        $v = new ValidationException();

        if ($c->getEmail() == '') {
            $v->addError("Preencha o email corretamente", 'email');
        }

        if (!StringValidation::checkEmail($c->getEmail())) {
            $v->addError("Preencha com um email válido", 'email');
        }


        if ($c->getName() == '') {
            $v->addError("Preencha o nome corretamente", 'name');
        }


        if ($c->getGender() == "") {
            $v->addError("Selecione o sexo", 'gender');
        }

        if (!$v->isEmtpy()) {
            throw $v;
        }
    }

}
