<?php
require_once 'BasicEntity.php';
/**
 * Description of Contact
 * @author luis
 * @Entity @Table(name="news_letter")
 */
class NewsLetter implements BasicEntity {

    /** @Id @Column(type="integer") @GeneratedValue * */
    private $id;

    /** @Column(type="string") * */
    private $name;

    /** @Column(type="string") * */
    private $gender;

    /** @Column(type="string") * */
    private $email;

    /**
     * @var boolean
     * @Column(type="boolean")
     */
    private $active = true;

    /**
     *
     * @var DateTime 
     * @Column(type="datetime", name="creation_date")
     */
    private $creationDate;

    /**
     *
     * @var DateTime 
     * @Column(type="datetime", name="last_update")
     */
    private $lastUpdate;
    
    /**
     * @var boolean
     * @Column(type="boolean", name="receive_news")
     */
    private $receiveNews = true;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getActive() {
        return $this->active;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    /**
     * 
     * @return DateTime
     */
    public function getLastUpdate() {
        return $this->lastUpdate;
    }

    /**
     * 
     * @return DateTime
     */
    public function getReceiveNews() {
        return $this->receiveNews;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function setCreationDate(DateTime $creationDate) {
        $this->creationDate = $creationDate;
    }

    public function setLastUpdate(DateTime $lastUpdate) {
        $this->lastUpdate = $lastUpdate;
    }

    public function setReceiveNews($receiveNews) {
        $this->receiveNews = $receiveNews;
    }


}
