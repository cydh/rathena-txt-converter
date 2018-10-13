<?php
/**
 * To convert pet_db.txt to JSON formatted file with .yml file
 * extension.
 *
 * PHP version 5.2.0+
 *
 * LICENSE: See LICENSE in root folder
 *
 * @author     Cydh
 */
require_once 'petdbconfig.php';

foreach ($db as $mode => $thisdb) {
    $json = json_encode($thisdb['db'], JSON_PRETTY_PRINT|JSON_NUMERIC_CHECK);
    file_put_contents($thisdb['output']['json'], $json."\r\n");
}
