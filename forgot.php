<?php 
include 'client_db_connect.php';
if ($_POST['doReset']=='Reset')
{
$err = array();
$msg = array();

foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}
if(!isEmail($data['user_email'])) {
$err[] = "ERROR - Please enter a valid email"; 
}
$user_email = $data['user_email'];

//check if activ code and user is valid as precaution
$rs_check = mysql_query("select id from mu_members where email='$user_email' and user_level='2'") or die (mysql_error()); 
$num = mysql_num_rows($rs_check);
  // Match row found with more than 1 results  - the user is authenticated. 
    if ( $num <= 0 ) { 
	$err[] = "Error - Sorry no such account exists or registered.";
	//header("Location: forgot.php?msg=$err");
	//exit();
	}

if(empty($err)) {
$new_pwd = GenPwd();
$pwd_reset = PwdHash($new_pwd);
//$sha1_new = sha1($new);	
//set update sha1 of new password + salt
$rs_activ = mysql_query("update mu_members set accpass='$pwd_reset' WHERE 
						 email='$user_email'") or die(mysql_error());
						 
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);						 
						 
//send email

$message = 
"
You recently requested for a password change! \n
Here are your new password details ...\n
Username: $user_email \n
Passwd: $new_pwd \n
You can change your password at 'My Profile' Section once logged in.\n
You may log in here\n
".$siteUrl."login?us_email=$user_email


Thank You

Regards,
$host_upper
______________________________________________________
";

	mail($user_email, "Reset Password", $message,
    "From: \"".SITE_NAME."\" <$site_email>\r\n" .
     "X-Mailer: PHP/" . phpversion());						 
						 
$msg[] = "Your account password has been reset. <br><br> Kindly check your email address for more details.";						 						 
//$msg = urlencode();
//header("Location: forgot.php?msg=$msg");						 
//exit();
 }
}
?>
<html>
<head>
<title>Forgot Password</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/javascript" src="j_s/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="j_s/jquery.validate.js"></script>
  <script>
  $(document).ready(function(){
    $("#actForm").validate();
  });
  </script>
<link href="order_styles/styles.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>
<body>
<?php include ROOT_DIR_C. 'header.php'; ?> 
<div id="main-content">
<table align="center" border="0"  style="padding-top:50px; margin:auto">
    <tr> 
    <td width="100%" valign="top">
<h3 align="center" class="titlehdr">Forgot Password?</h3>

      <p align="center"><span class="style4"></span>Well, it happens. Enter your email and hit 'reset'.<br> Further details will be emailed to you.
        </p>
	 
      <form action="forgot.php" method="post" name="actForm" id="actForm" >
        <table width="100%" border="0" align="center"  class="login" style="padding-top:20px;">
          <tr> 
            <td colspan="2">
<?php 
	if(!empty($err))  {
	   echo "<div class=\"error\">";
	  foreach ($err as $e) {
	    echo "* $e <br>";
	    }
	  echo "</div>";	
	   }
	   if(!empty($msg))  {
	    echo "<div class=\"msg_l\">" . $msg[0] . "</div>";

	   }
	  /******************************* END ********************************/	  
	  ?></td>
          </tr>
          <tr> 
            <td width="19%">Your Email</td>
            <td width="81%"><input name="user_email" type="text"  class="required email" id="user_email" size="25"> </td>
          </tr>
          <tr> 
            <td colspan="2"> <div align="right"> 
                  <input name="doReset" type="submit"  class="input_submit" id="doLogin3" value="Reset">

              </div></td>
          </tr>
        </table>
      </form>   
    </td>
  </tr>
  </table>
  </div>
<?php include ROOT_DIR_C. 'footer.php'; ?> 
</body>
</html>