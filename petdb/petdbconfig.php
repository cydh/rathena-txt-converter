<?php
/**
 * Main parser to read rAthena pet_db.txt files
 *
 * This file is used to read pet_db.txt files of rAthena for
 * conversion purpose, to JSON or YAML. For converting to YAML, you
 * need PHP 7.2 as requirement of Symfony/YAML. But since YAML
 * parser able to read JSON file, you can simply convert it to JSON
 * format but with .yml file extension. Instead run this file,
 * you have to execute one of these files, petdb2json.php,
 * petdb2yml.php, or petdb2sql.php. The output file will be placed
 * in defined output config below.
 *
 * PHP version 5
 *
 * LICENSE: See LICENSE in root folder
 *
 * @author     Cydh
 */

/**
 * Replace the path to your local: "path/to/rathena/db/"
 * Example: "D:/rathena/db/"
 */
$root = "https://raw.githubusercontent.com/rathena/rathena/master/db/";
$outRoot = "../";

$dbpath = array();
$dbpath['re'] = array(
    'files' => array(
        'db' => $root.'re/pet_db.txt',
    ),
    'output' => array(
        'yml' => $outRoot.'db/re/pet_db.yml',
        'json' => $outRoot.'db/re/pet_db.yml',
        'sql' => $outRoot.'sql-files/pet_db_re.sql',
    ),
);
$dbpath['pre'] = array(
    'files' => array(
        'db' => $root.'pre-re/pet_db.txt',
    ),
    'output' => array(
        'yml' => $outRoot.'db/pre-re/pet_db.yml',
        'json' => $outRoot.'db/pre-re/pet_db.yml',
        'sql' => $outRoot.'sql-files/pet_db.sql',
    ),
);

$db = array();

function parseDB(&$thisdb, $filepath) {
    $fp = fopen($filepath, 'r');
    if (!$fp)
        return;
    $count = 0;
    while (!feof($fp)) {
        $data = fgets($fp);
        $data = trim($data);
        if (!$data)
            continue;
        $isComment = false;
        if ($data[0] == '/' || $data[1] == '/') {
            $data = substr($data,2);
            $isComment = true;
        }
        // MobID,Name,JName,LureID,EggID,EquipID,FoodID,Fullness,HungryDelay,R_Hungry,R_Full,Intimate,Die,Capture,Speed,S_Performance,talk_convert_class,attack_rate,defence_attack_rate,change_target_rate,pet_script,loyal_script
        if (!preg_match('/(\d+),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),([^,]*),\{([^\}]*)\},\{([^\}]*)\}/', $data, $col))
            continue;

        $id = (int)trim($col[1]);
        $temp = array();
        $temp['MobID'] = (int)$col[1];
        $temp['Name'] = $col[2];
        $temp['TameWithID'] = (int)$col[4];
        $temp['EggItemID'] = (int)$col[5];
        $temp['EquipItemID'] = (int)$col[6];
        $temp['FoodItemID'] = (int)$col[7];
        $temp['Fullness'] = (int)$col[8];
        $temp['HungryDelay'] = (int)$col[9];
        //$temp['HungerIncrease'] = 20;
        $temp['Intimacy'] = array(
            'Start' => (int)$col[12],
            'Fed' => (int)$col[10],
            'Overfed' => (int)$col[11]*-1,
            'Hungry' => -20,
            'OwnerDie' => (int)$col[13]*-1,
        );
        $temp['CaptureRate'] = (int)$col[14];
        $temp['Speed'] = (int)$col[15];
        $temp['SpecialPerformance'] = (int)$col[16];
        $temp['TalkConvertClass'] = (int)$col[17];
        $temp['AttackRate'] = (int)$col[18];
        $temp['RetaliateRate'] = (int)$col[19];
        $temp['ChangeTargetRate'] = (int)$col[20];
        $temp['Script'] = $col[21];
        $temp['SupportScript'] = $col[22];
        $thisdb[] = $temp;
        ++$count;
    }
    fclose($fp);
    return $count;
}

function cmp($a, $b) {
    if ($a == $b)
        return 0;
    return ($a['MobID'] < $b['MobID']) ? -1 : 1;
}

foreach ($dbpath as $mode => $entry) {
    $thisdb = array();
    foreach ($entry['files'] as $type => $filepath) {
        print "".$mode.": Open file ".$type." in ".$filepath."\n";
        switch ($type) {
            case 'db':
                print "... Done reading ".parseDB($thisdb, $filepath)." entries\n";
                break;
        }
    }
    usort($thisdb, "cmp");
    $db[$mode]['db'] = $thisdb;
    $db[$mode]['output'] = $entry['output'];
}
