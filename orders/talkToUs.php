<?php
include '../client_db_connect.php'; 
// Read the form values
$success = false;
$senderName = isset( $_POST['senderName'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['senderName'] ) : "";
$senderEmail = isset( $_POST['senderEmail'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['senderEmail'] ) : "";
$senderTo = isset( $_POST['senderTo'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['senderTo'] ) : "";
$message = isset( $_POST['message'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['message'] ) : "";

//$message = mysql_real_escape_string($_POST['message']);

// If all values exist, send the email
if ( $senderName && $senderEmail && $message ) {
$recipient = " <" . $senderTo . ">";
$host  = $_SERVER['HTTP_HOST'];
$from_email= $senderEmail;	

$full_message	= $message . "\n

Regards,\n
".ucfirst(strtolower($senderName))." \n
______________________________________________________

";	
  
$success =@mail($senderTo, "A message from ".SITE_NAME, $full_message,
"From: \"".$senderName." - " .SITE_NAME."\" <".$site_email.">\r\n" .
"X-Mailer: PHP/" . phpversion()); 

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
  <?php if ( $success ) echo "<p>Thanks for sending your message! We'll get back to you shortly.</p>" ?>
  <?php if ( !$success ) echo "<p>There was a problem sending your message. Please try again.</p>" ?>
  <p>Click your browser's Back button to return to the page.</p>
  </body>
</html>
<?php
}
?>





