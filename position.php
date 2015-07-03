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

if (!empty($_SESSION[$CONFIG_name.'account_id']) && $CONFIG_reset_enable) {
	if ($_SESSION[$CONFIG_name.'account_id'] > 0) {

		if (!empty($GET_opt)) {
			if ($GET_opt == 1) {
				// Currently logged in
				if (is_online())
					alert($lang['NEED_TO_LOGOUT_F']);

				// Submitted ID contains illegal characters
				if (inject($GET_GID1))
					alert($lang['POSITION_RESET_FAILED']);

				$query = sprintf(GET_SAVE_POSITION, $GET_GID1);
				$result = execute_query($query, 'position.php');
				$line = $result->fetch_assoc();

				// Non-existing character
				if ($line==NULL)
					alert($lang['POSITION_RESET_FAILED']);
				// Character is in jail
				if ($line['jailed'])
					alert($lang['POSITION_JAIL']);
				// Not your character
				if ($line['account_id']!=$_SESSION[$CONFIG_name.'account_id'])
					alert($lang['POSITION_RESET_FAILED']);
				// Not enough zeny
				if ($line['zeny'] < $CONFIG_reset_cost)
					alert($lang['POSITION_NO_ZENY']);

				$last_map = $line['save_map'];
				$last_x = $line['save_x'];
				$last_y = $line['save_y'];
				$zeny = $line['zeny'];
				$query = sprintf(FINAL_POSITION, $last_map, $last_x, $last_y, $CONFIG_reset_cost, $GET_GID1);
				$result = execute_query($query, 'position.php');
				redir('position.php', 'main_div', $lang['POSITION_OK']);
			}
		}

		$query = sprintf(CHAR_GET_CHARS, $_SESSION[$CONFIG_name.'account_id']);
		$result = execute_query($query, 'position.php');

		if ($result->count() < 1)
			redir('motd.php', 'main_div', $lang['ONE_CHAR']);

		caption($lang['POSITION_TITLE']);
		echo '
		<table class="maintable dataformat">
			<tr>
				<th align="right">'.$lang['SLOT'].'</th>
				<th align="left">'.$lang['NAME'].'</th>
				<th align="center">'.$lang['POSITION_LEVEL'].'</th>
				<th align="center">'.$lang['ZENY'].'</th>
				<th align="left">'.$lang['MAP'].'</th>
				<th align="center"></th>
			</tr>';

		while ($line = $result->fetch_assoc()) {
			$GID = $line['char_id'];
			$slot = $line['char_num'];
			$charname = htmlformat($line['name']);
			$clevel = $line['base_level'];
			$joblevel = $line['job_level'];
			$lastmap = $line['last_map'];
			$zeny = moneyformat($line['zeny']);

			if ($line['jailed'] || $line['zeny'] < $CONFIG_reset_cost) {
				echo '<tr class="disabled">';
			}
			else {
				echo '<tr>';
			}

			echo '
				<td align="right">'.$slot.'</td>
				<td align="left">'.$charname.'</td>
				<td align="center">'.$clevel.'/'.$joblevel.'</td>
				<td align="right">'.$zeny.'</td>
				<td align="left">'.$lastmap.'</td>
				<td align="center">';

			if ($line['jailed'] || $line['zeny'] < $CONFIG_reset_cost) {
				echo '<input type="submit" value="'.$lang['POSITION_RESET'].'" disabled>';
			}
			else {
				echo '
				<form id="position'.$slot.'" onsubmit="return GET_ajax(\'position.php\',\'main_div\',\'position'.$slot.'\')">
					<input type="submit" value="'.$lang['POSITION_RESET'].'">
					<input type="hidden" name="charnum" value="'.$slot.'">
					<input type="hidden" name="opt" value="1">
					<input type="hidden" name="GID1" value="'.$GID.'">
				</form>';
			}
			echo '
				</td>
			</tr>
			';
		}
		echo '</table>';
		if ($CONFIG_reset_cost) {
			echo '
				<table class="maintable">
					<tr><td align="left">'.sprintf($lang['POSITION_PS1'], $CONFIG_reset_cost).'</td></tr>
				</table>
			';
		}
	}
	fim();
}

redir('motd.php', 'main_div', $lang['NEED_TO_LOGIN']);
?>
