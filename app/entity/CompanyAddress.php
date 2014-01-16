<?php

/**
 * Description of CompanyAddress
 *
 * @author luis
 * @since Jan 16, 2014
 * @Entity @Table(name="company_address")
 */
class CompanyAddress {

    /**
     * @Id @Column(type="integer") @GeneratedValue 
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $street;
    /**
     * @Column(type="integer")
     */
    private $number;
    
    /**
     * @Column(type="string")
     */
    private $observation;
    
    /**
     *  @ManyToOne(targetEntity="State")
     *  @JoinColumn(name="state_id", referencedColumnName="id")
     *  @var State
     */
    private $state;
    /**
     *  @ManyToOne(targetEntity="City")
     *  @JoinColumn(name="city_id", referencedColumnName="id")
     *  @var City
     */
    private $city;
    
    public function getId() {
        return $this->id;
    }

    public function getStreet() {
        return $this->street;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getObservation() {
        return $this->observation;
    }
    
    /**
     * 
     * @return State
     */
    public function getState() {
        return $this->state;
    }
    
    /**
     * 
     * @return City
     */
    public function getCity() {
        return $this->city;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setStreet($street) {
        $this->street = $street;
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function setObservation($observation) {
        $this->observation = $observation;
    }

    /**
     * @param State $state
     */
    public function setState($state) {
        $this->state = $state;
    }

    /**
     * @param City $city
     */
    public function setCity($city) {
        $this->city = $city;
    }
}