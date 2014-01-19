<?php

require_once 'BasicEntity.php';
require_once 'ProductType.php';

/**
 * Description of Product
 *
 * @author luis
 * @since Jan 16, 2014
 * @Entity 
 * @Table(name="product")
 */
class Product implements BasicEntity {

    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @Column(type="string")
     * @var string
     */
    private $name;

    /**
     * @Column(type="string")
     * @var string
     */
    private $description;

    /**
     * @Column(type="datetime", name="creation_date")
     * @var DateTime
     */
    private $creationDate;

    /**
     * @Column(type="datetime", name="last_update")
     * @var DateTime
     */
    private $lastUpdate;

    /**
     * @Column(type="boolean")
     * @var boolean
     */
    private $active = true;

    /**
     * @ManyToOne(targetEntity="ProductType", fetch="LAZY")
     * @JoinColumn(name="type_id", referencedColumnName="id")
     * @var ProductType
     */
    private $type;
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
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

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
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

    /**
     * 
     * @return ProductType
     */
    public function getType() {
        return $this->type;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    /**
     * @param ProductType $type
     */
    public function setType($type) {
        $this->type = $type;
    }
}
