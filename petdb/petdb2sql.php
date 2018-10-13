<?php
/**
 * To convert pet_db.txt to SQL queries
 *
 * PHP version 5.2.0+
 *
 * LICENSE: See LICENSE in root folder
 *
 * @author     Cydh
 */
require_once 'petdbconfig.php';
$table_name = "pet_db";

foreach ($db as $mode => $thisdb) {
    $fp = fopen($thisdb['output']['sql'], "w+");
    if (!$fp) {
        print("... cannot create output file ".$thisdb['output']['sql']."\n");
        continue;
    }
    fputs($fp,"CREATE TABLE IF NOT EXISTS `$table_name` (
  `MobID` SMALLINT(5) UNSIGNED NOT NULL,
  `Name` TEXT NULL,
  `TameWithID` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
  `EggItemID` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
  `EquipItemID` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
  `FoodItemID` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
  `Fullness` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '100',
  `HungryDelay` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '60',
  `Start` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '250',
  `Fed` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '20',
  `Overfed` SMALLINT(5) NOT NULL DEFAULT '-100',
  `Hungry` SMALLINT(5) NOT NULL DEFAULT '-20',
  `OwnerDie` SMALLINT(5) NOT NULL DEFAULT '-20',
  `CaptureRate` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '2000',
  `Speed` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '150',
  `SpecialPerformance` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
  `TalkConvertClass` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
  `AttackRate` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
  `RetaliateRate` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
  `ChangeTargetRate` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
  `Script` TEXT NULL,
  `SupportScript` TEXT NULL,
  PRIMARY KEY (`MobID`)
) ENGINE=MyISAM;

");
    foreach ($thisdb['db'] as $entry) {
        $sql = "REPLACE INTO `$table_name` VALUES(";
        $i = 0;
        foreach ($entry as $key => $value) {
            if ($i)
                $sql .= ",";
            if ($key == "Intimacy" && is_array($value)) {
                $sql .= "'".$value['Start']."','".$value['Fed']."','".$value['Overfed']."','".$value['Hungry']."','".$value['OwnerDie']."'";
            }
            else
                $sql .= "'".$value."'";
            $i++;
        }
        $sql .= ");";
        fputs($fp, $sql."\r\n");
    }
    fclose($fp);
}
