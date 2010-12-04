<?php
		//very simply submit ticket script by KaityRoux
		session_start();
		include_once './config.php'; // loads config variables
		include_once './query.php'; // imports queries
		include_once './functions.php';
			
		if(isset($_SESSION[$CONFIG_name.'account_id'])) {
			if ($_SESSION[$CONFIG_name.'account_id'] > 0) {			
				opentable("Submit Ticket");
				echo '	<form name="bugreport" method="post" action="./tickets/ticket.php">
						<br>Character Name:<input type="text" name="charname" maxlength="20" value="(for contact)"></input></br>
						<br><textarea cols="50" rows="4" name="report"></textarea></br><br/>
						<br>&nbsp;&nbsp;&nbsp;<input type="submit" value="Submit">
						<input type="reset"></br>
						</form>
						<br>*Spamming or abusing the ticket system will result in a possible ban.</br>
					';
				closetable();

			fim();
			
			}
		}
redir("motd.php", "main_div", $lang['NEED_TO_LOGIN']);

?>