<?php
include 'client_db_connect.php';
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$total = base64_decode($_GET['total']);
echo calculate_discount($_GET['code'],$total);

function calculate_discount($code,$total) {
date_default_timezone_set('Africa/Nairobi');// Africa/Nairobi

if ($code && $total) {

        $now = time();
	    list($discount_offer_on_totals) = mysql_fetch_row(mysql_query("select discount_offer from orders_discounts")); 
		if ( $total < $discount_offer_on_totals ) {
		return "Order total must be $ ". $discount_offer_on_totals." or more to qualify for discount!";
		}
		// check if code is valid and return result
		$sql = @mysql_query("SELECT * FROM orders_discounts WHERE codex = '$code' AND expiry > $now AND status = 1 AND $total > discount_offer");
		if (@mysql_num_rows($sql) == 0) {
			return "Invalid coupon code. Please try again.";

		} else {
			return mysql_result($sql, 0, "percentage");
			exit();

		}
	} else {
		return "invalid request!";

	}

}

?>