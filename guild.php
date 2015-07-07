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

//if (!empty($_SESSION[$CONFIG_name.'account_id'])) {
//	if ($_SESSION[$CONFIG_name.'account_id'] > 0) {
		$query = sprintf(GUILD_LADDER);
		$result = execute_query($query, "guild.php");

		caption($lang['GUILD_TOP50']);
		echo '
		<table class="maintable dataformat">
		<tr>
			<th align="right">'.$lang['POS'].'</th>
			<th align="center">'.$lang['GUILD_EMBLEM'].'</th>
			<th align="left">'.$lang['GUILD_GNAME'].'</th>
			<th align="left">'.$lang['GUILD_LEADER'].'</th>
			<th align="left">'.$lang['GUILD_GLEVEL'].'</th>
			<th align="right">'.$lang['GUILD_GEXPERIENCE'].'</th>
			<th align="center">'.$lang['GUILD_MEMBERS'].'</th>
			<th align="right">'.$lang['GUILD_GAVLEVEL'].'</th>
		</tr>
		';
		for ($i = 1; $i < 51; $i++) {
			if (!($line = $result->fetch_assoc()))
				break;
			$gname = htmlformat($line['name']);
			$gmaster = htmlformat($line['master']);
			$emblems[$line['guild_id']] = $line['emblem_data'];
			$experience = moneyformat($line['exp']);
			echo '
			<tr>
				<td align="right">'.$i.'</td>
				<td align="center"><img src="emblema.php?data='.$line['guild_id'].'" alt="'.$gname.'"></td>
				<td align="left">'.$gname.'</td>
				<td align="left">'.$gmaster.'</td>
				<td align="center">'.$line['guild_lv'].'</td>
				<td align="right">'.$experience.'</td>
				<td align="center">'.$line['count'].'</td>
				<td align="right">'.$line['average_lv'].'</td>
			</tr>';
		}
		echo '</table>';

		if (is_woe()) {
			caption($lang['WOE_TIME']);
		}
		else {
			$query = sprintf(GUILD_CASTLE);
			$result = execute_query($query, "guild.php");
			caption($lang['GUILD_GCASTLES']);
			$castles = $_SESSION[$CONFIG_name.'castles'];
			echo '
			<table class="maintable dataformat">
			<tr>
				<th align="center">'.$lang['GUILD_EMBLEM'].'</th>
				<th align="left">'.$lang['GUILD_GNAME'].'</th>
				<th align="left">'.$lang['GUILD_LEADER'].'</th>
				<th align="left">'.$lang['GUILD_GCASTLE'].'</th>
			</tr>
			';
			for ($i = $i; $line = $result->fetch_assoc(); $i++) {
				$gname = htmlformat($line['name']);
				$gmaster = htmlformat($line['master']);
				if (isset($castles[$line['castle_id']]))
					$cname = $castles[$line['castle_id']];
				else 
					continue;
				$emblems[$line['guild_id']] = $line['emblem_data'];
				echo '
				<tr>
					<td align="center"><img src="emblema.php?data='.$line['guild_id'].'" alt="'.$gname.'"></td>
					<td align="left">'.$gname.'</td>
					<td align="left">'.$gmaster.'</td>
					<td align="left">'.$cname.'</td>
				</tr>';
			}
			echo '</table>';
		}
		if (isset($emblems))
			$_SESSION[$CONFIG_name.'emblems'] = $emblems;
//	}
	fim();
//}

//redir("index.php", "main_div", "You need to be logged to use this page.");
?>
