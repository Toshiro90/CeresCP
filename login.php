<?php
/*
Ceres Control Panel

This is a control panel program for eAthena and other Athena SQL based servers
Copyright (C) 2005 by Beowulf and Dekamaster

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
include_once 'lib/bruteforce.php';

if (!isset($_SESSION[$CONFIG_name.'account_id']) && isset($_COOKIE['login_pass']) && isset($_COOKIE['userid'])) {

		$bf_check = bf_check_user(trim($_COOKIE['userid']));
		if ($bf_check > 0 || inject(trim($_COOKIE['userid']))) { // Based on Rasqual notes I fix it [BeoWulf]
			setcookie('login_pass', '', time() - 3600);
			setcookie('userid', '', time() - 3600);
		} else {
			$query = sprintf(LOGIN_USER, trim($_COOKIE['userid']));
			$result = execute_query($query, 'index.php');

			if($result->count() == 1 && $line = $result->fetch_row()) {
				if (md5($CONFIG_name.$line[3]) == $_COOKIE['login_pass']) {
					$_SESSION[$CONFIG_name.'account_id'] = $line[0];
					$_SESSION[$CONFIG_name.'userid'] = $line[1];
					$_SESSION[$CONFIG_name.'level'] = $line[2];
					setcookie('login_pass', $_COOKIE['login_pass'], time() + 3600 * 24 * 30);
					setcookie('userid', $_COOKIE['userid'], time() + 3600 * 24 * 30);
				} else {
					setcookie('login_pass', '', time() - 3600);
					setcookie('userid', '', time() - 3600);

					bf_error(trim($_COOKIE['userid']));
					echo '<script type="text/javascript">LINK_ajax(\'login.php\',\'login_div\');</script>';
					alert($lang['COOKIE_REJECTED']);
				}
			} else {
				setcookie('login_pass', '', time() - 3600);
				setcookie('userid', '', time() - 3600);
	
				bf_error(trim($_COOKIE['userid']));
				echo '<script type="text/javascript">LINK_ajax(\'login.php\',\'login_div\');</script>';
				alert($lang['COOKIE_REJECTED']);
			}
		}
}

if (!empty($POST_opt)) {
	if ($POST_opt == 1 && isset($POST_frm_name) && !strcmp($POST_frm_name, 'login')) {

		$bf_check = bf_check_user(trim($POST_username));
		if ($bf_check > 0) {
			$msg = sprintf($lang['BLOCKED'], $bf_check);
			erro_de_login();
			alert($msg);
		}

		if (empty($POST_username) || empty($POST_login_pass)) {
			erro_de_login();
			alert($lang['INCORRECT_CHARACTER']);
		}

		if (inject($POST_username) || inject($POST_login_pass)) {
			erro_de_login();
			bf_error(trim($POST_username));
			alert($lang['INCORRECT_CHARACTER']);
		}

		$session = $_SESSION[$CONFIG_name.'sessioncode'];
		if ($CONFIG_auth_image && function_exists('gd_info')
			&& strtoupper($POST_code) != substr(strtoupper(md5('Mytext'.$session['login'])), 0, 6)) {
			erro_de_login();
			bf_error(trim($POST_username));
			alert($lang['INCORRECT_CODE']);
		}

		if (strlen($POST_username) > 23 || strlen($POST_username) < 4) {
			erro_de_login();
			bf_error(trim($POST_username));
			alert($lang['USERNAME_LENGTH']);
		}

		if (strlen($POST_login_pass) > 23 || strlen($POST_login_pass) < 4) {
			erro_de_login();
			bf_error(trim($POST_username));
			alert($lang['PASSWORD_LENGTH_OLD']);
		}

		$query = sprintf(LOGIN_USER, trim($POST_username));
		$result = execute_query($query, 'index.php');

		if($result->count() == 1 && $line = $result->fetch_row()) {
			if ($CONFIG_md5_pass)
				$POST_login_pass = md5($POST_login_pass);

			if ($line[3] == $POST_login_pass) {
				$_SESSION[$CONFIG_name.'account_id'] = $line[0];
				$_SESSION[$CONFIG_name.'userid'] = $line[1];
				$_SESSION[$CONFIG_name.'level'] = $line[2];

				if ($POST_remember_me) {
					setcookie('login_pass', md5($CONFIG_name.$line[3]), time() + 3600 * 24 * 30);
					setcookie('userid', $line[1], time() + 3600 * 24 * 30);
				}
			} else {
				erro_de_login();
				bf_error(trim($POST_username));
				alert($lang['WRONG_USERNAME_PASSWORD']);
			}
		} else {
			erro_de_login();
			bf_error(trim($POST_username));
			alert($lang['WRONG_USERNAME_PASSWORD']);
		}

	}
}

if (isset($GET_opt) && $GET_opt == 2) {
	session_destroy();
	setcookie('login_pass', '', time() - 3600);
	setcookie('userid', '', time() - 3600);
	session_start();
	echo '
		<script type="text/javascript">
			LINK_ajax(\'motd.php\',\'main_div\');
			load_menu();
			login_hide(1);
		</script>
	';
}


if (!empty($_SESSION[$CONFIG_name.'account_id'])) {
	if ($_SESSION[$CONFIG_name.'account_id'] > 0) {
		$userid = htmlformat($_SESSION[$CONFIG_name.'userid']);
		caption($lang['LOGIN_WELCOME']);
		echo '
		<script type="text/javascript">
			login_hide(0);
			LINK_ajax(\'motd.php\',\'main_div\');
			load_menu();
		</script>
		<table class="maintable">
			<tr>
				<td align="center">
					'.$lang['LOGIN_HELLO'].', '.$userid.'.<br /><br />
					<span title="'.$lang['LOGOFF_EXPL'].'" class="link" onClick="LINK_ajax(\'login.php?opt=2\',\'login_div\');">'.$lang['LOGOFF'].'</span>
				</td>
			</tr>
		</table>';
		fim();
	}
}

if (isset($_SESSION[$CONFIG_name.'sessioncode']))
	$session = $_SESSION[$CONFIG_name.'sessioncode'];
$session['login'] = rand(12345, 99999);
$_SESSION[$CONFIG_name.'sessioncode'] = $session;
$var = rand(10, 9999999);

caption($lang['LOGIN']);
echo '
<form id="login" onSubmit="return POST_ajax(\'login.php\',\'login_div\',\'login\');">
<table class="maintable">
	<tr>
		<td align=left>
			'.$lang['USERNAME'].':<br>
			<input type="text" name="username" maxlength="23" size="23" onKeyPress="return force(this.name,this.form.id,event);">
		</td>
	</tr>
	<tr>
		<td align=left>
			'.$lang['PASSWORD'].':<br>
			<input type="password" name="login_pass" maxlength="23" size="23" onKeyPress="return force(this.name,this.form.id,event);">
		</td>
	</tr>';

if ($CONFIG_auth_image && function_exists("gd_info")) {
	echo '
	<tr>
		<td align=left>'.$lang['CODE'].':</td>
	</tr>
	<tr>
		<td align=left><img src="img.php?img=login&var='.$var.'" alt="'.$lang['SECURITY_CODE'].'"></td>
	</tr>';
}
echo '
		<tr>
			<td align=left><input type="text" name="code" maxlength="6" size="6" onKeyPress="return force(this.name,this.form.id,event);">
				<input type="submit" value="'.$lang['LOGIN'].'">
			</td>
		</tr>
		<tr>
			<td align=left>
				<label><input type="checkbox" name="remember_me" value="1" style="border-color:#D0D9E0" onKeyPress="return force(this.name,this.form.id,event);"> '.$lang['LOGIN_REMEMBER'].'</label>
			</td>
		</tr>
	</table>
	<input type="hidden" name="opt" value="1">
</form>';

fim();
?>
