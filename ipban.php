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

function iplist() {
	global $lang;
	if (!($handle = fopen("./db/ipban.txt", "rt")))
		die(htmlformat($lang['TXT_ERROR']));
	while ($line = fgets($handle, 1024)) {
		if (($line[0] == '/' && $line[1] == '/') || $line[0] == '\0' || $line[0] == '\n' || $line[0] == '\r')
			continue;
		if (($ip = sscanf($line, "%s"))) {
			$resp[] = $ip[0];
		}
	}	
	fclose($handle);
	if (isset($resp))
		return $resp;
	else
		return 0;
}

function ipban() {
	$banned = iplist();
	$userip = $_SERVER['REMOTE_ADDR'];

	for ($i = 0; isset($banned[$i]); $i++) {
		if (strcmp($banned[$i], $userip) === 0)
			return 1;

		$pos = strpos($banned[$i], '.*');
		if ($pos > 1) {
			$newban = substr($banned[$i], 0, $pos + 1);
			$newuse = substr($userip, 0, $pos + 1);
			if (strcmp($newban, $newuse) === 0)
				return 1;
		}
	}

	return 0;
}

?>