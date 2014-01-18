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
include_once 'query.php'; // imports queries
include_once 'adminquery.php';
include_once 'functions.php';

if (!isset($_SESSION[$CONFIG_name.'level']) || $_SESSION[$CONFIG_name.'level'] < $CONFIG['cp_admin'])
	die ("Not Authorized");

$items = readitems();

echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>
			Ceres Control Panel - Charactere Details
		</title>
		<link rel="stylesheet" type="text/css" href="./ceres.css">
	</head>

<body>';

echo '<div style="background-color: #ffffff; width: 770px; margin: 0 auto;">';
caption("Char Detail");

if (isset($GET_id) && !notnumber($GET_id)) {
	$jobs = $_SESSION[$CONFIG_name.'jobs'];

	$query = sprintf(CHARINFO_CHAR, trim($GET_id));
	$answere = execute_query($query, 'admincharinfo.php');
	echo '
		<table class="maintable" style="width: 500px">
	';
	if ($result = $answere->fetch_row()) {
		$acc_id = $result[1];
		$class = $result[4];
		echo '
			<tr>
				<th align="right">Name:</th><td align="left">'.htmlformat($result[3]).'</td>
				<th align="right">Job:</th><td align="left">
			';
		if (isset($jobs[$result[4]]))
			echo $jobs[$result[4]];
		else
			echo 'unknown';
		echo '
			</tr>
			<tr>
				<th align="right">Level:</th><td align="left">'.$result[5].'/'.$result[6].'</td>
				<th align="right">Zeny:</th><td align="left">'.$result[9].'</td>
			<tr>
				<th align="right">STR:</th><td align="left">'.$result[10].'</td>
				<th align="right">AGI:</th><td align="left">'.$result[11].'</td>
				<th align="right">VIT:</th><td align="left">'.$result[12].'</td>
			</tr>
			<tr>
				<th align="right">INT:</th><td align="left">'.$result[13].'</td>
				<th align="right">DEX:</th><td align="left">'.$result[14].'</td>
				<th align="right">LUK:</th><td align="left">'.$result[15].'</td>
			</tr>
			</table>
		';
	}
	$query = sprintf(CHARINFO_INVENTORY, trim($GET_id));
	$answere = execute_query($query, 'admincharinfo.php');
	caption('INVENTORY');
	echo '
		<table class="maintable" style="width: 750px">
		<tr>
			<th align="center">Item</th>
			<th align="center" style="width: 50px;">Amount</th>
			<th align="center" style="width: 50px;">Refine</th>
			<th align="center" style="width: 100px;">Card0</th>
			<th align="center" style="width: 100px;">Card1</th>
			<th align="center" style="width: 100px;">Card2</th>
			<th align="center" style="width: 100px;">Card3</th>
		</tr>
	';
	while ($result = $answere->fetch_row()) {
		echo '
			<tr>
				<td align="center">
		';
		if (isset($items[$result[0]]))
			echo $items[$result[0]];
		else
			echo $result[0];
		echo '
				</td>
				<td align="center">'.$result[1].'</td>
				<td align="center">'.$result[6].'</td>
				<td align="center">
		';

		if ($result[2] == 255) {
			echo '
				forger</td>
				<td align="center">
			';
			echo forger($result[4], $result[5]);
			echo '
				</td>
				<td align="center">
				</td>
				<td align="center">
				</td>
			</tr>
			';
			continue;
		}

		if (isset($items[$result[2]]))
			echo $items[$result[2]];
		else
			echo $result[2];
		echo '
				</td>
				<td align="center">
		';
		if (isset($items[$result[3]]))
			echo $items[$result[3]];
		else
			echo $result[3];
		echo '
				</td>
				<td align="center">
		';
		if (isset($items[$result[4]]))
			echo $items[$result[4]];
		else
			echo $result[4];
		echo '
				</td>
				<td align="center">
		';
		if (isset($items[$result[5]]))
			echo $items[$result[5]];
		else
			echo $result[5];
		echo '
				</td>
			</tr>
		';
	}
	echo '</table>';

	$query = sprintf(CHARINFO_STORAGE, trim($acc_id));
	$answere = execute_query($query, 'admincharinfo.php');
	caption('STORAGE');
	echo '
		<table class="maintable" style="width: 750px">
		<tr>
			<th align="center">Item</th>
			<th align="center" style="width: 50px;">Amount</th>
			<th align="center" style="width: 50px;">Refine</th>
			<th align="center" style="width: 100px;">Card0</th>
			<th align="center" style="width: 100px;">Card1</th>
			<th align="center" style="width: 100px;">Card2</th>
			<th align="center" style="width: 100px;">Card3</th>
		</tr>
	';
	while ($result = $answere->fetch_row()) {
		echo '
			<tr>
				<td align="center">
		';
		if (isset($items[$result[0]]))
			echo $items[$result[0]];
		else
			echo $result[0];
		echo '
				</td>
				<td align="center">'.$result[1].'</td>
				<td align="center">'.$result[6].'</td>
				<td align="center">
		';

		if ($result[2] == 255) {
			echo '
				forger</td>
				<td align="center">
			';
			echo forger($result[4], $result[5]);
			echo '
				</td>
				<td align="center">
				</td>
				<td align="center">
				</td>
			</tr>
			';
			continue;
		}

		if (isset($items[$result[2]]))
			echo $items[$result[2]];
		else
			echo $result[2];
		echo '
				</td>
				<td align="center">
		';
		if (isset($items[$result[3]]))
			echo $items[$result[3]];
		else
			echo $result[3];
		echo '
				</td>
				<td align="center">
		';
		if (isset($items[$result[4]]))
			echo $items[$result[4]];
		else
			echo $result[4];
		echo '
				</td>
				<td align="center">
		';
		if (isset($items[$result[5]]))
			echo $items[$result[5]];
		else
			echo $result[5];
		echo '
				</td>
			</tr>
		';
	}
	echo '</table>';

	switch ($class) {
		case 5:
		case 10:
		case 18:
		case 4006:
		case 4011:
		case 4019:
		case 4028:
		case 4033:
		case 4041:
			$query = sprintf(CHARINFO_CART, trim($GET_id));
			$answere = execute_query($query, 'admincharinfo.php');
		caption('STORAGE');
		echo '
		<table class="maintable" style="width: 750px">
		<tr>
			<th align="center">Item</th>
			<th align="center" style="width: 50px;">Amount</th>
			<th align="center" style="width: 50px;">Refine</th>
			<th align="center" style="width: 100px;">Card0</th>
			<th align="center" style="width: 100px;">Card1</th>
			<th align="center" style="width: 100px;">Card2</th>
			<th align="center" style="width: 100px;">Card3</th>
		</tr>
			';
			while ($result = $answere->fetch_row()) {
				echo '
			<tr>
				<td align="center">
				';
				if (isset($items[$result[0]]))
					echo $items[$result[0]];
				else
					echo $result[0];
				echo '
				</td>
				<td align="center">'.$result[1].'</td>
				<td align="center">'.$result[6].'</td>
				<td align="center">
				';

				if ($result[2] == 255) {
					echo '
				forger</td>
				<td align="center">
					';
					echo forger($result[4], $result[5]);
					echo '
				</td>
				<td align="center">
				</td>
				<td align="center">
				</td>
			</tr>
					';
					continue;
				}

				if (isset($items[$result[2]]))
					echo $items[$result[2]];
				else
					echo $result[2];
				echo '
				</td>
				<td align="center">
				';
				if (isset($items[$result[3]]))
					echo $items[$result[3]];
				else
					echo $result[3];
				echo '
				</td>
				<td align="center">
				';
				if (isset($items[$result[4]]))
					echo $items[$result[4]];
				else
					echo $result[4];
				echo '
				</td>
				<td align="center">
				';
				if (isset($items[$result[5]]))
					echo $items[$result[5]];
				else
					echo $result[5];
				echo '
				</td>
			</tr>
				';
			}
		default:
			break;
	}

} else echo 'Not Found';

echo '<center style="margin: 20px;"><span title="Close this window" class="link" onClick="window.close();"><b>CLOSE</b></span></center>';

echo '</div>';
	
echo '</body></html>';
fim();
?>
