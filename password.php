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
include_once 'functions.php';

if (!empty($_SESSION[$CONFIG_name.'account_id'])) {
	if ($_SESSION[$CONFIG_name.'account_id'] > 0) {

		if (!empty($GET_opt)) {
			if ($GET_opt == 1 && isset($GET_frm_name) && !strcmp($GET_frm_name, "password")) {
				if (strcmp($GET_newpass, $GET_confirm) != 0) 
					alert($lang['PASSWORD_NOT_MATCH']);

				if (inject($GET_login_pass) || inject($GET_newpass)) 
					alert($lang['INCORRECT_CHARACTER']);

				if (strlen($GET_login_pass) < 4 || strlen($GET_login_pass) > 23)
					alert($lang['PASSWORD_LENGTH_OLD']);

				if ($CONFIG_safe_pass && (strlen(trim($GET_newpass)) < 6 || strlen(trim($GET_newpass)) > 23))
					alert($lang['PASSWORD_LENGTH']);

				if (strlen(trim($GET_newpass)) < 4 || strlen(trim($GET_newpass)) > 23)
					alert($lang['PASSWORD_LENGTH_OLD']);

				if ($CONFIG_safe_pass && thepass(trim($GET_newpass)))
					alert($lang['PASSWORD_REJECTED']);

				if ($CONFIG_md5_pass) {
					$GET_login_pass = md5($GET_login_pass);
					$GET_newpass = md5($GET_newpass);
				}

				$query = sprintf(CHECK_PASSWORD, trim($GET_login_pass), $_SESSION[$CONFIG_name.'account_id']);
				$result = execute_query($query, 'password.php');

				if (!$result->fetch_row())
					alert($lang['INCORRECT_PASSWORD']);

				$query = sprintf(CHANGE_PASSWORD, trim($GET_newpass), $_SESSION[$CONFIG_name.'account_id']);
				$result = execute_query($query, 'password.php');

				redir("password.php", "main_div", $lang['PASSWORD_CHANGED']);
			}
		}

	opentable($lang['CHANGE_PASSWORD']);
		echo "
		<form id=\"password\" onsubmit=\"return GET_ajax('password.php','main_div','password')\"><table>
		<tr><td align=right>".$lang['PASSWORD'].":</td><td>
			<input type=\"password\" name=\"login_pass\" maxlength=\"23\" size=\"23\" onKeyPress=\"return force(this.name,this.form.id,event);\">
			</td></tr>
		<tr><td align=right>".$lang['NEW_PASSWORD'].":</td><td>
			<input type=\"password\" name=\"newpass\" maxlength=\"23\" size=\"23\" onKeyPress=\"return force(this.name,this.form.id,event);\">
			</td></tr>
		<tr><td align=right>".$lang['NEW_PASSWORD'].":</td><td>
			<input type=\"password\" name=\"confirm\" maxlength=\"23\" size=\"23\" onKeyPress=\"return force(this.name,this.form.id,event);\">
			</td></tr>
		<input type=\"hidden\" name=\"opt\" value=\"1\">
		<tr><td>&nbsp;</td><td><input type=\"submit\" value=".$lang['CHANGE']."></td></tr>
		</table></form>
		";
	closetable();
	fim();
	}
}
redir("motd.php", "main_div", $lang['NEED_TO_LOGIN']);
?>