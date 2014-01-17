<?php

/**
 * Description of CompanyContact
 *
 * @author luis
 * @since Jan 16, 2014
 * @Entity @Table(name="company_contact")
 */
class CompanyContact {

    /**
     *  @Id @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $email;

    /**
     * @OneToMany(targetEntity="CompanyPhone", mappedBy="contact", cascade={"all"},  orphanRemoval=true, fetch="EAGER")
     * @var CompanyPhone[]
     */
    private $phones;

    function __construct() {
        $this->phones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    /**
     * 
     * @return CompanyPhone[]
     */
    public function getPhones() {
        return $this->phones;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPhones($phones) {
        $this->phones = $phones;
    }

    public function getPhonesAsString() {
        $str = "";

        $i = 0;
        foreach ($this->phones as $v) {
            if ($i != 0) {
                $str.=', ';
            }
            $str .= "(" . $v->getCode() . ') ' . $v->getNumber();
            $i++;
        }

        return $str;
    }

}
