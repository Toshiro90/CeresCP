<?php

/** PayPal IPN Script
 * 
 * See https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/howto_html_instantpaymentnotif
 * for a lot of good information about IPN
 * You can look at the long list of $_POST[''] variables below
 * to see what potentially could be sent to this script. Or see
 * https://www.paypal.com/IntegrationCenter/ic_ipn-pdt-variable-reference.html
 * 
 * The base of this script is provided by PayPal at
 * https://www.paypal.com/cgi-bin/webscr?cmd=p/xcl/rec/ipn-code-outside
 * and
 * https://www.paypaltech.com/SG2/
 * 
 * These scripts were modified and commented by Jason DeBord www.jasondebord.net
 * Further modification to fit Ceres Control Panel by KaityRoux
*/

//Only allow paypal to talk to this page
//Dont worry, additional security is added in the .htaccess
$access = ('64.4.241.16', '64.4.241.32', '216.113.188.202', '216.113.188.203', '216.113.188.204', '66.211.170.66', '66.135.197.163', '66.135.197.164', '66.135.197.160', '216.113.169.205', '66.211.169.2', '66.211.169.65');
if (!in_array($_SERVER['REMOTE_ADDR'],$access)) {
    echo "Access denied.";
    exit();
}  

include('../config.php');
include('../functions.php');
// First prepare to send all of the information back to Paypal

$req = 'cmd=_notify-validate';

// Build string by putting all of the $_POST variables together: $req = &item_name=someitem&item_number=somenumber etc...

foreach ($_POST as $key => $value) {
	
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
	
}



// Assign posted variables to local variables to use in your database entries later on
// See https://www.paypal.com/IntegrationCenter/ic_ipn-pdt-variable-reference.html for details about each of these variables
// Many of them probably won't be used

$item_name = $_POST['item_name'];
$business = $_POST['business'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$mc_gross = $_POST['mc_gross']; // Total of transaction
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$receiver_id = $_POST['receiver_id'];
$quantity = $_POST['quantity'];
$num_cart_items = $_POST['num_cart_items'];
$payment_date = $_POST['payment_date'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$payment_type = $_POST['payment_type'];
$payment_status = $_POST['payment_status'];

/*
 * Possible payment_status values:
 * 
 * Canceled-Reversal
 * Completed
 * Denied
 * Expired
 * Failed
 * In-Progress
 * Pending
 * Processed
 * Refunded
 * Reversed
 * Voided
*/

$payment_gross = $_POST['payment_gross'];
$payment_fee = $_POST['payment_fee'];
$settle_amount = $_POST['settle_amount'];

$txn_type = $_POST['txn_type'];
$payer_status = $_POST['payer_status'];
$address_street = $_POST['address_street'];
$address_city = $_POST['address_city'];
$address_state = $_POST['address_state'];
$address_zip = $_POST['address_zip'];
$address_country = $_POST['address_country'];
$address_status = $_POST['address_status'];
$item_number = $_POST['item_number'];
$tax = $_POST['tax'];
$option_name1 = $_POST['option_name1'];
$option_selection1 = $_POST['option_selection1'];
$option_name2 = $_POST['option_name2'];
$option_selection2 = $_POST['option_selection2'];
$for_auction = $_POST['for_auction'];
$invoice = $_POST['invoice'];
$custom = $_POST['custom']; // Pass custom information to the script for an item. Customer does not see this variable's value.
$notify_version = $_POST['notify_version'];
$verify_sign = $_POST['verify_sign'];
$payer_business_name = $_POST['payer_business_name'];
$payer_id =$_POST['payer_id'];
$mc_currency = $_POST['mc_currency'];
$mc_fee = $_POST['mc_fee'];
$exchange_rate = $_POST['exchange_rate'];
$settle_currency  = $_POST['settle_currency'];
$parent_txn_id  = $_POST['parent_txn_id'];
$pending_reason = $_POST['pending_reason'];
$reason_code = $_POST['reason_code'];

$payer_email = $_POST['payer_email']; // PayPal user's email (customer's email that they use with their paypal account)

//DB connect credentials and email


$DB_Server = $CONFIG['cp_serv']; //your MySQL Server
$DB_Username = $CONFIG['cp_user']; //your MySQL User Name
$DB_Password = $CONFIG['cp_pass']; //your MySQL Password
$DB_DBName = $CONFIG['cp_db']; //your MySQL Database Name

$sql = mysql_connect($DB_Server, $DB_Username, $DB_Password);
if($payer_status == 'Completed') {

	$time = time();
	$accid = $custom;
	$cashpoints = $quantity * 100;
	//update the users credits in the donation table
	mysql_select_db($DB_DBName, $sql);
	$query = "UPDATE `donationx` SET `cashpoints` = 'cashpoints'+'$cashpoints' WHERE `accid` = '$accid'";
	$exec = mysql_query($query);
	if(!$exec) { //User must not have any cashpoints, so insert them.
		mysql_query("INSERT INTO $DB_DBName.`donationx`(time,accid,amount) VALUES('$time','$accid','$cashpoints')");
	}
	die();

}




?>
