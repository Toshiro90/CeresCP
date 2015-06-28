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

if ($CONFIG_servermode!=0) {
	redir('motd.php', 'main_div', 'This is not available on your server.');
}

$items = readitems();

$query = sprintf(VENDING_GET);
$result = execute_query($query, 'vending.php');

if (!$result)
	redir('motd.php', 'main_div', 'An error occured, please try again later.');

if ($result->count() < 1)
	redir('vending.php', 'main_div', 'There is currently no character using vending.', 'Vending');

caption('Vending');

$num = 0;
$previd = 0;

while ($result && $row = $result->fetch_assoc()) {
	$num++;
	
	$row['item_name'] = '';
	if ($row['refine'] > 0)
		$row['item_name'] .= '+'.$row['refine'].' ';
	$row['item_name'] .= isset($items[$row['nameid']]) ? $items[$row['nameid']] : $row['nameid'];
	//if ($row['slots'] > 0)
	//	$row['item_name'] .= ' ['.$row['slots'].']';

	if ($previd != $row['char_id']) {
		if ($num > 1) {
			print '</table>';
		}
		print '<table align="center" style="width: 550px; border: 1px solid #555555; margin: 20px;" cellpadding="1">
				  <tr>
				   <td style="text-align: left;"><b>'.$row['char_name'].'</b> '.($row['autotrade']?'(Autotrade)':'').'</td>
				   <td align="right" colspan="2">'.$row['map'].' '.$row['x'].':'.$row['y'].'</td>
				  </tr>';
	}

	print '<tr>
			<td style="text-align: left;">'.$row['item_name'].'</td>
			<td align="right" width="70px">'.$row['amount'].'</td>
			<td align="right" width="100px">'.number_format($row['price'], 0).' Zeny</td>
		   </tr>';
	$previd = $row['char_id'];
}
print '</table>';

fim();
?>
