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

if (!extension_loaded('mysql'))
	die ("Mysql extension not loaded, Please verify your PHP configuration.");

if (!is_file("./config.php"))
	die("<a href=\"./install/install.php\">Run Installation Script</a>");

session_start();
include_once 'config.php'; // loads config variables
include_once 'query.php'; // imports queries
include_once 'functions.php';

$_SESSION[$CONFIG_name.'castles'] = readcastles();
$_SESSION[$CONFIG_name.'jobs'] = readjobs();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>
			<?php echo htmlformat($CONFIG_name); ?> - Ceres Control Panel (SVN)
		</title>
		<link rel="stylesheet" type="text/css" href="./ceres.css">

		<script type="text/javascript" language="javascript" src="ceres.js"></script>
	</head>

	<BODY style="margin-top:0; margin-bottom:0" background="images/background.jpg">

		<table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="height:100%" width="780" align=center>
			<tr>
				<td valign="top" colspan="5" width="100%" style="background:url(images/ceres.jpg); height:161px">
				</td>
			</tr>
			<tr>
				<td style="height:25px" colspan="5" bgcolor="#000000" width="100%">
					<div id="main_menu" style="color:#FFFFFF; font-weight:bold"></div>
					<div id="load_div" style="position:absolute; top:161px; left:790px; height:30px width:25px; visibility:hidden; background-color:#000000; color:#FFFFFF"><img src="images/loading.gif" alt="Loading..."></div>
					<div id="menu_load" style="position:absolute; top:0px; left:0px; visibility:hidden;"></div>
				</td>
			</tr>
			<tr>
				<td style="height:25px" colspan="5" bgcolor="#6186AF"  width="100%">
					<div id="sub_menu" style="color:#FFFFFF; font-weight:bold">&nbsp;</div>
				</td>
			</tr>
			<tr valign=top>
				<td height="100%">
					<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="height:350px">
						<tr style="height:100%">
							<td valign="top" bgcolor="#FFFFFF" colspan="2" width="600" style="height:100%">
								<div id="main_div" style="padding-left: 15; padding-right: 5; padding-top: 10">
								</div>
							</td>
							<td bgcolor="#D0D9E0" valign="top" width="156" rowspan="5" style="height:100%">
								<div id="login_div" style="padding-left: 15; padding-right: 5; padding-top: 10">
								</div>
								<div id="new_div" style="padding-left: 15; padding-right: 5; padding-top: 10">
								</div>
								<div id="status_div" style="padding-left: 15; padding-right: 5; padding-top: 10">
								</div>
								<div id="selectlang_div" style="padding-left: 15; padding-right: 5; padding-top: 10">
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="5" bgcolor="#6186AF" style="height:40px" valign="middle" align="center">
					<p style="font-size: 9px; margin-top: 7"><font color="#FFFFFF">
						Copyright © 2005
						<span style="cursor:pointer" class="copyright_link" onClick="window.open('http://cerescp.sourceforge.net/');">
						Ceres Control Panel</span> by Beowulf and Dekamaster
						<BR>
						Powered by <span style="cursor:pointer" onClick="window.open('http://en.wikipedia.org/wiki/KISS_principle');">
							<img src="images/kiss.png" alt="Keep It Simple Stupid! Technology" border="0" align=bottom>
						</span> <span style="cursor:pointer" onClick="window.open('http://validator.w3.org/check?uri='+document.URL);">
							<img src="http://cerescp.sourceforge.net/ceres/img.php?<?echo $qwty?>" alt="w3c" style="visibility:hidden">
							<img src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01 Transitional" height="15" width="43">
						</span>
						</font>
					</p>
				</td>
			</tr>
		</table>
		<script type="text/javascript">
			load_menu();
			LINK_ajax('motd.php', 'main_div');
			LINK_ajax('login.php', 'login_div');
			login_hide(2);
			server_status()
			LINK_ajax('selectlang.php', 'selectlang_div');
		</script>
	</body>
</html>

<?php
fim();
?>
