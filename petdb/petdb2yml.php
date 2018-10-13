<?php
/**
 * To convert pet_db.txt to YAML file
 *
 * Usage by default will use input and out in petdb2config.php
 * or by passing the arguments:
 * -i="path/to/rathena/re_or_pre/pet_db.txt" => input file
 * -o="filename"                             => output file
 * Example:
 * php petdb2yml.php -i="D:/rathena/re/pet_db.txt" -o="pet_db.yml"
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
