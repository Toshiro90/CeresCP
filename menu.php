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
include_once './config.php'; // loads config variables
include_once './query.php'; // imports queries
include_once './functions.php';

$mainmenu[0][0] = $lang['MENU_HOME'];
$mainmenu[0][1] = -1;

$mainmenu[1][0] = $lang['MENU_MYACCOUNT'];
$mainmenu[1][1] = 0;

$mainmenu[2][0] = $lang['MENU_MYCHARS'];
$mainmenu[2][1] = 0;

$mainmenu[3][0] = $lang['MENU_RANKING'];
$mainmenu[3][1] = -1;

$mainmenu[4][0] = $lang['MENU_INFORMATION'];
$mainmenu[4][1] = -1;

$mainmenu[5][0] = $lang['MENU_PROBLEMS'];
$mainmenu[5][1] = 0;

$mainmenu[6][0] = "Administration";
$mainmenu[6][1] = $CONFIG['cp_admin'];

$submenu[0][0] = $lang['MENU_MESSAGE'];
$submenu[0][1] = "motd.php";
$submenu[0][2] = 0;

$submenu[1][0] = $lang['MENU_CHANGEPASS'];
$submenu[1][1] = "password.php";
$submenu[1][2] = 1;

$submenu[2][0] = $lang['MENU_CHANGEMAIL'];
$submenu[2][1] = "changemail.php";
$submenu[2][2] = 1;

$submenu[3][0] = $lang['MENU_TRANFMONEY'];
$submenu[3][1] = "money.php";
$CONFIG_money_transfer = 1 ? $submenu[3][2] = 2 : $submenu[3][2] = -1;

$submenu[4][0] = $lang['MENU_CHANGESLOT'];
$submenu[4][1] = "slot.php";
$CONFIG_set_slot = 1 ? $submenu[4][2] = 2 : $submenu[4][2] = -1;

$submenu[5][0] = $lang['MENU_MARRIAGE'];
$submenu[5][1] = "marriage.php";
$submenu[5][2] = 2;

$submenu[6][0] = $lang['MENU_PLAYERLADDER'];
$submenu[6][1] = "ladder.php";
$submenu[6][2] = 3;

$submenu[7][0] = $lang['MENU_GUILDLADDER'];
$submenu[7][1] = "guild.php";
$submenu[7][2] = 3;

$submenu[8][0] = $lang['MENU_ZENYLADDER'];
$submenu[8][1] = "top100zeny.php";
$submenu[8][2] = 3;

$submenu[9][0] = $lang['MENU_WHOSONLINE'];
$submenu[9][1] = "whoisonline.php";
$submenu[9][2] = 4;

$submenu[10][0] = $lang['MENU_ABOUT'];
$submenu[10][1] = "about.php";
$submenu[10][2] = 4;

$submenu[11][0] = $lang['MENU_RESETPOS'];
$submenu[11][1] = "position.php";
$CONFIG_reset_enable = 1 ? $submenu[11][2] = 5 : $submenu[11][2] = -1;

$submenu[12][0] = $lang['MENU_RESETLOOK'];
$submenu[12][1] = "resetlook.php";
$CONFIG_reset_look = 1 ? $submenu[12][2] = 5 : $submenu[12][2] = -1;

$submenu[13][0] = "Submit Ticket";
$submenu[13][1] = "submitticket.php";
$submenu[13][2] = 5;

$submenu[14][0] = $lang['MENU_LINKS'];
$submenu[14][1] = "links.php";
$submenu[14][2] = 0;

$submenu[15][0] = "Accounts";
$submenu[15][1] = "adminaccounts.php";
$submenu[15][2] = 6;

$submenu[16][0] = "Chars";
$submenu[16][1] = "adminchars.php";
$submenu[16][2] = 6;

$submenu[17][0] = "Manage Donations";
$submenu[17][1] = "admindonation.php";
$CONFIG_donations = 1 ? $submenu[17][2] = 6 : $submenu[17][2] = -1;

$submenu[18][0] = "Name Change";
$submenu[18][1] = "changename.php";
$CONFIG_changename = 1 ? $submenu[18][2] = 2 : $submenu[18][2] = -1;

$submenu[19][0] = "Sex Changer";
$submenu[19][1] = "changesex.php";
$CONFIG_changesex = 1 ? $submenu[19][2] = 2 : $submenu[19][2] = -1;

$submenu[20][0] = "Vote4Points";
$submenu[20][1] = "vote4points.php";
$CONFIG_vote4points = 1 ? $submenu[20][2] = 2 : $submenu[20][2] = -1;

$submenu[21][0] = "Donate";
$submenu[21][1] = "donate.php";
$CONFIG_donates = 1 ? $submenu[21][2] = 2 : $submenu[21][2] = -1;

$submenu[22][0] = "PVP Ladder";
$submenu[22][1] = "pvpladder.php";
$CONFIG_pvpladder = 1 ? $submenu[22][2] = 3 : $submenu[22][2] = -1;

//$submenu[17][0] = "Bans/Blocks";
//$submenu[17][1] = "";
//$submenu[17][2] = 6;


$pos = 0;
$menu = "var mainmenu = new Array(";
$sub  = "var submenu = new Array(\"\", \"\", -1";

for ($i = 0; isset($mainmenu[$i][0]); $i++) {
	if ($mainmenu[$i][1] < 0 || (isset($_SESSION[$CONFIG_name.'level']) && $_SESSION[$CONFIG_name.'level'] >= $mainmenu[$i][1])) {
		if ($pos > 0)
			$menu = $menu.", ";
		$menu = $menu."\"".$mainmenu[$i][0]."\"";
		for ($j = 0; isset($submenu[$j][0]); $j++) {
			if ($submenu[$j][2] == $i) {
				$sub = $sub.", \"".$submenu[$j][0]."\"".", \"".$submenu[$j][1]."\", ".$pos;
			}
		}
		$pos++;
	}
}

$menu = $menu.");";
$sub  = $sub.");";

echo $menu."\n";
echo $sub."\n";

?>
function main_menu() {
	var the_menu = " | ";

	for (i = 0; i < mainmenu.length; i++)
		the_menu = the_menu + "<span style=\"cursor:pointer\" onMouseOver=\"this.style.color='#FF3300'\" onMouseOut=\"this.style.color='#FFFFFF'\" onClick=\"return sub_menu(" + i + ");\">" + mainmenu[i] + "</span> | ";

	document.getElementById('main_menu').innerHTML = the_menu;
	document.getElementById('sub_menu').innerHTML = " ";

	return false;
}

function sub_menu(index) {
	var the_menu = " | ";
	
	for (i = 0; i < submenu.length; i = i + 3) {
		if (submenu[i + 2] == index)
		the_menu = the_menu + "<span style=\"cursor:pointer\" onMouseOver=\"this.style.color='#FF3300'\" onMouseOut=\"this.style.color='#FFFFFF'\" onClick=\"return LINK_ajax('" + submenu[i + 1] + "','main_div');\">" + submenu[i] + "</span> | ";
	}

	document.getElementById('sub_menu').innerHTML = the_menu;

	return false;
}

main_menu();
<?php
//fim();
?>
