<?php

require_once APP_DIR . 'model/BasicDAO.php';
require_once APP_DIR . 'entity/ProductType.php';

/**
 * Description of ProductTypeDAO
 *
 * @author luis
 * @since Jan 16, 2014
 */
class ProductTypeDAO extends BasicDAO {

    public function __construct() {
        parent::__construct('ProductType');
    }

    public function search($filters = array(), $activeOnly = NULL, $limit = NULL, $offset = NULL) {

        $q = $this->em->createQueryBuilder();

        $q->select("p")
                ->from("ProductType", 'p');

        $where = array();
        $params = array();
        $emptyWere = true;

        $i = 1;

        if (isset($filters['search'])) {
            $where[$i] = $q->expr()->like('p.name', '?' . $i);
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
        $q->addOrderBy('p.name');
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
                ->from("ProductType", 'p');

        $where = array();
        $params = array();
        $emptyWere = true;

        $i = 1;

        if (isset($filters['search'])) {
            $where[$i] = $q->expr()->like('p.name', '?' . $i);
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
