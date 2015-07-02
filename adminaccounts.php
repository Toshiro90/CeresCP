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

session_start();
include_once 'config.php'; // loads config variables
include_once 'lib/query.php'; // imports queries
include_once 'lib/adminquery.php';
include_once 'lib/functions.php';

if (!isset($_SESSION[$CONFIG_name.'level']) || $_SESSION[$CONFIG_name.'level'] < $CONFIG['cp_admin'])
	die ('Not Authorized');

if (!isset($GET_frm_name) && !isset($GET_page)) {
	caption($lang['ADMIN_ACCS']);
	echo '
	<form id="accounts" onSubmit="return GET_ajax(\'adminaccounts.php\',\'accounts_div\',\'accounts\');">
		<table class="maintable" style="width: auto">
			<tr>
				<td>'.$lang['SEARCH'].'</td><td>
				<input type="text" name="termo" maxlength="23" size="23">
				<select name="tipo">
					<option value="1">'.$lang['ACCOUNT_ID'].'</option>
					<option selected="selected" value="2">'.$lang['USERNAME'].'</option>
					<option value="3">'.$lang['MAIL'].'</option>
					<option value="4">'.$lang['IP_ADDRESS'].'</option>
				</select></td><td>
				<input type="submit" name="search" value="'.$lang['SEARCH'].'"></td>
				<td><span title="'.$lang['SHOW_ALL'].'" class="link" onClick="return LINK_ajax(\'adminaccounts.php?page=0\',\'accounts_div\');">'.$lang['SHOW_ALL'].'</span></td>
			</tr>
		</table>
	</form>

	<div id="accounts_div" style="color:#000000">';
	$begin = 1;
}

if (isset($GET_tipo)) {
	if (inject($GET_tipo))
		alert($lang['INCORRECT_CHARACTER']);

	if (strlen($GET_termo) < 3)
		alert(sprintf($lang['ADMIN_TYPE_MIN_CHARS'], 3));

	switch($GET_tipo) {
		case 1:
			$query = sprintf(ACCOUNTS_SEARCH_ACCOUNT_ID, trim($GET_termo));
			break;
		case 3:
			$query = sprintf(ACCOUNTS_SEARCH_EMAIL, trim($GET_termo));
			break;
		case 4:
			$query = sprintf(ACCOUNTS_SEARCH_IP, trim($GET_termo));
			break;
		default:
			$query = sprintf(ACCOUNTS_SEARCH_USERID, trim($GET_termo));
			break;
	}
	$pages = 0;
	$back = 'frm_name='.$GET_frm_name.'&tipo='.$GET_tipo.'&termo='.$GET_termo;
} else {
	if (!isset($GET_page))
		$GET_page = 0;
	else if (notnumber($GET_page))
		alert($lang['INCORRECT_CHARACTER']);


	$query = sprintf(TOTALACCOUNTS);
	$result = execute_query($query, 'adminaccounts.php');
	$result->fetch_row();
	$pages = (int)($result->row(0) / 100);
	
	$inicio = $GET_page * 100;
	$query = sprintf(ACCOUNTS_BROWSE, $inicio);

	$back = 'page='.$GET_page;
}

$back = base64_encode($back);
$result = execute_query($query, 'adminaccounts.php');

echo '
<table class="maintable">
	<tr>
		<th align="right">'.$lang['ACCOUNT_ID'].'</th>
		<th align="left">'.$lang['USERNAME'].'</th>
		<th align="center">'.$lang['SEX'].'</th>
		<th align="left">'.$lang['MAIL'].'</th>
		<th align="center">'.$lang['LEVEL'].'</th>
		<th align="left">'.$lang['IP_ADDRESS'].'</th>
		<th align="center">BAN</th>
	</tr>
	';

while ($line = $result->fetch_row()) {
	if (strcmp($line[2], "S") === 0)
		continue;

	if ($line[7] > 0)
		$ban = '<span style="color:#f00;">#</font>';
	elseif ($line[6] > time())
		$ban = '<span style="color:#fa0;">#</font>';
	else
		$ban = '-';
	
	if (strlen($line[3]) < 24)
		$email = $line[3];
	else
		$email = substr($line[3], 0, 21).'...';

	echo '
	<tr>
		<td align="right">'.$line[0].'</td>
		<td align="left">'.htmlformat($line[1]).'</td>
		<td align="center">'.$line[2].'</td>
		<td align="left"><span title="'.htmlformat($line[3]).'" style="cursor:pointer">'.htmlformat($email).'</span></td>
		<td align="center">'.$line[4].'</td>
		<td align="left">'.$line[5].'</td>
		<td align="center">'.$ban.'</td>
		<td align="center">
		<span title="'.$lang['EDIT'].'" class="link" onClick="return LINK_ajax(\'adminaccedit.php?id='.$line[0].'&back='.$back.'\',\'accounts_div\');">'.$lang['EDIT'].'</span></td>
		<td align="center">
		<span title="'.$lang['ADMIN_ACCS_CHARS_EXPL'].'" class="link" onClick="return LINK_ajax(\'adminaccchars.php?id='.$line[0].'&back='.$back.'\',\'accounts_div\');">'.$lang['ADMIN_ACCS_CHARS'].'</span></td>
		<td align="center">
		<span title="'.$lang['ADMIN_ACCS_BAN_UNBAN_EXPL'].'" class="link" onClick="return LINK_ajax(\'adminaccban.php?id='.$line[0].'&back='.$back.'\',\'accounts_div\');">'.$lang['ADMIN_ACCS_BAN_UNBAN'].'</span></td>
	</tr>
	';
}
echo '</table>';

if ($pages) {
	echo '
	<table class="maintable">
		<tr>
			<td>
				<span title="0" class="link" onClick="return LINK_ajax(\'adminaccounts.php?page=0\',\'accounts_div\');">&lt;&lt;</span>';

	for ($i = ($GET_page - 10); $i <= ($GET_page + 10); $i++) {
		echo ' ';
		if ($i >= 0 && $i != $GET_page && $i <= $pages)
			echo '<span title="'.$i.'" class="link" onClick="return LINK_ajax(\'adminaccounts.php?page='.$i.'\',\'accounts_div\');">'.$i.'</span>';
		else if ($i == $GET_page)
			echo '<b>'.$i.'</b>';
	}

	echo '
				<span title="'.$pages.'" class="link" onClick="return LINK_ajax(\'adminaccounts.php?page='.$pages.'\',\'accounts_div\');">&gt;&gt;</span>
			</td>
		</tr>
	</table>';
}


if (isset($begin)) {
	echo '</div>';
}

fim();
?>
