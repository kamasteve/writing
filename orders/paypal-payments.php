<?php
include '../client_db_connect.php';
list($paypal_email) = mysql_fetch_row(mysql_query("select paypal_email from system where url = '$siteUrl'")); 

// PayPal settings
$paypal_email = $paypal_email;
$return_url = $site_URL.'/orders/payment-successful.php';
$cancel_url = $site_URL.'/orders/c_manage_orders.php?qoption=pending&doSearch=View';
$notify_url = $site_URL.'/orders/paypal-payments.php';
/*
$sql_t_o = "select * from orders where  order_no ='$_POST[item_number]' ";
	  $rs_results = mysql_query($sql_t_o) or die(mysql_error());  	  
	  $t_order_row = mysql_fetch_array($rs_results); */
   
$item_name = $_POST['item_name'];
$item_amount = $_POST['item_amount'];

// Include Functions
include("functions.php");

//Database Connection


// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){

	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";	
	
	// Append amount& currency (£) to quersytring so it cannot be edited in html
	
	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "amount=".urlencode($item_amount)."&";
	
	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);
	
	// Append querystring with custom field
	//$querystring .= "&custom=".USERID;
	
	// Redirect to paypal IPN
	//header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
	header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
	//$paypal_url='https://www.paypal.com/cgi-bin/webscr';
	exit();

}else{
	
	// Response from Paypal

	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
		$req .= "&$key=$value";
	}
	
	// assign posted variables to local variables
	$data['item_name']			= $_POST['item_name'];
	$data['item_number'] 		= $_POST['item_number'];
	$data['payment_status'] 	= $_POST['payment_status'];
	$data['payment_amount'] 	= $_POST['mc_gross'];
	$data['payment_currency']	= $_POST['mc_currency'];
	$data['txn_id']				= $_POST['txn_id'];
	$data['receiver_email'] 	= $_POST['receiver_email'];
	$data['payer_email'] 		= $_POST['payer_email'];
	$data['custom'] 			= $_POST['custom'];
		
	// post back to PayPal system to validate
	$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	
	$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);	
	
	if (!$fp) {
		// HTTP ERROR
	} else {	

		fputs ($fp, $header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);
			if (strcmp($res, "VERIFIED") == 0) {
			
				// Used for debugging
				//@mail("you@youremail.com", "PAYPAL DEBUGGING", "Verified Response<br />data = <pre>".print_r($post, true)."</pre>");
						
				// Validate payment (Check unique txnid & correct price)
				$valid_txnid = check_txnid($data['txn_id']);
				$valid_price = check_price($data['payment_amount'], $data['item_number']);
				// PAYMENT VALIDATED & VERIFIED!
				if($valid_txnid && $valid_price){				
					$orderid = updatePayments($data);		
					if($orderid){					
						// Payment has been made & successfully inserted into the Database								
					}else{								
						// Error inserting into DB
						// E-mail admin or alert user
					}
				}else{					
					// Payment made but data has been changed
					// E-mail admin or alert user
				}						
			
			}else if (strcmp ($res, "INVALID") == 0) {
			
				// PAYMENT INVALID & INVESTIGATE MANUALY! 
				// E-mail admin or alert user
				
				// Used for debugging
				//@mail("you@youremail.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
			}		
		}		
	fclose ($fp);
	}	
}
?>