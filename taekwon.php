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

$query = sprintf(TAEKWON, $CONFIG_gm_hide);
$result = execute_query($query, 'taekwon.php');

caption($lang['TAEKWON_LADDER']);
echo '
<table class="maintable dataformat">
<tr>
	<th align="right">'.$lang['POS'].'</th>
	<th align="left">'.$lang['NAME'].'</th>
	<th align="left">'.$lang['LADDER_GUILD'].'</th>
	<th align="right">'.$lang['TAEKWON_POINTS'].'</th>
</tr>
';
$nusers = 0;
if ($result) {
	while ($line = $result->fetch_assoc()) {
		$nusers++;

		$_SESSION[$CONFIG_name.'emblems'][$line['guild_id']] = $line['emblem_data'];

		$charname = htmlformat($line['name']);
		$gname = htmlformat($line['guild_name']);

		if (isset($_SESSION[$CONFIG_name.'account_id']) && $line['account_id'] == $_SESSION[$CONFIG_name.'account_id'])
			echo '<tr class="highlight">';
		else
			echo '<tr>';
		echo '
			<td align="right">'.$nusers.'</td>
			<td align="left">'.$charname.'</td>
			<td align="left">'.($line['guild_id']>0?('<img src="emblema.php?data='.$line['guild_id'].'" alt="'.$gname.'" class="emblem" />'.$gname):'<div class="emblem"></div>').'</td>
			<td align="right">'.moneyformat($line['fame']).'</td>
		</tr>
		';
	}
}
echo '</table>';

fim();
?>
