<?php
include 'client_db_connect.php';
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
$user = mysql_real_escape_string($get['user']);
$user_email = mysql_real_escape_string($get['user_email']);

// check user
if(isset($get['cmd']) && $get['cmd'] == 'check') {

if(!isUserID($user)) {
echo "Use only letters, numbers, or underscore";
exit();
}

if(empty($user) && strlen($user) <=3) {
echo "Enter 6 chars or more";
exit();
}
$rs_duplicate = mysql_query("select count(*) as total from mu_members where username='$user' ") or die(mysql_error());
list($total) = mysql_fetch_row($rs_duplicate);

	if ($total > 0)
	{
	echo "Already taken. Please choose another username";
	} else {
	echo "Perfect: You can use this.";
	}
	exit();
}
// check email
if(isset($get['cmd_email']) && $get['cmd_email'] == 'checkTheEmail') {

if(!isEmail($user_email)) {
echo "Please enter a valid email address.";
exit();
}	

$rs_duplicate_e = mysql_query("select count(*) as total from mu_members where email='$user_email'") or die(mysql_error());
list($total_e) = mysql_fetch_row($rs_duplicate_e);
  if ($total_e > 0)
    {
    echo "! The email already exists. Perhaps your are registered already. Log in to your account istead";
    } else {
	echo "Perfect: You can use this.";
    }
   exit();
}
?>