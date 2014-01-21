<?php
require_once 'BasicDAO.php';
require_once APP_DIR.'entity/Featured.php';
/**
 * Description of FeaturedDAO
 *
 * @author luis
 */
class FeaturedDAO extends BasicDAO {
    
    public function __construct() {
        parent::__construct('Featured');
    }
    
    public function search($filters = array(), $activeOnly = NULL, $limit = NULL, $offset = NULL) {

        $q = $this->em->createQueryBuilder();

        $q->select("p")
                ->from("Featured", 'p');

        $where = array();
        $params = array();
        $emptyWere = true;

        $i = 1;

        if (isset($filters['search'])) {
            $where[$i] = $q->expr()->like('p.title', '?' . $i);
            $params[$i] = '%' . $filters['search'] . '%';
            $emptyWere = false;
            $i++;
        }

        if ($activeOnly !== null) {
            $where[$i] = $q->expr()->eq('p.active', '?' . $i);
            $params[$i] = $activeOnly;
            $emptyWere = false;
            $i++;
        }

        if (!$emptyWere) {
            foreach ($where as $k => $v) {
                if ($k == 1) {
                    $q->where($v);
                } else {
                    $q->andWhere($v);
                }
            }
        }

        $q->orderBy('p.viewPriority', 'desc');
        $q->addOrderBy('p.title');
        $q->addOrderBy('p.lastUpdate');

        $q->setParameters($params);

        if ($limit !== null) {
            $q->setMaxResults($limit);
        }

        if ($offset !== null) {
            $q->setFirstResult($offset);
        }

        return $q->getQuery()->getResult();
    }

    public function searchCount($filters = array(), $activeOnly = NULL) {

        $q = $this->em->createQueryBuilder();
        $q->select("count(p.id)")
                ->from("Featured", 'p');

        $where = array();
        $params = array();
        $emptyWere = true;

        $i = 1;

        if (isset($filters['search'])) {
            $where[$i] = $q->expr()->like('p.title', '?' . $i);
            $params[$i] = '%' . $filters['search'] . '%';
            $emptyWere = false;
            $i++;
        }

        if ($activeOnly != null) {
            $where[$i] = $q->expr()->eq('p.active', '?' . $i);
            $params[$i] = $activeOnly;
            $emptyWere = false;
            $i++;
        }

        if (!$emptyWere) {
            foreach ($where as $k => $v) {
                if ($k == 1) {
                    $q->where($v);
                } else {
                    $q->andWhere($v);
                }
            }
        }

        $q->setParameters($params);

        return $q->getQuery()->getSingleScalarResult();
    }
}
