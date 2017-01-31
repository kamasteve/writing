<?php 
include '../client_db_connect.php';
page_protect();

if(!checkAdmin()) {
header("Location: ../index.php");
exit();
}

$ret = $_SERVER['HTTP_REFERER'];

foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

if($get['cmd'] == 'approve_client')
{
mysql_query("update mu_members set approved='1' where id='$get[id]'") or die(mysql_error());

$rs_email = mysql_query("select email from mu_members where id='$get[id]'") or die(mysql_error());
list($to_email) = mysql_fetch_row($rs_email);

$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$login_path = @ereg_replace('admin','',dirname($_SERVER['PHP_SELF']));
$path   = rtrim($login_path, '/\\');

$message = 
"
Thank you for registering with us. Your order has been approved...\n

*****LOGIN LINK*****\n
http://".SITE_HOST_NAME."/login/

Thank You

Administrator"
.SITE_HOST_NAME."
______________________________________________________

";

	@mail($to_email, "Approved", $message,
    "From: \"Approved\" <info@".SITE_HOST_NAME."\r\n" .
     "X-Mailer: PHP/" . phpversion());

 echo "Active";
}

if($get['cmd'] == 'approve_writer')
{
mysql_query("update mu_members set approved='1' where id='$get[id]'") or die(mysql_error());

$rs_email = mysql_query("select email, username from mu_members where id='$get[id]'") or die(mysql_error());
$to_w_rows = mysql_fetch_array($rs_email);
$to__w_email =$to_w_rows['email'];
$to_w_username =$to_w_rows['username'];

$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$login_path = @ereg_replace('admin','',dirname($_SERVER['PHP_SELF']));
$path   = rtrim($login_path, '/\\');

$message = 
"
Dear $to_w_username,\n

Welcome to ". SITE_HOST_NAME." . 

Click on the link to log into your account \n
http://".SITE_HOST_NAME."/login/ \n

Sincerely, \n
".SITE_HOST_NAME.", Clients Department \n
Email: writers.support@".SITE_HOST_NAME." \n

".SITE_HOST_NAME."
______________________________________________________

";

	@mail($to__w_email, "Your Clients Application Has Been Approved", $message,
    "From: \"Clients Application Approved\" <info@$host>\r\n" .
     "X-Mailer: PHP/" . phpversion());

 echo "Active";
}

if($get['cmd'] == 'approve_order')

if (isset($_GET['clientid']))  {
  $theclient=$_GET['clientid'];
}
{
mysql_query("update orders set status='Av', order_status='1' where order_no='$get[id]'") or die(mysql_error());

$rs_email = mysql_query("select email from mu_members where id='$theclient'") or die(mysql_error());
list($to_email) = mysql_fetch_row($rs_email);

$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$login_path = @ereg_replace('admin','',dirname($_SERVER['PHP_SELF']));
//$path   = rtrim($login_path, '/\\');

$message = 
"Your order has been approved and will be assigned to the appropriate writer.

You may log in below to track status of your order(s).\n
http://".SITE_HOST_NAME."/login/

Regards,

Administrator\n
"SITE_HOST_NAME"
______________________________________________________

";

    @mail($to_email, "Thank you for placing an order with us", $message,
    "From: <info@".SITE_HOST_NAME.".com>\r\n" .
     "X-Mailer: PHP/" . phpversion());

 echo "Approved";
}

if($get['cmd'] == 'ban')
{
mysql_query("update mu_members set banned='1' where id='$get[id]' and `username` <> 'admin'");

$rs_email = mysql_query("select email from mu_members where id='$get[id]'") or die(mysql_error());
list($to_email) = mysql_fetch_row($rs_email);

$message = 
"Dear client, \n
We regret to inform you that we are removing your ".SITE_NAME." writing permissions. 

Best Regards, \n
".SITE_HOST_NAME." Clients Department \n
Email: support@".SITE_HOST_NAME." \n
______________________________________________________

";

	@mail($to_email, "Your Account with us terminated ".SITE_HOST_NAME." Terminated", $message,
    "From: \"Account Termination\" <info@".SITE_HOST_NAME.">\r\n" .
     "X-Mailer: PHP/" . phpversion());

 echo "Yes";

}
/* Editing users*/

