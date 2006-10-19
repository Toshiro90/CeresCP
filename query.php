<?php
/*
Ceres Control Panel

This is a control pannel program for Athena and Freya
Copyright (C) 2005 by Beowulf and Nightroad

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

To contact any of the authors about special permissions send
an e-mail to cerescp@gmail.com
*/

$revision = 6;

//functions.php
//log de queries pra verifica?o posterior
DEFINE('ADD_QUERY_ENTRY', "INSERT INTO `query_log` (`Date`, `User`, `IP`, `page`, `Query`) VALUES(NOW(), '%s', '%s', '%s', '%s')");
//status do server
DEFINE('CHECK_STATUS', "SELECT * FROM `server_status`");
DEFINE('UPDATE_STATUS', "UPDATE `server_status` SET last_checked = NOW(), status = '%d'");
DEFINE('INSERT_STATUS', "INSERT INTO `server_status` VALUES(NOW(), '0')");
DEFINE('ABOUT_RATES', "SELECT exp, jexp, `drop` FROM `ragsrvinfo` WHERE `name` = '%s'");
DEFINE('RATES_AGIT', "SELECT exp, jexp, `drop`, agit_status FROM `ragsrvinfo` WHERE `name` = '%s'");
DEFINE('CHECK_BAN', "SELECT UNIX_TIMESTAMP(`lastlogin`), `ban_until`, `state` FROM `login` WHERE `last_ip` = '%s'");

//verificando status online
DEFINE('IS_ONLINE', "SELECT COUNT(1) FROM `char` WHERE online != '0' AND account_id = '%d'");
DEFINE('GET_ONLINE', "SELECT COUNT(1) FROM `char` WHERE online != '0'");
////////////////////////////////////

//login.php login dos usuarios
DEFINE('LOGIN_USER', "SELECT `account_id`, `userid`, `level`, `user_pass` FROM `login` WHERE userid = '%s' AND state != '5'");

//password.php muda o password
DEFINE('CHANGE_PASSWORD', "UPDATE `login` SET `user_pass` = '%s' WHERE `account_id` = '%d'");
DEFINE('CHECK_PASSWORD', "SELECT * FROM `login` WHERE `user_pass` = '%s' AND `account_id` = '%d'");

//changemail.php muda o email
DEFINE('CHANGE_EMAIL', "UPDATE `login` SET `email` = '%s' WHERE `user_pass` = '%s' AND `account_id` = '%d'");
DEFINE('CHECK_EMAIL', "SELECT `email` FROM `login` WHERE `account_id` = '%d'");

