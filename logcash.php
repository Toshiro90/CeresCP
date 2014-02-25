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
	die ('Not Authorized');

caption('Cash Logs');

if (!isset($GET_page))
	$GET_page = 0;
else if (notnumber($GET_page))
	alert($lang['INCORRECT_CHARACTER']);

if ($config['servermode']!=0) {
	redir('motd.php', 'main_div', 'This is not available on your server.');
}

$lpp = 30;

$inicio = $GET_page * $lpp;
$back = "page=".$GET_page;


$query = sprintf(LOGS_CASH, $inicio, $lpp);
$result = execute_query($query, 'logcash.php', 2);

$result2 = execute_query(FOUND_ROWS, 'logcash.php', 2);
$result2->fetch_row();
$num = $result2->row(0);
$pages = (int)(($num-1)/$lpp);

$pagestring = '';
if ($pages) {
	$pagestring .= '<table class="maintable"><tr><td><center><span title="0" class="link" onClick="return LINK_ajax(\'logcash.php?page=0\',\'main_div\');">&lt;&lt;</span>';
	if ($GET_page > 0) {
		$pagestring .= ' <span title="'.($GET_page-1).'" class="link" onClick="return LINK_ajax(\'logcash.php?page='.($GET_page-1).'\',\'main_div\');">&lt;</span>';
	}

	for ($i = ($GET_page - 10); $i <= ($GET_page + 10); $i++) {
		$pagestring .=  ' ';
		if ($i >= 0 && $i != $GET_page && $i <= $pages)
			$pagestring .= '<span title="'.$i.'" class="link" onClick="return LINK_ajax(\'logcash.php?page='.$i.'\',\'main_div\');">'.$i.'</span>';
		else if ($i == $GET_page)
			$pagestring .= '<b>'.$i.'</b>';
	}

	if ($GET_page < $pages)
		$pagestring .= ' <span title="'.($GET_page+1).'" class="link" onClick="return LINK_ajax(\'logcash.php?page='.($GET_page+1).'\',\'main_div\');">&gt;</span>';

	$pagestring .= ' <span title="'.$pages.'" class="link" onClick="return LINK_ajax(\'logcash.php?page='.$pages.'\',\'main_div\');">&gt;&gt;</span></center></td></tr></table>';
}

echo $pagestring;
echo '<table align="center"><tr><td><span title="'.$GET_page.'" class="link" onClick="return LINK_ajax(\'logcash.php?page='.$GET_page.'\',\'main_div\');">Refresh</span></td></tr></table>';

echo '
<table class="maintable">
	<tr>
		<th style="white-space: nowrap; text-align: center; width: 100px;">Time</th>
		<th style="white-space: nowrap; text-align: center; width: 100px;">CharID</th>
		<th style="white-space: nowrap; text-align: center; width:  50px;">Type</th>
		<th style="white-space: nowrap; text-align: center; width:  60px;">Cash Type</th>
		<th style="white-space: nowrap; text-align: center; width:  100%;">Amount</th>
		<th style="white-space: nowrap; text-align: center; width:  50px;">Map</th>
	</tr>';

while ($line = $result->fetch_assoc()) {
	echo '<tr>
		  <td style="white-space: nowrap;">'.$line['time'].'</td>
		  <td style="white-space: nowrap; text-align: right;">'.$line['char_id'].'</td>
		  <td style="white-space: nowrap;">'.$line['type'].'</td>
		  <td style="white-space: nowrap;">'.$line['cash_type'].'</td>
		  <td style="white-space: nowrap; text-align: right;">'.moneyformat($line['amount']).'</td>
		  <td style="white-space: nowrap;">'.$line['map'].'</td>
		 </tr>';
}
echo '</table>';

echo '<table align="center"><tr><td><span title="'.$GET_page.'" class="link" onClick="return LINK_ajax(\'logcash.php?page='.$GET_page.'\',\'main_div\');">Refresh</span></td></tr></table>';
echo $pagestring;

fim();
?>
