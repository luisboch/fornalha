<?php

require_once APP_DIR . 'model/UserDAO.php';
require_once 'BasicService.php';
require_once 'exceptions/ValidationException.php';
require_once 'utils/validation/StringValidation.php';

/**
 * Description of UserService
 *
 * @author luis
 * @since Jan 7, 2014
 * 
 * @property UserDAO $dao 
 */
class UserService extends BasicService {

    public function __construct() {
        parent::__construct(new UserDAO());
    }

    /**
     * 
     * @param User $user
     * @param boolean $save
     * @throws InvalidArgumentException
     * @throws ValidationException
     */
    public function validate($user, $save = true) {
        $v = new ValidationException();
        if ($user->getId() == null && !$save) {
            throw new InvalidArgumentException("The object need an id to update");
        } else {

            // Check cpf
            if ($user->getCpf() == '' || !StringValidation::checkCpf($user->getCpf())) {
                $v->addError("Por favor insira um CPF válido", 'cpf');
            } else {
                $userCPF = $this->dao->findByCPF($user->getCpf());
                if ($userCPF != null && $user->getId() != $userCPF->getId()) {
                    $v->addError("O CPF inserido já está sendo utilizado, insira um válido");
                }
            }

            // Check email
            if ($user->getEmail() == '' || !StringValidation::checkEmail($user->getEmail())) {
                $v->addError("Por favor insira um email válido", 'email');
            } else {
                $userEmail = $this->dao->findByEmail($user->getEmail());
                if ($userEmail != null && $user->getId() != $userEmail->getId()) {
                    $v->addError("O email inserido já está sendo utilizado, insira um válido");
                }
            }

            // Check name
            if ($user->getName() == '') {
                $v->addError("Por favor insira seu nome", 'name');
            }

            // Check password
            if ($user->getPassword() == '') {
                $v->addError("Por favor preencha a senha", 'password');
            }

            if (!$v->isEmtpy()) {
                throw $v;
            }
        }
    }

    /**
     * 
     * @param string $email
     * @return User
     */
    public function findByEmail($email) {
        return $this->dao->findByEmail($email);
    }

    /**
     * 
     * @param string $cpf
     * @return User
     */
    public function findByCPF($cpf) {
        return $this->dao->findByCPF($cpf);
    }

    /**
     * 
     * @param array $filter
     * Can user to search for all properties
     * 
     * example:
     * [
     *      "name" => "My Name",
     *      "email" => "myemail.com"
     * ]
     * 
     * will generate filter like:
     *  where lower(name) like lower('%My%Name%') 
     *    and lower(email) like lower('%myemail.com%')
     * 
     * another way is use the generic term "search"
     * example: 
     * 
     * [
     *      "search" => "MySearch"
     * ]
     * 
     * will generate filter like:
     *  where lower(name) like lower('%MySearch%') 
     *    and lower(email) like lower('%MySearch%')
     *
     * Note: Do not use both option a the same time.
     * 
     * @param boolean $activeOnly
     * @param int $limit
     * @param int $offset
     * @return User[]
     */
    public function search($filters = array(), $activeOnly = NULL, $limit = NULL, $offset = NULL) {
        return $this->dao->search($filters, $activeOnly, $limit, $offset);
    }
    
    /**
     * @param array $filters
     * Can user to search for all properties
     * 
     * example:
     * [
     *      "name" => "My Name",
     *      "email" => "myemail.com"
     * ]
     * 
     * will generate filter like:
     *  where lower(name) like lower('%My%Name%') 
     *    and lower(email) like lower('%myemail.com%')
     * 
     * another way is use the generic term "search"
     * example: 
     * 
     * [
     *      "search" => "MySearch"
     * ]
     * 
     * will generate filter like:
     *  where lower(name) like lower('%MySearch%') 
     *    and lower(email) like lower('%MySearch%')
     *
     * Note: Do not use both option a the same time.
     * 
     * 
     * @param boolean $activeOnly
     * @return int
     */
    public function searchCount($filters = array(), $activeOnly = NULL) {
        return $this->dao->searchCount($filters, $activeOnly);
    }

}
