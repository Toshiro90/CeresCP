<?php
		//Vote 4 Points page for votes
		session_start();
		include_once './config.php'; // loads config variables
		include_once './query.php'; // imports queries
		include_once './functions.php';
		
		if(isset($_SESSION[$CONFIG_name.'account_id'])) {
			if ($_SESSION[$CONFIG_name.'account_id'] > 0) {			
				opentable("Vote 4 Points");
				// Put your links and content here!!
				//example: <a href='vote.php?site=1' target='_blank'>Vote 4 Us!</a>
				//Or with an image: <a href='vote.php?site=1' target='_blank'><img src="image.png"></a>
				//For additional examples and help view vote4points setup in the eAscripts folder
								
								
				closetable();
			fim();
			}
		}
?>