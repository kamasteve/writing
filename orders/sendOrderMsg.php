<?php
include '../client_db_connect.php'; 
// Read the form values
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}
$success = false;
$senderName = isset( $_POST['senderName'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['senderName'] ) : "";
$senderEmail = isset( $_POST['senderEmail'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['senderEmail'] ) : "";
$senderID =isset( $_POST['senderID'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['senderID'] ) : "";
$senderTo =isset( $_POST['senderTo'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['senderTo'] ) : "";
$order_no = isset( $_POST['o_no'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['o_no'] ) : "";
$message = $data[message] ;

//$message = mysql_real_escape_string($_POST['message']);
// If all values exist, send the email
if ( $senderTo && $senderEmail && $message ) {

	//We check if the recipient exists
		$dn1 = mysql_fetch_array(mysql_query('select count(id) as recip, email, id as recipid, (select count(*) from pm) as npm from mu_members where username="'.$senderTo.'"'));
		$email_to=$dn1['email']	;			

		if($dn1['recip']==1)
		{
			//We check if the recipient is not the actual user
			if($dn1['recipid']!=$senderID)
			{
				$id = $dn1['npm']+1;
				//We send the message
				if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read, order_no)values("'.$id.'", "1", "'.$title.'", "'.$senderID.'", "'.$dn1['recipid'].'", "'.$message.'", "'.time().'", "yes", "no", "'.$order_no.'")'))
			
				{
//THIS SENDS THE EMAIL	
$from_email= $senderEmail;	
$full_message	=
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">

'.$message . '


<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
'.ucfirst(strtolower($senderName)).'
</span>
</div>
</body>
</html>
';
		
  $to = $email_to;
    $from = "Order Message - ".SITE_NAME."<$site_email>";
    $subject = "There is a message on Order $order_no"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
  $success =  @mail($to, $subject, $full_message, $headers.
    "X-Mailer: PHP/" . phpversion());	 
	// $success ='Msg Sent';
    }
   }
 }
}

// Return an appropriate response to the browser
if ( isset($_GET["ajax"]) ) {
  echo $success ? "success" : "error";
} else {
?>
<html>
  <head>
    <title>Thanks!</title>
  </head>
  <body>
  <?php if ( $success ) echo "<p>Your Message has been sent Successfully.</p>" ?>
  <?php if ( !$success ) echo "<p>There was a problem sending your message. Please try again.</p>" ?>
  <p>Click your browser's Back button to return to the page.</p>
  </body>
</html>
<?php
}
?>


