<?php
		//Automatic donations plugin by KaityRoux
		session_start();
		include_once './config.php'; // loads config variables
		include_once './query.php'; // imports queries
		include_once './functions.php';

		if ( isset($_SESSION[$CONFIG_name.'account_id']) ) {
			if ($_SESSION[$CONFIG_name.'account_id'] > 0) {
				$self = $_SERVER['PHP_SELF'];
				$accid = $_SESSION[$CONFIG_name.'account_id'];
				opentable("Donate");

				echo '<br>Donations keep our servers up and running, they also allow you to play for free. We like to thank donators with a small reward.</br>';
				echo '<br>NOTE: $1 = 100cash points</br>';
echo<<<FORM
				<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="notify_url" value="$CONFIG_domain/notify/dnotify.php" />
				<input type="hidden" name="return" value="$CONFIG_domain" />
				<input type="hidden" name="custom" value="accid" />
				<input type="hidden" name="business" value="$CONFIG_paypal_email">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="item_name" value="Donation Credits">
				<p style="text-align: center">$<input type="text" name="amount"></p></input>
				<p style="text-align: center"><input style="border-style: none;" type="image" src="http://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!"></p>
				</form>
FORM;
				
				}
			
			
				closetable();
			}
		fim();
	
redir("motd.php", "main_div", $lang['NEED_TO_LOGIN']);
?>