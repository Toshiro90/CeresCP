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

if (isset($GET_frm_name) && isset($GET_id)) {
	$query = sprintf(ACCOUNTS_SEARCH_ACCOUNT_ID, trim($GET_id));
	$result = execute_query($query, 'adminaccban.php');
	if ($line = $result->fetch_row()) {
		$today = getdate();
		
		if (notnumber($GET_id))
			alert($lang['INCORRECT_CHARACTER']);

		if ($GET_bday == $today['mday'] && $GET_bmonth == $today['mon'] && $GET_byear == $today['year'])
			$ban = 0;
		else 
			$ban = truedate($GET_bday, $GET_bmonth, $GET_byear);

		if ($ban <= time())
			$ban = 0;
		
		if ($GET_block == 5)
			$ban = 0;

		if ($_SESSION[$CONFIG_name.'level'] <= $line[4] || ($line[4] >= $_SESSION[$CONFIG_name.'level'] && $_SESSION[$CONFIG_name.'level'] != 99)) {
			alert('Unable to update account.');
		}

		$query = sprintf(ACCBAN_UPDATE, $ban, $GET_block, trim($GET_id));
		$result = execute_query($query, 'adminaccban.php');

		alert('Account Updated');
	}
}

caption($lang['ADMIN_ACCS_BAN_BLOCK']);

if (isset($GET_back)) {
	$back = base64_decode($GET_back);
	echo '<center><span title="'.$lang['LINK_BACK'].'" class="link" onClick="return LINK_ajax(\'adminaccounts.php?'.$back.'\',\'accounts_div\');">&lt;- '.$lang['LINK_BACK'].'</span></center>';
}


if (isset($GET_id)) {
	if (notnumber($GET_id))
		alert($lang['INCORRECT_CHARACTER']);

	$query = sprintf(ACCOUNTS_SEARCH_ACCOUNT_ID, trim($GET_id));
	$result = execute_query($query, 'adminaccban.php');
	if ($line = $result->fetch_assoc()) {
		echo '
		<form id="accban" onSubmit="return GET_ajax(\'adminaccban.php\',\'accounts_div\',\'accban\');">
			<table class="maintable dataformat">
				<tr>
					<th align="right">'.$lang['ACCOUNT_ID'].':</th><td align="left">'.$line['account_id'].'<input type="hidden" name="id" value="'.$line['account_id'].'"></td>
				</tr>
				<tr>
					<th align="right">'.$lang['USERNAME'].':</th><td align="left">'.htmlformat($line['userid']).'</td>
				</tr>
				<tr>
					<th align="right">'.$lang['ADMIN_ACCBAN_LAST_LOGIN'].':</th><td align="left">'.$line['lastlogin'].'</td>
				</tr>
				<tr>
					<th align="right">'.$lang['ADMIN_ACCBAN_BAN_UNTIL'].':</th><td align="left"><select name="bday">
		';

		if ($line['unban_time'] > 0)
			$today = getdate($line['unban_time']);
		else
			$today = getdate();

		for ($i = 1; $i < 32; $i++) {
			if ($today['mday'] == $i)
				echo '<option selected="selected" value='.$i.'>'.$i;
			else
				echo '<option value='.$i.'>'.$i;
		}

		$i = $today['mon'];
		echo '
					</select>&nbsp;&nbsp;<select name="bmonth" id="selemes">';
		if ($i == 1)
			echo '<option selected="selected" value="1">'.$lang['JANUARY'];
		else
			echo '<option value="1">'.$lang['JANUARY'];
		if ($i == 2)
			echo '<option selected="selected" value="2">'.$lang['FEBRUARY'];
		else
			echo '<option value="2">'.$lang['FEBRUARY'];
		if ($i == 3)
			echo '<option selected="selected" value="3">'.$lang['MARCH'];
		else
			echo '<option value="3">'.$lang['MARCH'];
		if ($i == 4)
			echo '<option selected="selected" value="4">'.$lang['APRIL'];
		else
			echo '<option value="4">'.$lang['APRIL'];
		if ($i == 5)
			echo '<option selected="selected" value="5">'.$lang['MAY'];
		else
			echo '<option value="5">'.$lang['MAY'];
		if ($i == 6)
			echo '<option selected="selected" value="6">'.$lang['JUNE'];
		else
			echo '<option value="6">'.$lang['JUNE'];
		if ($i == 7)
			echo '<option selected="selected" value="7">'.$lang['JULY'];
		else
			echo '<option value="7">'.$lang['JULY'];
		if ($i == 8)
			echo '<option selected="selected" value="8">'.$lang['AUGUST'];
		else
			echo '<option value="8">'.$lang['AUGUST'];
		if ($i == 9)
			echo '<option selected="selected" value="9">'.$lang['SEPTEMBER'];
		else
			echo '<option value="9">'.$lang['SEPTEMBER'];
		if ($i == 10)
			echo '<option selected="selected" value="10">'.$lang['OCTOBER'];
		else
			echo '<option value="10">'.$lang['OCTOBER'];
		if ($i == 11)
			echo '<option selected="selected" value="11">'.$lang['NOVEMBER'];
		else
			echo '<option value="11">'.$lang['NOVEMBER'];
		if ($i == 12)
			echo '<option selected="selected" value="12">'.$lang['DECEMBER'];
		else
			echo '<option value="12">'.$lang['DECEMBER'];
			
		
		echo '</select>&nbsp;&nbsp;<select name="byear">';
		
		//$today = getdate();
		for ($i = $today['year']; $i < ($today['year'] + 5); $i++)
			echo '<option value="'.$i.'">'.$i;
		echo '
					</select></td>

				</tr>
				<tr>
					<th align="right">'.$lang['ADMIN_ACCBAN_BLOCK'].':</th><td align="left">
					<select name="block">';
		if ($line['state'] == 5)
			echo '<option selected="selected" value="5">'.$lang['ADMIN_ACCBAN_BLOCK'].'</option><option value="0">'.$lang['ADMIN_ACCBAN_UNBLOCK'].'</option>';
		else
			echo '<option value="5">'.$lang['ADMIN_ACCBAN_BLOCK'].'</option><option selected="selected" value="0">'.$lang['ADMIN_ACCBAN_UNBLOCK'].'</option>';

		echo '
					</seletc></td>
				</tr>
				<tr>
					<th></th><td align="left"><input type="submit" value="'.$lang['CHANGEMAIL_CHANGE'].'">
				</td></tr>
			</table>
		</form>
		';
	}

} else echo 'Not Found';

fim();
?>
