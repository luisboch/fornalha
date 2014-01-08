<?php

require_once ROOT_DIR . 'vendor/autoload.php';

/**
 * Description of BasicDAO
 *
 * @author luis
 * @since Jan 7, 2014
 */
class BasicDAO {

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    function __construct() {
        $this->setupDoctrine();
        $this->openDatabaseConnection();
    }

    private final function openDatabaseConnection() {
        $this->em->getConnection()->connect();
    }

    public function setupDoctrine() {
        
        $paths = array(APP_DIR . "entity/");
        
        // the connection configuration
        $dbParams = array(
            'driver' => 'pdo_pgsql',
            'user' => 'postgres',
            'password' => 'postgres',
            'dbname' => 'pizza',
            'port' => 5432,
            'host' => 'localhost'
        );
        
        $config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, true);
        $this->em = Doctrine\ORM\EntityManager::create($dbParams, $config);
    }
    
    public function save($obj) {
        $this->em->persist($obj);
    }
    
    public function update($obj){
        $this->em->merge($obj);
    }
    
    public function getEntityManager() {
        return $this->em;
    }


}
