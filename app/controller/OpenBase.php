<?php

require_once 'ControllerBase.php';
require_once SERVICE_DIR . 'CompanyService.php';

/**
 * Description of OpenBase
 *
 * @author luis
 * @since Jan 16, 2014
 */
class OpenBase extends ControllerBase {
    
    private $company;
    
    /**
     * @var CompanyService
     */
    private $companyService;
    
    public function initialize() {
        parent::initialize();
        
        $this->companyService = new CompanyService();
        
        $this->company = $this->companyService->getCompany();
        
        $this->view->_company = $this->company;
    }

}
