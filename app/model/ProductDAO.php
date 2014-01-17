<?php

require_once 'BasicDAO.php';
require_once APP_DIR . 'entity/Product.php';

/**
 * Description of ProductDAO
 *
 * @author luis
 * @since Jan 16, 2014
 */
class ProductDAO extends BasicDAO {

    public function __construct() {
        parent::__construct('Product');
    }

    public function search($filters = array(), $activeOnly = NULL, $limit = NULL, $offset = NULL) {

        $q = $this->em->createQueryBuilder();

        $q->select('p')
                ->from('Product', 'p');

        $q->join('p.type', 't');

        $where = array();
        $emptyWhere = true;
        $params = array();

        $i = 1;

        if (isset($filters['search']) && $filters['search'] != '') {

            $where[$i] = $q->expr()->like('p.name', '?' . $i);
            $params[$i] = $filters['search'];
            $emptyWhere = false;
            $i++;
        }

        if (isset($filters['type']) && $filters['type'] != '') {

            if (is_numeric($filters['type'])) {
                $where[$i] = $q->expr()->eq('t.id', '?' . $i);
                $params[$i] = $filters['type'];
                $i++;
            } else {
                $where[$i] = $q->expr()->like('t.name', '?' . $i);
                $params[$i] = '%' . $filters['type'] . '%';
                $i++;
            }

            $emptyWhere = false;
        }

        if ($activeOnly !== null) {

            $where[$i] = $q->expr()->eq('p.active', '?' . $i);
            $params[$i] = $activeOnly;
            $i++;

            $where[$i] = $q->expr()->eq('t.active', '?' . $i);
            $params[$i] = $activeOnly;
            $i++;

            $emptyWhere = false;
        }

        foreach ($where as $k => $val) {
            if ($k === 1) {
                $q->where($val);
            } else {
                $q->andWhere($val);
            }
        }

        $q->setParameters($params);

        if ($limit !== NULL) {
            $q->setMaxResults($limit);
        }

        if ($offset !== NULL) {
            $q->setFirstResult($offset);
        }

        return $q->getQuery()->getResult();
    }

    public function searchCount($filters = array(), $activeOnly = NULL) {

        $q = $this->em->createQueryBuilder();

        $q->select('count(p.id)')
                ->from('Product', 'p');

        $q->join('p.type', 't');

        $where = array();
        $emptyWhere = true;
        $params = array();

        $i = 1;

        if (isset($filters['search']) && $filters['search'] != '') {

            $where[$i] = $q->expr()->like('p.name', '?' . $i);
            $params[$i] = $filters['search'];
            $emptyWhere = false;
            $i++;
        }

        if (isset($filters['type']) && $filters['type'] != '') {

            if (is_numeric($filters['type'])) {
                $where[$i] = $q->expr()->eq('t.id', '?' . $i);
                $params[$i] = $filters['type'];
                $i++;
            } else {
                $where[$i] = $q->expr()->like('t.name', '?' . $i);
                $params[$i] = '%' . $filters['type'] . '%';
                $i++;
            }

            $emptyWhere = false;
        }

        if ($activeOnly === null) {

            $where[$i] = $q->expr()->eq('p.active', '?' . $i);
            $params[$i] = $activeOnly;
            $i++;

            $where[$i] = $q->expr()->eq('t.active', '?' . $i);
            $params[$i] = $activeOnly;
            $i++;

            $emptyWhere = false;
        }

        foreach ($where as $k => $val) {
            if ($k === 1) {
                $q->where($val);
            } else {
                $q->andWhere($val);
            }
        }

        $q->setParameters($params);

        return $q->getQuery()->getSingleScalarResult();
    }

}
