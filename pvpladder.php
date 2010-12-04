<?php

//Top PVPer ladder by KaityRoux
//Basically a slightly modified top 100 zeny ladder hehe

session_start();
include_once './config.php'; // loads config variables
include_once './query.php'; // imports queries
include_once './functions.php';

$jobs = $_SESSION[$CONFIG_name.'jobs'];

$query = sprintf(TOP100PVP);
$result = execute_query($query, "pvpladder.php");

opentable('PVP Ladder');
echo "
<table width=\"400\">
<tr>
	<td align=\"right\" class=\"head\">".$lang['POS']."</td>
	<td>&nbsp;</td>
	<td align=\"left\" class=\"head\">".$lang['NAME']."</td>
	<td align=\"right\" class=\"head\">PVP Points</td>
</tr>
";
$nusers = 0;
if ($result) {
	while ($line = $result->fetch_row()) {
				$nusers++;
				if ($nusers > 100)
					break;

				$points = ($line[2]*2)-$line[3];
				//$pvppoints = htmlformat($points);
				$charname = htmlformat($line[0]);

				echo "    
				<tr>
					<td align=\"right\">$nusers</td>
					<td>&nbsp;</td>
					<td align=\"left\">$charname</td>
					<td align=\"left\">
				";

				echo "
					</td>
					<td align=\"right\">$points</td>
				</tr>
				";
	}
}
echo "</table>";
closetable();
fim();

?>