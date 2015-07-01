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

include_once './language/language.php';
include_once 'classes.php';

if (isset($_SESSION[$CONFIG_name.'SERVER'])) {
	if (strcmp($_SESSION[$CONFIG_name.'SERVER'], $CONFIG_name)) {
		session_destroy();
		die();
	}
} else {
	$_SESSION[$CONFIG_name.'SERVER'] = $CONFIG_name;
}

$mysql = new QueryClass($CONFIG_rag_serv, $CONFIG_rag_user, $CONFIG_rag_pass, $CONFIG_rag_db, $CONFIG_cp_serv, $CONFIG_cp_user, $CONFIG_cp_pass, $CONFIG_cp_db, $CONFIG_log_db);

if (!isset($_SESSION[$CONFIG_name.'ipban']) || (isset($_SESSION[$CONFIG_name.'iptime']) && (time() - $_SESSION[$CONFIG_name.'iptime']) > 300)) {
	include_once 'ipban.php';
	$_SESSION[$CONFIG_name.'ipban'] = ipban();
	$_SESSION[$CONFIG_name.'iptime'] = time();
}

if ($_SESSION[$CONFIG_name.'ipban'])
	die("Denied");

if (!isset($_SESSION[$CONFIG_name.'jobs']))
	$_SESSION[$CONFIG_name.'jobs'] = readjobs();

if (!isset($_SESSION[$CONFIG_name.'castles']))
	$_SESSION[$CONFIG_name.'castles'] = readcastles();

if ($CONFIG['cp_admin'] < 10)
	$CONFIG['cp_admin'] = 100;

function readcastles() {
	global $lang;
	$handle = fopen("./db/castles.txt", "rt")
		or die(htmlformat($lang['TXT_ERROR']));
	while ($line = fgets($handle, 1024)) {
		if (($line[0] == '/' && $line[1] == '/') || $line[0] == "\0" || $line[0] == "\n" || $line[0] == "\r")
			continue;
		$job = sscanf($line, "%d %s");
		if (isset($job[0]) && isset($job[1])) {
			for($i = 1; isset($job[1][$i]); $i++)
				if ($job[1][$i] == '_') $job[1][$i] = ' ';
			$resp[$job[0]] = $job[1];
		}
	}	
	fclose($handle);
	return $resp;
}

function is_woe() {
	global $CONFIG_woe_time;
	$wdaynow = date('w');
	$wtimenow = date('Hi');
	$week_day = array (
		0  => 'sun',
		1  => 'mon',
		2  => 'tue',
		3  => 'wed',
		4  => 'thu',
		5  => 'fri',
		6  => 'sat'
	);

	$woe_times = explode(";", $CONFIG_woe_time);
	for ($i = 0; isset($woe_times[$i]); $i++) {
		$woe_times[$i] = str_replace("(", ",", $woe_times[$i]);
		$woe_times[$i] = str_replace(")", "", $woe_times[$i]);
		$woe_times[$i] = str_replace(" ", "", $woe_times[$i]);
		$woe_times[$i] = explode(",", $woe_times[$i]);
		if (!isset($woe_times[$i][2]))
			continue;

		if (strcasecmp($woe_times[$i][0], $week_day[$wdaynow]) == 0) {
			if (($wtimenow > $woe_times[$i][1]) && ($wtimenow < $woe_times[$i][2]))
				return TRUE;
		}
	}

	return FALSE;
}

function ret_woe_times() {
	global $CONFIG_woe_time, $lang;

	$week_day = array (
		'sun' => $lang['SUNDAY'],
		'mon' => $lang['MONDAY'],
		'tue' => $lang['TUESDAY'],
		'wed' => $lang['WEDNSDAY'],
		'thu' => $lang['THURSDAY'],
		'fri' => $lang['FRIDAY'],
		'sat' => $lang['SATURDAY']
	);

	$woe_times = explode(";", $CONFIG_woe_time);
	for ($i = 0; isset($woe_times[$i]); $i++) {
		$woe_times[$i] = str_replace('(', ',', $woe_times[$i]);
		$woe_times[$i] = str_replace(')', '', $woe_times[$i]);
		$woe_times[$i] = str_replace(' ', '', $woe_times[$i]);
		$woe_times[$i] = explode(',', $woe_times[$i]);
		if (!isset($woe_times[$i][2]))
			continue;

		$day = $week_day[$woe_times[$i][0]];
		$start = $woe_times[$i][1];
		$end = $woe_times[$i][2];
		echo '<tr><td align="right">'.$day.'</td><td>&nbsp;</td><td align="left">'.$start.' - '.$end.'</td></tr>';
	}
}

