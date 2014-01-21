<?php

require_once 'BasicEntity.php';

/**
 * Description of Spotlight
 *
 * @author luis
 * @Entity
 * @Table(name="featured")
 */
class Featured implements BasicEntity {

    /**
     * @Id @Column(type="integer") @GeneratedValue
     * @var integer
     */
    private $id;

    /**
     * @Column(type="string")
     * @var string
     */
    private $title;

    /**
     * @Column(type="string")
     * @var string
     */
    private $subtitle;

    /**
     * @Column(type="string")
     * @var string
     */
    private $link;

    /**
     * @Column(type="string")
     * @var string
     */
    private $image;

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

    /**
     *
     * @Column(type="integer", nullable=false, name="view_priority")
     * @var integer
     */
    private $viewPriority = 0;

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getSubtitle() {
        return $this->subtitle;
    }

    public function getLink() {
        return $this->link;
    }

    public function getImage() {
        return $this->image;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getLastUpdate() {
        return $this->lastUpdate;
    }

    public function getActive() {
        return $this->active;
    }

    public function setCreationDate(DateTime $creationDate) {
        $this->creationDate = $creationDate;
    }

    public function setLastUpdate(DateTime $lastUpdate) {
        $this->lastUpdate = $lastUpdate;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function getViewPriority() {
        return $this->viewPriority;
    }

    public function setViewPriority($viewPriority) {
        $this->viewPriority = $viewPriority;
    }

}
