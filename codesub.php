<?php

		//Registration Part [KaityRoux]
		session_start();
		include_once './config.php'; // loads config variables
		include_once './query.php'; // imports queries
		include_once './functions.php';
		$code = $_GET['code'];
		if(isset($code)) {
			$query = sprintf(CHECK_KEY, $code);
			$result = execute_query($query, 'codesub.php');
			$row = mysql_fetch_row($result);
			if($row[0]) { 
				$query = sprintf(INSERT_CHAR, $row[0], $row[1], $row[2], $row[3], $_SERVER['REMOTE_ADDR']);
				$results = execute_query($query, 'codesub.php');
				redir("motd.php", "main_div", $lang['ACCOUNT_CREATED']);
			} else {
				echo '<script>';
				echo "alert('Error with registration.');";
				echo '</script>';
			}
		}
?>