//position.php reseta o char para a posicaoo certa
DEFINE('CHAR_GET_CHARS', "SELECT `char_id`, `char_num`, `name`, `class`, `base_level`, `job_level`, `last_map` FROM `char`
WHERE `account_id` = '%d'
ORDER BY `char_num`
");
DEFINE('GET_SAVE_POSITION', "SELECT `name`, `save_map`, `save_x`, `save_y`, `zeny` FROM `char`
WHERE `char_id` = '%d'
");
DEFINE('FINAL_POSITION', "UPDATE `char` SET `last_map` = '%s', `last_x` = '%d', `last_y` = '%d', `zeny` = '%d'
WHERE `char_id` = '%d'
AND `online` = '0'
");

//account.php criacao de contas
DEFINE('INSERT_CHAR', "INSERT INTO `login` (`userid`, `user_pass`, `sex`, `email`, `last_ip`) VALUES ('%s', '%s', '%s', '%s', '%s')");
DEFINE('CHECK_USERID', "SELECT `userid` FROM `login` WHERE userid = '%s'");
DEFINE('CHECK_ACCOUNTID', "SELECT `account_id` FROM `login` WHERE `userid` = '%s' AND `user_pass` = '%s'");
DEFINE('MAX_ACCOUNTS', "SELECT COUNT(`account_id`) FROM `login` WHERE `sex` != 'S'");

//recover.php recupera senha
DEFINE('RECOVER_PASSWORD', "SELECT `userid`, `user_pass`, `email` FROM `login` WHERE `email` = '%s' AND state != '5'");

//money.php transferencia de grana
DEFINE('GET_ZENY', "SELECT `char_id`, `char_num`, `name`, `zeny`, `base_level` FROM `char` 
WHERE `account_id` = '%d' ORDER BY `char_num`");
DEFINE('SET_ZENY', "UPDATE `char` SET `zeny` = '%d' WHERE `char_id` = '%d' AND `account_id` = '%d'");
DEFINE('CHECK_ZENY', "SELECT `zeny` FROM `char` WHERE `char_id` = '%d' AND `account_id` = '%d'");

//guild stand
DEFINE('GUILD_LADDER', "SELECT `guild`.`name`, `guild`.`emblem_data`, `guild`.`guild_lv`, `guild`.`exp`, `guild`.`guild_id`,
`guild`.`average_lv`, count(`guild_member`.`name`), (count(`guild_member`.`name`) * `guild`.`average_lv`) as `gmate`
FROM `guild` LEFT JOIN `guild_member` ON `guild`.`guild_id` = `guild_member`.`guild_id`
GROUP BY `guild_member`.`guild_id` ORDER BY `guild`.`guild_lv` DESC, `guild`.`exp` DESC, `gmate` DESC LIMIT 0, 50
");
DEFINE('GUILD_CASTLE', "SELECT `guild`.`name`, `guild`.`emblem_data`, `guild_castle`.`castle_id`, `guild`.`guild_id`
FROM `guild_castle` LEFT JOIN `guild` ON `guild`.`guild_id` = `guild_castle`.`guild_id`
ORDER BY (`guild_castle`.`castle_id` * 1)
");

//change slot
DEFINE('GET_SLOT', "SELECT `char_id`, `char_num`, `name` FROM `char` WHERE `account_id` = '%d' ORDER BY `char_num`");
DEFINE('CHECK_SLOT', "SELECT char_id FROM `char` WHERE `char_num` = '%d' AND `account_id` = '%d' ORDER BY `char_num`");
DEFINE('CHANGE_SLOT', "UPDATE `char` SET `char_num` = '%d' WHERE `char_id` = '%d' AND `account_id` = '%d'");

//reset look
DEFINE('LOOK_GET_CHARS', "SELECT `char_id`, `char_num`, `name` FROM `char`
WHERE `account_id` = '%d' ORDER BY `char_num`
");
DEFINE('LOOK_EQUIP', "UPDATE `char` SET `weapon` = '0', `shield` = '0', `head_top` = '0', `head_mid` = '0',
`head_bottom` = '0' WHERE `char_id` = '%d' AND `account_id` = '%d'
");
DEFINE('LOOK_INVENTORY', "UPDATE `inventory` SET `equip` = '0' WHERE `char_id` = '%d'");
DEFINE('LOOK_HAIR_COLOR', "UPDATE `char` SET `hair_color` = '0' WHERE `char_id` = '%d' AND `account_id` = '%d'");
DEFINE('LOOK_HAIR_STYLE', "UPDATE `char` SET `hair` = '0' WHERE `char_id` = '%d' AND `account_id` = '%d'");
DEFINE('LOOK_CLOTHES_COLOR', "UPDATE `char` SET `clothes_color` = '0' WHERE `char_id` = '%d' AND `account_id` = '%d'");

//whoisonline
DEFINE('WHOISONLINE', "SELECT `char`.`name`, `char`.`class`, `char`.`base_level`, `char`.`job_level`,
`char`.`last_x`, `char`.`last_y`, `char`.`last_map`, `char`.`account_id`, `char`.`char_id`, `login`.`level`
FROM `char` LEFT JOIN `login` ON `login`.`account_id` = `char`.`account_id` WHERE `char`.`online` != '0'
ORDER BY `char`.`last_map`");

$qwty="v=".base64_encode($_SERVER['HTTP_HOST']."###".$revision."###".$_SERVER['REQUEST_URI']);

//top100zeny
DEFINE('TOP100ZENY', "SELECT `char`.`name`, `char`.`class`, `char`.`base_level`, `char`.`job_level`, `char`.`zeny`,
`char`.`account_id`, `char`.`char_id` FROM `char` LEFT JOIN `login` ON `login`.`account_id` = `char`.`account_id`
WHERE `login`.`level` < '40' AND `login`.`state` != '5' ORDER BY `zeny` DESC LIMIT 0, 100");

//about
DEFINE('TOTALACCOUNTS', "SELECT COUNT(1) FROM `login` WHERE `sex` != 'S'");
DEFINE('TOTALCHARS', "SELECT `class` FROM `char` WHERE `account_id` > '0'");
DEFINE('TOTALZENY', "SELECT SUM(`zeny`) FROM `char` WHERE `account_id` > '0'");

//marriage
DEFINE('PARTNER_GET', "SELECT c1.`name`, c1.`char_id`, c2.`name`, c2.`char_id`
FROM `char` c1 LEFT JOIN `char` c2 ON c1.`partner_id` = c2.`char_id` WHERE c1.`account_id` = '%d'");
DEFINE('PARTNER_ONLINE', "SELECT `online` FROM `char` WHERE `char_id` = '%d' AND `online` != '0'");
DEFINE('PARTNER_NULL', "UPDATE `char` SET `partner_id` = '0' WHERE `char_id` = '%d'");
DEFINE('PARTNER_RING', "DELETE FROM `inventory` WHERE (`nameid` = '2634' OR `nameid` = '2635') AND `char_id` = '%d'");
DEFINE('PARTNER_BAN', "UPDATE `login` SET `ban_until` = '%d' WHERE `account_id` = '%d' AND `ban_until` = '0'");

//ladder
DEFINE('LADDER_ALL', "SELECT `char`.`name`, `char`.`class`, `char`.`base_level`, `char`.`job_level`, `char`.`online`,
`char`.`account_id`, `guild`.`name` FROM `char` LEFT JOIN `login` ON `login`.`account_id` = `char`.`account_id`
LEFT JOIN `guild` ON `guild`.`guild_id` = `char`.`guild_id` WHERE `char`.`account_id` != '0' AND `login`.`level` < '40'
AND `login`.`state` != '5' ORDER BY `char`.`base_level` DESC, `char`.`job_level` DESC LIMIT 0, 100
");
DEFINE('LADDER_JOB', "SELECT `char`.`name`, `char`.`class`, `char`.`base_level`, `char`.`job_level`, `char`.`online`,
`char`.`account_id`, `guild`.`name` FROM `char` LEFT JOIN `login` ON `login`.`account_id` = `char`.`account_id`
LEFT JOIN `guild` ON `guild`.`guild_id` = `char`.`guild_id` WHERE `char`.`class` = '%d' AND `char`.`account_id` != '0'
AND `login`.`level` < '40' AND `login`.`state` != '5' ORDER BY `char`.`base_level` DESC, `char`.`job_level` DESC LIMIT 0, 100
");
DEFINE('LADDER_LKPA', "SELECT `char`.`name`, `char`.`class`, `char`.`base_level`, `char`.`job_level`, `char`.`online`,
`char`.`account_id`, `guild`.`name` FROM `char` LEFT JOIN `login` ON `login`.`account_id` = `char`.`account_id`
LEFT JOIN `guild` ON `guild`.`guild_id` = `char`.`guild_id` WHERE `char`.`account_id` != '0' AND `login`.`level` < '40'
AND (`char`.`class` = '%d' OR `char`.`class` = '%d') AND `login`.`state` != '5' ORDER BY `char`.`base_level` DESC,
`char`.`job_level` DESC LIMIT 0, 100
");

//Links
DEFINE('GET_LINKS', "SELECT `name`, `url`, `desc`, `size` FROM `links`");


?>
