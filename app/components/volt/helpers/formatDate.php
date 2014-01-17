<?php

/**
 * @param DateTime $date
 * @param string $format use NULL for default pathern
 * @return type
 */
function formatDate($date, $format = NULL) {
    if ($date == null) {
        return '';
    }

    $pattern = 'd/m/y H:i';

    if ($format != NULL) {
        switch ($format) {
            case 'long':
                $pattern = 'M, d \de Y H:i:s';
                break;
            case 'only-day':
                $pattern = 'd/m/y';
                break;
        }
    }

    return $date->format($pattern);
}
