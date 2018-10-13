<?php
/**
 * To convert pet_db.txt to YAML file
 *
 * PHP version 7.1.3+
 *
 * LICENSE: See LICENSE in root folder
 *
 * @author     Cydh
 */
require_once 'petdbconfig.php';
require_once '../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

foreach ($db as $mode => $thisdb) {
    $yaml = Yaml::dump($thisdb['db'], 10, 2);
    file_put_contents($thisdb['output']['yml'], $yaml);
}
