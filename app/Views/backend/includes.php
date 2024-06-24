<?php
use CodeIgniter\Database\Config;

$db = Config::connect();

//////////LOADING SYSTEM SETTINGS FOR ALL PAGES AND ACCOUNTS/////////
$system_title = $db->table('settings')->getWhere(['type' => 'system_title'])->getRow()->description;
$session = $db->table('settings')->getWhere(['type' => 'session'])->getRow()->description;
?>