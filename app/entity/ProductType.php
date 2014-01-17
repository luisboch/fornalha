<?php
require_once 'BasicEntity.php';

/**
 * Description of ProductType
 *
 * @author luis
 * @since Jan 16, 2014
 * @Entity @Table(name="product_type")
 */
class ProductType implements BasicEntity {
    
    /**
     * @Id @Column(type="integer") @GeneratedValue
     * @var integer
     */
    private $id;
    /**
     * @Column(type="string")
     * @var string
     */
    private $name;
    /**
     * @Column(name="creation_date", type="datetime")
     * @var DateTime
     */
    private $creationDate;
    
    /**
     * @Column(name="last_update", type="datetime")
     * @var DateTime
     */
    private $lastUpdate;
    
    /**
     * @Column(name="active", type="boolean")
     * @var boolean 
     */
    private $active = true;
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getLastUpdate() {
        return $this->lastUpdate;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setCreationDate(DateTime $creationDate) {
        $this->creationDate = $creationDate;
    }

    public function setLastUpdate(DateTime $lastUpdate) {
        $this->lastUpdate = $lastUpdate;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }
    
}