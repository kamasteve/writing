<?php
function check_txnid($tnxid){
	//global $link;
	return true;
	$valid_txnid = true;
    //get result set
    $sql = mysql_query("SELECT * FROM `thefunds` WHERE txnid = '$tnxid'");		
	if($row = mysql_fetch_array($sql)) {
        $valid_txnid = false;
	}
    return $valid_txnid;
}

function check_price($price, $id){
    $valid_price = false;
    //you could use the below to check whether the correct price has been paid for the product
    
	/* 
	$sql = mysql_query("SELECT amount FROM `products` WHERE id = '$id'");		
    if (mysql_numrows($sql) != 0) {
		while ($row = mysql_fetch_array($sql)) {
			$num = (float)$row['amount'];
			if($num == $price){
				$valid_price = true;
			}
		}
    }
	return $valid_price;
	*/
	return true;
}

function updatePayments($data){	
   // global $link;
	if(is_array($data)){				
        $sql2 = mysql_query("INSERT INTO `thefunds` (txnid, payment_amount, payment_status, itemid, createdtime) VALUES (
                '".$data['txn_id']."' ,
                '".$data['payment_amount']."' ,
                '".$data['payment_status']."' ,
                '".$data['item_number']."' ,
                '".date("Y-m-d H:i:s")."' 
                )");
				
	mysql_query("update orders set status='Av' where order_no='$data[item_number]'");	
//send email
$message_to_admin = 
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">

A new order '.$data[item_number].' has been placed by client '.ucfirst($_SESSION[username]).'.

<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
Support Department, <br>
<strong><i>'.SITE_HOST_NAME.' </i></strong><br>
Email: '.$site_email.'
</span>
</div>

</body>
</html>
';
//to admin
    $to_admin = $site_email;
    $from = "Order created - ".SITE_NAME."<$site_email>";
    $subject = "New order  from client"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    @mail($to_admin, $subject, $message_to_admin, $headers.
    "X-Mailer: PHP/" . phpversion());
		
    return mysql_insert_id($sql2);
    }
}
?>