function readitems() {
	global $lang;
	$resp[] = $lang['UNKNOWN'];
	if (!($handle = fopen('./db/item_db.txt', 'rt')))
		return $resp;
	while ($line = fgets($handle, 1024)) {
		if (($line[0] == '/' && $line[1] == '/') || $line[0] == "\0" || $line[0] == "\n" || $line[0] == "\r")
			continue;
		$item = explode(',', $line, 4);
		if (isset($item[0]) && isset($item[2])) {
			$resp[$item[0]] = $item[2];
		}
	}	
	$resp[0] = ' ';
	fclose($handle);
	return $resp;
}

function readjobs() {
	global $lang;

	$resp[] = $lang['UNKNOWN'];
	$handle = fopen('./db/jobs.txt', 'rt')
		or die(htmlformat($lang['TXT_ERROR']));
	while ($line = fgets($handle, 1024)) {
		if (($line[0] == '/' && $line[1] == '/') || $line[0] == "\0" || $line[0] == "\n" || $line[0] == "\r")
			continue;
		$job = sscanf($line, '%s %d');
		if (isset($job[0]) && isset($job[1])) {
			for($i = 1; isset($job[0][$i]); $i++)
				if ($job[0][$i] == '_') $job[0][$i] = ' ';
			$resp[$job[1]] = $job[0];
		}
	}	
	fclose($handle);
	return $resp;
}

function htmlformat($string) {
	$resp = '';
	for ($i = 0; isset($string[$i]) && ord($string[$i]) > 0; $i++)
		$resp .= '&#'.ord($string[$i]).';';
	return $resp;
}

function moneyformat($string) {
	$string = trim($string);
	$return = '';
	$len = strlen($string) - 1;

	for ($i = 0; $i < strlen($string); $i++) {
		if ($i > 0 && $i % 3 == 0)
			$return = ','.$return;
		$return = $string[$len - $i].$return;
	}

	return $return;
}

function inject($string) {
	$permitido = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890.@$&-_/§*°ºª'; //dicionario de palavras permitidas
	for ($i=0; $i<strlen($string); $i++) {
		if (strpos($permitido, substr($string, $i, 1)) === FALSE) return TRUE;
	}
	return FALSE;
}

function notnumber($string) {
	$permitido = '1234567890'; //numeros
	for ($i=0; $i<strlen($string); $i++) {
		if (strpos($permitido, substr($string, $i, 1)) === FALSE) return TRUE;
	}
	return FALSE;
}

function thepass($string) {
	global $lang;

	$string = trim($string);

	$numero = 0;
	for ($i = 0; isset($string[$i]); $i++) {
		if (!notnumber($string[$i]))
			$numero++;
	}

	if ($numero < 2)
		return TRUE;
	if ($numero == strlen($string))
		return TRUE;
	if ((strlen($string) - $numero) < 2)
		return TRUE;

	$handle = fopen('./db/passdict.txt', 'rt')
		or die(htmlformat($lang['TXT_ERROR']));
	while ($line = fgets($handle, 1024)) {
		if (($line[0] == '/' && $line[1] == '/') || $line[0] == "\0" || $line[0] == "\n" || $line[0] == "\r")
			continue;
		if (strcmp(trim($string), trim($line)) === 0) {
			fclose($handle);
			return TRUE;
		}
	}	
	fclose($handle);

	return FALSE;
}

function truedate($day, $month, $year) {
	$diames = array (
		1  => 31,
		2  => 28,
		3  => 31,
		4  => 30,
		5  => 31,
		6  => 30,
		7  => 31,
		8  => 31,
		9  => 30,
		10 => 31,
		11 => 30,
		12 => 31,
	);
	if (($year % 4) === 0)
		$diames[2] = 29;

	if ($day > $diames[$month])
		return 0;

	return mktime(0, 0, 0, $month, $day, $year);
}

function is_online() {
	global $CONFIG_name, $lang;

	if (empty($_SESSION[$CONFIG_name.'account_id'])) 
		redir('motd.php', 'main_div', htmlformat($lang['NEED_TO_LOGIN_F']));

	$log_account = $_SESSION[$CONFIG_name.'account_id'];

	$query = sprintf(IS_ONLINE, $log_account);
	$result = execute_query($query, 'is_online');

	$result->fetch_row();

	return $result->row[0];
}

