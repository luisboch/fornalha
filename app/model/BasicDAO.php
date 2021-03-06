<?php

require_once ROOT_DIR . 'vendor/autoload.php';
require_once SERVICE_DIR . 'Config.php';
require_once APP_DIR . 'utils/SQLLogger.php';

/**
 * Description of BasicDAO
 *
 * @author luis
 * @since Jan 7, 2014
 */
abstract class BasicDAO {

    public static $config;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    private static $entityManager;
    protected $className;

    function __construct($className) {
        $this->setupDoctrine();
        $this->className = $className;
    }

    private final function openDatabaseConnection() {
        BasicDAO::$entityManager->getConnection()->connect();
    }

    public final function setupDoctrine() {

        if (BasicDAO::$entityManager === null) {

            $paths = array(APP_DIR . "entity/");

            // the connection configuration
            $app_config = Config::getInstance();

            $config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, true);
            BasicDAO::$entityManager = Doctrine\ORM\EntityManager::create($app_config['database'], $config);

            $this->openDatabaseConnection();

            if ($app_config['database']['enable_log']) {
                BasicDAO::$entityManager->getConnection()->getConfiguration()
                        ->setSQLLogger(new SQLLogger());
            }
        }

        $this->em = BasicDAO::$entityManager;
    }

    public function findById($id) {
        return $this->em->find($this->className, $id);
    }

    public function save($obj) {
        $this->em->persist($obj);
    }

    public function update($obj) {
        $this->em->merge($obj);
    }

    public function getEntityManager() {
        return $this->em;
    }

    protected final function find($params = array(), $order = "id") {

        $dql = "select x \nfrom " . $this->className . " x\n";

        $queryParms = array();

        if (count($params) > 0) {

            $dql.="where ";
            $i = 0;
            foreach ($params as $k => $v) {

                if ($i != 0) {
                    $dql.="and ";
                }

                $dql .= "x." . $k . " ?" . ($i + 1) . "\n";

                $queryParms[$i + 1] = $v;

                $i++;
            }
        }

        if ($order != "") {
            $dql .= "order by x." . $order . "\n ";
        }

        $query = $this->em->createQuery($dql);

        $query->setParameters($queryParms);

        return $query->getResult();
    }

    public function simpleSearch($filters = array()) {

        $dql = "select x \nfrom " . $this->className . " x\n";

        if (count($filters) > 0) {

            $dql.="where";
            $i = 0;
            foreach ($filters as $k => $v) {

                if ($i != 0) {
                    $dql.="and";
                }

                if (is_string($v)) {
                    $v = "'$v'";
                }

                $dql .= " x." . $k . " " . $v . "\n";
                $i++;
            }
        }

        $query = $this->em->createQuery($dql);

        return $query->getResult();
    }

    protected function setParams(Doctrine\ORM\Query $q, $params) {
        if ($params !== NULL && is_array($params)) {
            foreach ($params as $k => $v) {
                $q->setParameter($k, $v);
            }
        }
    }

    public abstract function search($filters = array(), $activeOnly = NULL, $limit = NULL, $offset = NULL);

    public abstract function searchCount($filters = array(), $activeOnly = NULL);
}
