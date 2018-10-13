<?php
require_once 'petdbconfig.php';

foreach ($db as $mode => $thisdb) {
    $json = json_encode($thisdb['db'], JSON_PRETTY_PRINT|JSON_NUMERIC_CHECK);
    file_put_contents($thisdb['output']['json'], $json."\r\n");
}
