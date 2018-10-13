<?php
/**
 * To convert pet_db.txt to JSON formatted file with .yml file
 * extension.
 *
 * Usage by default will use input and out in petdb2config.php
 * or by passing the arguments:
 * -i="path/to/rathena/re_or_pre/pet_db.txt" => input file
 * -o="filename"                             => output file
 * Example:
 * php petdb2json.php -i="D:/rathena/re/pet_db.txt" -o="pet_db.yml"
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
