<?php
include 'client_db_connect.php';
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

$code = mysql_real_escape_string($get['code']);
$totals = mysql_real_escape_string($get['totals']);

if(isset($get['cmd_discount']) && $get['cmd_discount'] == 'checkCode') {

if(!isUserID($user)) {
echo "Use only letters, numbers, or underscore";
exit();
}

if(empty($code) ) {
echo "Please enter the code";
exit();
}
$rs_duplicate = mysql_query("select count(*) as total from mu_members where username='$user' ") or die(mysql_error());
list($total) = mysql_fetch_row($rs_duplicate);

	if ($total > 0)
	{
	echo "Already taken. Please choose another username";
	} else {
	echo "Available: You can use this.";
	}
	exit();
}
?>