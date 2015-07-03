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

if (!empty($_SESSION[$CONFIG_name.'account_id']) && $CONFIG_set_slot) {
	if ($_SESSION[$CONFIG_name.'account_id'] > 0) {

		if (is_online())
			redir("index.php", "main_div", $lang['NEED_TO_LOGOUT_F']);

		$jobs = $_SESSION[$CONFIG_name.'jobs'];

		if (!empty($GET_opt)) {
			if ($GET_opt == 1) {
				if (!isset($GET_newslot) || $GET_newslot == $GET_slot)
					alert($lang['SLOT_NOT_SELECTED']);

				if (notnumber($GET_char_id) || notnumber($GET_newslot) || notnumber($GET_slot))
					alert($lang['SLOT_CHANGE_FAILED']);

				if ($GET_newslot < 0 || $GET_newslot > $CONFIG_max_chars-1 || $GET_slot < 0 ||  $GET_slot > $CONFIG_max_chars-1)
					alert($lang['SLOT_WRONG_NUMBER']);
				
				$query = sprintf(CHECK_SLOT, $GET_newslot, $_SESSION[$CONFIG_name.'account_id']);
				$result = execute_query($query, "slot.php");

				if ($line = $result->fetch_row()) {
					$query = sprintf(CHANGE_SLOT, $GET_slot, $line[0], $_SESSION[$CONFIG_name.'account_id']);
					$result = execute_query($query, "slot.php");
				}

				$query = sprintf(CHANGE_SLOT, $GET_newslot, $GET_char_id, $_SESSION[$CONFIG_name.'account_id']);
				$result = execute_query($query, "slot.php");
			}
		}
		$query = sprintf(GET_SLOT, $_SESSION[$CONFIG_name.'account_id']);
		$result = execute_query($query, "slot.php");

		if ($result->count() < 1)
			redir("slot.php", "main_div", $lang['ONE_CHAR']);

		caption($lang['SLOT_CHANGE_SLOT']);
		echo '
		<table class="maintable">
		<tr>
			<th align="right">'.$lang['SLOT'].'</th>
			<th align="left">'.$lang['NAME'].'</th>
			<th align="left">'.$lang['CLASS'].'</th>
			<th align="center">'.$lang['SLOT_NEW_SLOT'].'</th>
		</tr>
		';
		$chars = array();
		for ($j = 0; $line = $result->fetch_assoc(); $j++) {
			$chars[] = $line;
			$slots[$line['char_num']] = $line['name'];
		}
		
		foreach ($chars as $j => $line) {
			$GID = $line['char_id'];
			$slot = $line['char_num'];
			$charname = htmlformat($line['name']);

			$job = $lang['UNKNOWN'];
			if (isset($jobs[$line['class']]))
				$job = $jobs[$line['class']];

			if ($slot < 0 || $slot > $CONFIG_max_chars-1) {
				echo '<tr class="disabled">';
			}
			else {
				echo '<tr>';
			}
			
			echo '
				<td align="right">'.$slot.'</td>
				<td align="left">'.$charname.'</td>
				<td align="left">'.$job.'</td>
				<td align="center">';
				
			if ($slot < 0 || $slot > $CONFIG_max_chars-1) {
				echo '
					<select name="newslot" disabled>';
				for ($i = 0; $i < $CONFIG_max_chars; $i++) {
					if ($slot == $i)
						echo '<option value="'.$i.'" selected="selected">'.$i.' - '.$slots[$i];
					else
						echo '<option value="'.$i.'">'.$i.' - '.$slots[$i];
				}
				echo '</select>
						<input type="submit" value="'.$lang['CHANGE'].'" disabled>
					</form>
					</td>
				</tr>';
			}
			else {
				echo '
					<form id="slot'.$j.'" onsubmit="return GET_ajax(\'slot.php\',\'main_div\',\'slot'.$j.'\')">
						<select name="newslot">';
				for ($i = 0; $i < $CONFIG_max_chars; $i++) {
					if ($slot == $i)
						echo '<option value="'.$i.'" selected="selected">'.$i.' - '.$slots[$i];
					else
						echo '<option value="'.$i.'">'.$i.' - '.$slots[$i];
				}
				echo '</select>
						<input type="submit" value="'.$lang['CHANGE'].'">
						<input type="hidden" name="opt" value="1">
						<input type="hidden" name="slot" value="'.$slot.'">
						<input type="hidden" name="char_id" value="'.$GID.'">
					</form>
					</td>
				</tr>';
			}
		}
		echo '</table>
			<table>
				<tr><td align="left">'.$lang['SLOT_PS1'].'</td></tr>
				<tr><td align="left">'.$lang['SLOT_PS2'].'</td></tr>
			</table>';
	}
	fim();
}

redir('motd.php', 'main_div', $lang['NEED_TO_LOGIN']);
?>
