<?php

/**
 * Description of CompanyPhone
 *
 * @author luis
 * @since Jan 16, 2014
 * @Entity @Table(name="company_phone")
 */
class CompanyPhone {
    
    /**
     *  @Id @Column(type="integer") @GeneratedValue
     */
    
    private $id;

    /**
     * @Column(type="integer")
     */
    
    private $code;

    /**
     * @Column(type="integer")
     */
    private $number;
    
    /**
     * @ManyToOne(targetEntity="CompanyContact", inversedBy="phones", fetch="EAGER")
     * @JoinColumn(name="contact_id", referencedColumnName="id")
     * @var CompanyContact
     */
    private $contact;
    
    public function getId() {
        return $this->id;
    }

    public function getCode() {
        return $this->code;
    }

    public function getNumber() {
        return $this->number;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setNumber($number) {
        $this->number = $number;
    }
    
    public function getContact() {
        return $this->contact;
    }

    public function setContact(CompanyContact $contact) {
        $this->contact = $contact;
    }
}
