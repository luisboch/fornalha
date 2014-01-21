<?php

require_once 'AdminBase.php';
require_once SERVICE_DIR . 'CityService.php';
require_once SERVICE_DIR . 'StateService.php';
require_once SERVICE_DIR . 'CompanyService.php';

/**
 * Description of AdminClass
 *
 * @author luis
 */
class ConfigController extends AdminBase {

    /**
     *
     * @var CityService
     */
    private $cityService;

    /**
     * @var StateService
     */
    private $stateService;

    /**
     * @var CompanyService
     */
    private $service;

    /**
     * @var States[]
     */
    private $states;

    /**
     * @var City[]
     */
    private $cities;

    /**
     * @var Company
     */
    private $instance;

    public function initialize() {
        parent::initialize();
        $this->initializeServices();

        $this->states = $this->stateService->findAll();

        $this->setTitle("Configuração");
    }

    private function initializeServices() {
        $this->cityService = new CityService();
        $this->stateService = new StateService();
        $this->service = new CompanyService();
    }

    public function indexAction() {
        $this->view->states = $this->states;

        $params = $this->dispatcher->getParams();

        if (isset($params['instance']) && $params['instance'] != null) {
            $this->view->instance = $params['instance'];
        } else {
            $this->view->instance = $this->service->getCompany();
        }

        $this->instance = $this->view->instance;

        if ($this->instance->getAddress()->getState() != null) {
            $this->cities = $this->cityService->findCitiesByState($this->instance->getAddress()->getState()->getId());
        } else {
            $this->cities = array();
        }

        $this->view->cities = $this->cities;
    }

    public function saveAction() {
        $this->instance = $this->service->getCompany();
        $this->populateData($this->instance);
        try {
            $this->service->update($this->instance);

            $this->success("Registro atualizado com sucesso");
            $this->response->redirect('config/index');
            $this->view->disable();
        } catch (ValidationException $ex) {
            foreach ($ex->getErrors() as $err) {
                $this->error($err->getMessage(), $err->getField());
            }

            $this->dispatcher->setParams(array('instance' => $this->instance));
            $this->dispatcher->forward(array('action' => 'index'));
        } catch (Exception $ex) {
            $this->showError($ex);
        }
    }

    private function populateData(Company $instance) {

        $instance->setName(
                $this->request->getPost('name'));
        $instance->setAboutUs($this->request->getPost('about_us'));
        $instance->getContact()->setEmail(
                $this->request->getPost('email'));

        $this->parsePhones($instance->getContact());

        $instance->getAddress()->setCity($this->getSelectCity());
        $instance->getAddress()->setState($this->getSelectState());
        $instance->getAddress()->setNumber($this->request->getPost('number'));
        $instance->getAddress()->setObservation($this->request->getPost('observation'));
        $instance->getAddress()->setStreet($this->request->getPost('street'));
        $instance->getAddress()->setStreetCode($this->request->getPost('street_code'));
        $instance->getAddress()->setNeighborhood($this->request->getPost('neighborhood'));
        $instance->getAddress()->setLatitude($this->request->getPost('latitude'));
        $instance->getAddress()->setLongitude($this->request->getPost('longitude'));
    }

    /**
     * @return City
     */
    private function getSelectCity() {
        $city_id = $this->request->getPost('city_id');

        if ($city_id != '') {
            return $this->cityService->findById($city_id);
        }
        return null;
    }

    /**
     * @return State
     */
    private function getSelectState() {
        $state_id = $this->request->getPost('state_id');

        if ($state_id != '') {
            return $this->stateService->findById($state_id);
        }
        return null;
    }

    /**
     * @param CompanyContact $contact
     */
    private function parsePhones(CompanyContact $contact) {

        $post = trim($this->request->getPost('phones'));
        $contact->getPhones()->clear();

        $strings = split(',', $post);

        foreach ($strings as $v) {

            $parts = split(')', $v);

            $code = trim(str_replace('(', '', $parts[0]));
            $number = trim($parts[1]);
            if ($code != '' || $number != '') {
                $phone = new CompanyPhone();
                $phone->setCode($code);
                $phone->setNumber($number);
                $phone->setContact($contact);

                $contact->getPhones()->add($phone);
            }
        }
    }

    public function loadCitiesAction($stateId) {
        $this->view->cities = $this->cityService->findCitiesByState($stateId);
        $this->view->setViewsDir('../app/view/admin/ajax/');
    }

}
