<?php

/**
 * SQLLogger.php
 */

/**
 * SQLLogger
 *
 * @author luis
 * @since Feb 12, 2014
 */
class SQLLogger implements Doctrine\DBAL\Logging\SQLLogger {

    private $fileHandler;

    function __construct() {
        $filePath = APP_DIR . 'logs/sql_' . date('y-m-d') . '.log';
        $this->fileHandler = fopen($filePath, 'a');
    }

    public function startQuery($sql, array $params = null, array $types = null) {
        fwrite($this->fileHandler, '' .
                $sql . "\nBIND:[" . (is_array($params) ? implode(', ', $params) : "") . ']' .
                ', types:[' . (is_array($types) ? implode(', ', $types) : "") . "]\n");
    }

    public function stopQuery() {
        
    }

}