if($get['cmd'] == 'edit')
{
/* Duplicate user name check */
$rs_usr_duplicate = mysql_query("select count(*) as total from `mu_members` where `username`='$get[user_name]' and `id` != '$get[id]'") or die(mysql_error());
list($usr_total) = mysql_fetch_row($rs_usr_duplicate);
	if ($usr_total > 0)
	{
	echo "Sorry! user name already registered.";
	exit;
	} 
/* Duplicate email check */	
$rs_eml_duplicate = mysql_query("select count(*) as total from `mu_members` where `email`='$get[user_email]' and `id` != '$get[id]'") or die(mysql_error());
list($eml_total) = mysql_fetch_row($rs_eml_duplicate);
	if ($eml_total > 0)
	{
	echo "Sorry! user email is already registered.";
	exit;
	}
/* Now update user data*/	
mysql_query("
update mu_members set  
`username`='$get[user_name]', 
`email`='$get[user_email]',
`user_level`='$get[user_level]'
where `id`='$get[id]'") or die(mysql_error());
//header("Location: $ret"); 

if(!empty($get['pass'])) {
$hash = PwdHash($get['pass']);
mysql_query("update mu_members set `accpass` = '$hash' where `id`='$get[id]'") or die(mysql_error());
}

echo "changes done";
exit();
}

// Read message
if($get['cmd'] == 'message')

{
$sql_id = "select id from mu_members where id ='$_SESSION[id]'";
	  $rs_id = mysql_query($sql_id) or die(mysql_error());
	  $row_id= mysql_fetch_array($rs_id);


$check_details = mysql_query("select email from `mu_members` where `email`='$get[user_email]' and `id` = '$get[user_id]' and `order_no` = '$get[order_no]'") or die(mysql_error());
$rs_email = mysql_query($check_details) or die(mysql_error());
$row= mysql_fetch_array($rs_email);
//

   switch($_POST['department'])
    {
      case "customer": $my_email = $row['email']; break;
      case "support": $my_email = 'info@'.SITE_HOST_NAME.; break;
     
    }
//
$email_to = $my_email;
    
//EMAIL_SUBJECT IS EMAIL SUBJECT
 $email_subject = "Your email subject line";
     
//EMAIL IS THE RETURN EMAIL ENTERED IN HTML.
 $email_from = $row_id['email'];
 
//DEPARTMENT IS THE SUM OF ALL YOUR CASES.
//ONLY THE OPTION SELECT WILL BE SEEN
 $department = $_POST['department'];
    
//EMAIL_MESSEGE TURNS THE OPTION SELECT INTO A STRING 
//AND DISPLAYS IT IN THE EMAIL
$email_message = "Option Selected: ".$department."\n";
$msg = ' Your Message has been sent';
     
     
//THIS SENDS THE EMAIL
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers); 


//THIS WILL REDIRECT THE USE TO A LANDING PAGE

 //  header( 'Location: order-page.php?msg=$msg' ) ;



/* send email*/	

}




if($get['cmd'] == 'unban')
{
mysql_query("update mu_members set banned='0' where id='$get[id]'");
echo "no";

//header("Location: $ret");  
// exit();

}

if($get['cmd'] == 'dissaprove_order') 
{
mysql_query("update mu_members set status='0', order_status='0' where id='$get[id]'") or die(mysql_error());
echo "Pending";

//header("Location: $ret");  
//exit();
}

//Aprove orders
/*
if($get['cmd'] == 'approve_order')
{
mysql_query("update mu_members set status='Av' where id='$get[id]'");

//header("Location: $ret");  
echo "Approved";
exit();
}
*/
//clear order---ordr paid for and processed.
if($get['cmd'] == 'clear')
{
mysql_query("update mu_members set status='Cl' where id='$get[id]'");

//header("Location: $ret");  
//echo "Cleared";
exit();
}

//mark as read
if($get['cmd'] == 'mark-as-read')
{
$id = $get[id];
//We get the title and the narators of the discussion


$req1 = mysql_query('select * from pm where id="'.$id.'" and id2="1"');
$dn1 = mysql_fetch_array($req1);
//We check if the discussion exists
if(mysql_num_rows($req1)==1)
{
//We check if the user have the right to read this discussion
if($dn1['user1']==$_SESSION['id'] or $dn1['user2']==$_SESSION['id'])
{
//The discussion will be placed in read messages
if($dn1['user1']==$_SESSION['id'])
{
	mysql_query('update pm set user1read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 2;
}
else
{
	mysql_query('update pm set user2read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 1;
}
}
}
echo 'Id Sent is: '. $id ;
} //mark as read get
?>

