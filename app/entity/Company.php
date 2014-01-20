<?php
require_once 'BasicEntity.php';
require_once 'CompanyContact.php';
require_once 'CompanyAddress.php';
require_once 'CompanyPhone.php';
/**
 * Description of Company
 *
 * @author luis
 * @since Jan 16, 2014
 * 
 * @Entity @Table(name="company")
 */
class Company implements BasicEntity{

    /**
     * @Id @Column(type="integer") @GeneratedValue 
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $name;

    /**
     *  @OneToOne(targetEntity="CompanyAddress", cascade={"all"}, fetch="EAGER")
     *  @JoinColumn(name="address_id", referencedColumnName="id")
     *  @var CompanyAddress
     */
    private $address;
    
    
    /**
     * @OneToOne(targetEntity="CompanyContact", cascade={"all"}, fetch="EAGER")
     * @JoinColumn(name="contact_id", referencedColumnName="id")
     * @var CompanyContact
     */
    private $contact;

    /**
     * @var DateTime
     * @Column(type="datetime", name="creation_date")
     */
    private $creationDate;

    /**
     * @var DateTime
     * @Column(type="datetime", name="last_update")
     */
    private $lastUpdate;
    
    
    /**
     * @var string
     * @Column(type="string", name="about_us")
     */
    private $aboutUs;
    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return CompanyAddress
     */
    public function getAddress() {
        return $this->address;
    }
    
    /**
     * 
     * @return CompanyContact
     */
    public function getContact() {
        return $this->contact;
    }
    
    /**
     * @return DateTime
     */
    public function getCreationDate() {
        return $this->creationDate;
    }

    /**
     * @return DateTime
     */
    public function getLastUpdate() {
        return $this->lastUpdate;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * 
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @param CompanyAddress $address
     */
    public function setAddress(CompanyAddress $address) {
        $this->address = $address;
    }

    public function setContact(CompanyContact $contact) {
        $this->contact = $contact;
    }
    
    public function setCreationDate(DateTime $creationDate) {
        $this->creationDate = $creationDate;
    }

    public function setLastUpdate(DateTime $lastUpdate) {
        $this->lastUpdate = $lastUpdate;
    }
    
    public function getAboutUs() {
        return $this->aboutUs;
    }

    public function setAboutUs($aboutUs) {
        $this->aboutUs = $aboutUs;
    }
}
