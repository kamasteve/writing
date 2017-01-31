<?php
$err = array();
foreach($_GET as $key => $value) {
	$get[$key] = filter($value); //get variables are filtered.
}
if ($_POST['doLogin']=='Log in')
{
foreach($_POST as $key => $value) {
	$data[$key] = filter($value); // post variables are filtered
}
$user_email = $data['usr_email'];
$pass = $data['pwd'];
if (strpos($user_email,'@') === false) {
    $user_cond = "username='$user_email' and role <> 'writer'";
} else {
      $user_cond = "email='$user_email' and role <> 'writer'";
}
$result = mysql_query("SELECT `id`,`accpass`,`username`,`email`,`approved`,`user_level` FROM mu_members WHERE 
           $user_cond
			AND `banned` = '0'") or die (mysql_error()); 
$num = mysql_num_rows($result);

  // Match row found with more than 1 results  - the user is authenticated. 
    if ( $num > 0 ) { 
	
	list($id,$pwd,$username,$email,$approved,$user_level) = mysql_fetch_row($result);
	
	if(!$approved) {
	//$msg = urlencode("Account not activated. Please check your email for activation code");
	$err[] = "You haven't been confirmed as a writer yet.<br> Kindly note that your details are under review for a possible inclusion as a writer<br>
	As soon as that happens, you will receive a confirmation.";
	
	//header("Location: login.php?msg=$msg");
	 //exit();
	 }
	 
		//check against salt
	if ($pwd === PwdHash($pass,substr($pwd,0,9))) { 
	if(empty($err)){			

     // this sets session and logs user in  
       session_start();
	   session_regenerate_id (true); //prevent against session fixation attacks.

	   // this sets variables in the session 
		$_SESSION['id']= $id;  
		$_SESSION['username'] = $username;
		$_SESSION['email'] = $email;
		$_SESSION['user_level'] = $user_level;
		$_SESSION['writer'] = $writer;
		$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
		
		//update the timestamp and key for cookie
		$stamp = time();
		$ckey = GenKey();
		mysql_query("update mu_members set `ctime`='$stamp', `ckey` = '$ckey' where id='$id'") or die(mysql_error());
		
		//set a cookie 
		
	   if(isset($_POST['remember'])){
				  setcookie("id", $_SESSION['id'], time()+60*60*24*COOKIE_TIME_OUT, "/");
				  setcookie("user_key", sha1($ckey), time()+60*60*24*COOKIE_TIME_OUT, "/");
				  setcookie("username",$_SESSION['username'], time()+60*60*24*COOKIE_TIME_OUT, "/");
				   }
		  header("Location: ../orders/");
		 }
		}
		else
		{
		//$msg = urlencode("Invalid Login. Please try again with correct user email and password. ");
		$err[] = "Invalid Login. Please try again with correct user email and password.";
		//header("Location: login.php?msg=$msg");
		}
	} else {
		$err[] = "Error - Invalid login. No such user exists";
	  }		
}
?>