function online_count() {
	$query = sprintf(GET_ONLINE);
	$result = execute_query($query, 'online_count', 0, 0);

	$result->fetch_row();

	return $result->row[0];
}

function check_ban() {
	$query = sprintf(CHECK_BAN, $_SERVER['REMOTE_ADDR']);
	$result = execute_query($query, 'check_ban', 0, 0);

	if ($result->count()) {
		while ($line = $result->fetch_row()) {
			if (($line[2] == 5 || $line[1] > 0) && (time() - $line[0]) < (86400 * 2)) //2 dias
				return 1;
		}
	}

	return 0;
}

function forger($hint, $lint) {
	if ($hint<0)
		$hint = 0xFFFF+1+$hint;
	$result = ($hint)|($lint << 0x10);
	return $result;
}
function petegg($hint) {
	return forger($hint, 0);
}

function execute_query($query, $source = 'none.php', $database = 0, $save_report = 1) {
	global $mysql;

	$query = str_replace("\r\n", " ", $query);
	if ($save_report)
		add_query_entry($source, $query);

	if ($result = $mysql->Query($query, $database)) {
		if (strpos($query,"SELECT") === 0)
			return $result;
		return TRUE;
	}
	return FALSE;
}

function add_query_entry($source, $log_query) {
	global $CONFIG_name, $CONFIG_cp_db, $CONFIG_rag_serv, $CONFIG_rag_user, $CONFIG_rag_pass;
	if (!empty($_SESSION[$CONFIG_name.'account_id'])) 
		$log_account = $_SESSION[$CONFIG_name.'account_id'];
	else
		$log_account = 0;
	$log_ip = $_SERVER['REMOTE_ADDR'];
	$log_query = addslashes($log_query);
	$query = sprintf(ADD_QUERY_ENTRY, $log_account, $log_ip, $source, $log_query);

	execute_query($query, 'none.php', 1, 0);
}

// o retorno eh em compara?o binaria
// ($var & 1) - se TRUE login online
// ($var & 2) - se TRUE char  online
// ($var & 4) - se TRUE map   online
function server_status() {
	global $CONFIG_accip,$CONFIG_accport,$CONFIG_charip,$CONFIG_charport,$CONFIG_mapip,$CONFIG_mapport;

	$query = CHECK_STATUS;
	$result = execute_query($query, 'server_status', 1, 0);
	if (!($line = $result->fetch_row())) {
		$query = INSERT_STATUS;
		$result = execute_query($query, 'server_status', 1, 0);
		$line[0] = 0;
	}
	$retorno = 0;
	if ($line[2] > 300 || $line[1] < 7) {
		$acc = @fsockopen ($CONFIG_accip, $CONFIG_accport, $errno, $errstr, 1);
		$char = @fsockopen ($CONFIG_charip, $CONFIG_charport, $errno, $errstr, 1);
		$map = @fsockopen ($CONFIG_mapip, $CONFIG_mapport, $errno, $errstr, 1);
		if ($acc > 1) $retorno += 1;
		if ($char > 1) $retorno += 2;
		if ($map > 1) $retorno += 4;
		$query = sprintf(UPDATE_STATUS, $retorno);
		$result = execute_query($query, "server_status", 1, 0);
	}
	else {
		$retorno = $line[1];
	}
	return $retorno;
}

function redir($page, $div, $msg, $title='Status') {
	if ($title != '')
		caption($title);

	echo '
	<table class="maintable">
		<tr>
			<td>
				<span class="link" onClick="return LINK_ajax(\''.$page.'\',\''.$div.'\')"><b>'.$msg.'</span>
			</td>
		</tr>
	</table>';
	fim();
}

function alert($alertmsg) {
	$trans_tbl = get_html_translation_table (HTML_ENTITIES);
	$trans_tbl = array_flip ($trans_tbl);
	$alertmsg = strtr ($alertmsg, $trans_tbl);

	echo 'ALERT|'.$alertmsg.'|ENDALERT';
	fim();
}

function fim() {
	global $mysql;
	$mysql->finish();
	exit(0);
}

function caption($s) {
	print '<h3 class="title">'.$s.'</h3>';
}

