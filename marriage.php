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
include_once 'lib/functions.php';

if (!empty($_SESSION[$CONFIG_name.'account_id'])) {
	if ($_SESSION[$CONFIG_name.'account_id'] > 0) {

		if (!empty($GET_opt)) {
			if ($GET_opt == 1 && $CONFIG_marry_enable) {
				// Currently logged in
				if (is_online())
					alert($lang['NEED_TO_LOGOUT_F']);

				if (isset($GET_divorce) && $GET_divorce > 0) {

					// Submitted IDs contain illegal characters
					if (inject($GET_GID1) && inject($GET_GID2))
						alert($lang['INCORRECT_CHARACTER']);

					// Fetch account id
					$query = sprintf(GET_ACCOUNT_ID, $GET_GID1);
					$result = execute_query($query, 'resetlook.php');
					list($accountid) = $result->fetch_row();

					// Not your character
					if ($accountid != $_SESSION[$CONFIG_name.'account_id'])
						alert($lang['MARRIAGE_DIVORCE_FAILED']);

					// Get partner id
					$query = sprintf(PARTNER_GET_CHAR, $GET_GID1);
					$result = execute_query($query, 'marriage.php');
					$line = $result->fetch_assoc();

					// You don't have a partner
					if (!$line['partner_id'])
						alert($lang['MARRIAGE_DIVORCE_FAILED']);

					// Not your partner
					if ($line['partner_id'] != $GET_GID2)
						alert($lang['MARRIAGE_DIVORCE_FAILED']);

					$query = sprintf(PARTNER_ONLINE, $GET_GID2);
					$result = execute_query($query, 'marriage.php');

					// Partner currently logged in
					if ($result->fetch_row())
						alert($lang['MARRIAGE_COUPLE_OFF']);

					$query = sprintf(PARTNER_NULL, $GET_GID1);
					$result = execute_query($query, 'marriage.php');

					$query = sprintf(PARTNER_NULL, $GET_GID2);
					$result = execute_query($query, 'marriage.php');

					$query = sprintf(PARTNER_RING, $GET_GID1);
					$result = execute_query($query, 'marriage.php');

					$query = sprintf(PARTNER_RING, $GET_GID2);
					$result = execute_query($query, 'marriage.php');

					$ban_length = 2 * 60; // 2 minutos pra fazer efeito //testando vicous pucca
					$query = sprintf(PARTNER_BAN, $ban_length, $_SESSION[$CONFIG_name.'account_id']);
					$result = execute_query($query, 'marriage.php');

					redir('marriage.php', 'main_div', $lang['MARRIAGE_DIVORCE_OK']);
				}

				alert($lang['MARRIAGE_NOTHING']);
			}
		}

		$query = sprintf(PARTNER_GET, $_SESSION[$CONFIG_name.'account_id']);
		$result = execute_query($query, 'marriage.php');

		if ($result->count() < 1)
			redir('motd.php', 'main_div', $lang['ONE_CHAR']);

		caption($lang['MARRIAGE']);
		echo '
		<table class="maintable">
		<tr>
			<th align="left">'.$lang['NAME'].'</th>
			<th align="left">'.$lang['MARRIAGE_PARTNER'].'</th>
			<th align="center">'.$lang['MARRIAGE_DIVORCE'].'</th>
		</tr>
		';
		while ($line = $result->fetch_assoc()) {
			$charname = htmlformat($line['name']);
			$GID1 = $line['char_id'];
			$GID2 = $line['partner_id'];
			if (!$GID2)
				$partnername = $lang['MARRIAGE_SINGLE'];
			else
				$partnername = htmlformat($line['partner_name']);
			echo '
			<tr>
				<td align="left">'.$charname.'</td>
				<td align="left">'.$partnername.'</td>
			';
			if ($CONFIG_marry_enable && $GID2 > 0) {
				echo '
				<td align="center">
				<form id="marriage'.$GID1.'" onsubmit="return GET_ajax(\'marriage.php\',\'main_div\',\'marriage'.$GID1.'\');">
					<input type="checkbox" name="divorce" value="1" style="border-color: #FFFFFF">
					<input type="submit" value="Confirm">
					<input type="hidden" name="opt" value="1">
					<input type="hidden" name="GID1" value="'.$GID1.'">
					<input type="hidden" name="GID2" value="'.$GID2.'">
				</form>
				</td>
				';
			}
			else {
				echo '
				<td align="center">
					<input type="checkbox" style="border-color: #FFFFFF" disabled>
					<input type="submit" value="Confirm" disabled>
				</td>
				';
			}
			echo '</tr>';
		}
		echo '</table>';
		if ($CONFIG_marry_enable)
			echo '
			<table class="maintable">
				<tr><td align="left">'.$lang['MARRIAGE_PS1'].'</td></tr>
				<tr><td align="left">'.$lang['MARRIAGE_PS2'].'</td></tr>
			</table>';
//				<tr><td align="left">'.$lang['MARRIAGE_PS3'].'</td></tr>

	}
	fim();
}

redir('motd.php', 'main_div', $lang['NEED_TO_LOGIN']);
?>