function read_maildef($file) {
	global $lang;
	$handle = fopen('./language/mail/'.$file.'.txt', 'rt')
		or die(htmlformat($lang['TXT_ERROR']));
	$maildef='';
	while ($line = fgets($handle, 1024)) {
		if ($line[0] == '/' && $line[1] == '/')
			continue;
		$maildef .= $line;
	}
	fclose($handle);
	return $maildef;
}

function erro_de_login($i = 0) {
	session_destroy();
	setcookie('login_pass', '', time() - 3600);
	setcookie('userid', '', time() - 3600);
	session_start();
	echo '<script type="text/javascript">
		LINK_ajax(\'login.php\', \'login_div\');';
	if (!$i)
		echo 'LINK_ajax(\'motd.php\',\'main_div\');';
	echo '</script>';
}

function item_has_pet_data($card0) {
	return ($card0 == -256 || $card0 == 256 || $card0 == 65280);
}

function item_has_forge_data($card0) {
	return ($card0 == 255);
}

function item_has_signed_data($card0) {
	return ($card0 == 254);
}

function get_item_name($id) {
	global $lang, $items;

	$name = '';
	if (isset($items[$id]) && $items[$id]!='')
		$name = $items[$id];
	else if ($id > 0)
		$name = '<span style="color: #777777; font-style: italic">('.$lang['UNKNOWN'].', #'.$id.')</span>';
	
	return $name;
}

function print_items($result) {
	global $lang;

	echo '
		<table class="maintable" style="width: 610px">
		<tr>
			<th></th>
			<th align="center">Item Name</th>
			<th align="center">Amount</th>
			<th align="center">Card0</th>
			<th align="center">Card1</th>
			<th align="center">Card2</th>
			<th align="center">Card3</th>
		</tr>
	';
	while ($item = $result->fetch_assoc()) {

		$itemname = '';
		if ($item['refine'] > 0)
			$itemname .= '+'.$item['refine'].' ';

		$itemname .= get_item_name($item['nameid']);

		echo '
			<tr>
				<td align="center">'.(isset($item['equip'])&&$item['equip']?'Eq.':'').'</td>
				<td align="left">'.get_item_icon($item['nameid']).$itemname.'</td>
				<td align="right">'.$item['amount'].'</td>
		';

		if (item_has_signed_data($item['card0']) || item_has_forge_data($item['card0'])) {
			$query2 = sprintf(GET_CHARNAME, $charid=forger($item['card2'], $item['card3']));
			$result2 = execute_query($query2, 'storage.php');
			if ($result2->count())
				$chname = htmlformat($result2->row(0));
			else $chname = '<span style="color: #777777; font-style: italic">('.$lang['UNKNOWN'].', #'.$charid.')</span>';

			echo '
				<td colspan="4" style="text-align: center">
					'.(item_has_signed_data($item['card0'])?'signed':'forged').' by '.$chname.'</td>
				</tr>
			';
		}
		else if (item_has_pet_data($item['card0'])) {
			$query2 = sprintf(GET_PETNAME, $petid=forger($item['card1'], $item['card2']));
			$result2 = execute_query($query2, 'admincharinfo.php');
			$result2->fetch_row();
			
			if ($result2->count())
				$petname = htmlformat($result2->row(0));
			else
				$petname = '<span style="color: #777777; font-style: italic">('.$lang['UNKNOWN'].', #'.$petid.')</span>';
			
			echo '
				<td colspan="4" style="text-align: center">
					Pet: '.$petname.'</td>
				</tr>
			';
		}
		else {
			echo '
			<td align="center">'.get_item_icon($item['card0']).get_item_name($item['card0']).'</td>
			<td align="center">'.get_item_icon($item['card1']).get_item_name($item['card1']).'</td>
			<td align="center">'.get_item_icon($item['card2']).get_item_name($item['card2']).'</td>
			<td align="center">'.get_item_icon($item['card3']).get_item_name($item['card3']).'</td>';
		}
		echo '
		</tr>';
	}
	echo '</table>';
}

function get_item_icon($id) {
	global $CONFIG_item_icon_path;
	if (isset($CONFIG_item_icon_path) && $CONFIG_item_icon_path != '') {
		if ($id > 0) {
			return '<img src="'.sprintf($CONFIG_item_icon_path, $id).'" class="item" />';
		}
		else {
			// Empty block to not mess up layout
			return '<div class="item"></div>';
		}
	}
	else
		return '';
}

?>
