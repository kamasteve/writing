<?php
$database = array();

$database['host']          = 'localhost';
$database['username']      = 'root'; //USERNAME : EDIT THIS
$database['password']      = ''; // USER PASSWORD : EDIT THIS
$database['database']      = 'userpaper'; // DATABASE :  EDIT THIS

$connect = @mysql_connect($database['host'] , $database['username'] , $database['password']);
if (!$connect)
{
	die (mysql_error());
}
@mysql_select_db($database['database'], $connect) or die ("Couldn't select database");
list($admin_domain_name) = mysql_fetch_row(mysql_query("select domain_name from system where site_type = 'backend'")); 
function get_base_url()
    {
        /* protocol the website is using */
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https://' : 'http://';
        /* returns /myproject/index.php */
        $path = $_SERVER['PHP_SELF'];
        
        $path_parts = pathinfo($path);
        $directory = $path_parts['dirname'];
        
        $directory = ($directory == "/") ? "" : $directory;

        /* Returns localhost OR mysite.com */
        $host_this = $_SERVER['HTTP_HOST'];

        return $protocol . $host_this ;
    }

$domain_name = stripit($_SERVER['HTTP_HOST']);
$upload_download_dir = '/home/writers/public_html/uploads/';

$url = $_SERVER['REQUEST_URI'];
$urlParse = parse_url($url);
$path = explode('/',$urlParse ['path']);
$site_URL= get_base_url('$host_this'); 
$siteUrl = stripit($site_URL);

define('ROOT_DIR_C', dirname(__FILE__) . '/');
define('BASE_URL_C', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR_C))));

list($curr_symbol) = mysql_fetch_row(mysql_query("select sys_curr from settings")); // currency symbol
list($admin_site_email) = mysql_fetch_row(mysql_query("select site_email from system where site_type = 'backend'")); 
list($admin_site_name) = mysql_fetch_row(mysql_query("select site_name from system where site_type = 'backend'")); 
list($admin_site_base_price) = mysql_fetch_row(mysql_query("select base_price from system where site_type = 'backend'")); 

$sql_site_settings = "select * from system where url = '$siteUrl'";
$result_site_settings = mysql_query($sql_site_settings) or die(mysql_error());
$row_site_settings = mysql_fetch_array($result_site_settings);


$url_home = 'mysettings.php';
$site_email= $row_site_settings['site_email'];
$admin_email =$row_site_settings['admin_email'];
$basePrice =$row_site_settings['base_price'];
$price_override = $row_site_settings['price_override'];

define ("SITE_HOST_NAME", $domain_name);
define ("SITE_NAME", $row_site_settings['site_name']);

$academicEmail= $admin_site_email;
define ("ACADEMIC_SITE_NAME",$admin_site_name);


$user_registration = 1;  // set 0 or 1
$writer_registration = 0;

define("COOKIE_TIME_OUT", 1); //specify cookie timeout in days (default is 10 days)
define('SALT_LENGTH', 9); // salt for password

/* Specify user levels */
define ("ADMIN_LEVEL", 5);
define ("WRITER_LEVEL", 3);
define ("CLIENT_LEVEL", 2);
define ("USER_LEVEL", 1);
define ("GUEST_LEVEL", 0);

function page_protect() {
if(!isset($_SESSION)) 
{ 
    session_start(); 
	date_default_timezone_set('Africa/Nairobi');// Africa/Nairobi
}
global $database; 
/* Secure against Session Hijacking by checking user agent */
if (isset($_SESSION['HTTP_USER_AGENT']))
{
    if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))
    {
        logout();
        exit;
    }
}
// before we allow sessions, we need to check authentication key - ckey and ctime stored in database
/* If session not set, check for cookies set by Remember me */
if (!isset($_SESSION['id']) && !isset($_SESSION['username']) ) 
{
	if(isset($_COOKIE['id']) && isset($_COOKIE['user_key'])){
	/* we double check cookie expiry time against stored in database */
	
	$cookie_user_id  = filter($_COOKIE['id']);
	$rs_ctime = mysql_query("select `ckey`,`ctime` from `mu_members` where `id` ='$cookie_user_id'") or die(mysql_error());
	list($ckey,$ctime) = mysql_fetch_row($rs_ctime);
	// coookie expiry
	if( (time() - $ctime) > 60*60*24*COOKIE_TIME_OUT) {

		logout();
		}
/* Security check with untrusted cookies - dont trust value stored in cookie. 		
/* We also do authentication check of the `ckey` stored in cookie matches that stored in database during login*/

	 if( !empty($ckey) && is_numeric($_COOKIE['id']) && isUserID($_COOKIE['username']) && $_COOKIE['user_key'] == sha1($ckey)  ) {
	 	  session_regenerate_id(); //against session fixation attacks.
	     
		 date_default_timezone_set('Africa/Nairobi');// Africa/Nairobi

		  $_SESSION['id'] = $_COOKIE['id'] ;
		  $_SESSION['username'] = $_COOKIE['username'];
		  
		/* query user level from database instead of storing in cookies */	
		  list($user_level) = mysql_fetch_row(mysql_query("select user_level from mu_members where id='$_SESSION[id]'"));
		  $_SESSION['user_level'] = $user_level;	

	$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
	   } else {
	   logout();
	   }
  } else {
	header("Location: ../index.php");
	exit();
	}
}
}
function filter($data) {
	$data = trim(htmlentities(strip_tags($data)));
	
	if (get_magic_quotes_gpc())
		$data = stripslashes($data);
	
	$data = mysql_real_escape_string($data);
	
	return $data;
}
function EncodeURL($url)
{
$new = strtolower(ereg_replace(' ','_',$url));
return($new);
}

function DecodeURL($url)
{
$new = ucwords(ereg_replace('_',' ',$url));
return($new);
}

function ChopStr($str, $len) 
{
    if (strlen($str) < $len)
        return $str;

    $str = substr($str,0,$len);
    if ($spc_pos = strrpos($str," "))
            $str = substr($str,0,$spc_pos);

    return $str . "...";
}	

function isNum($price){
return preg_match("/[^0-9]/", "",$price)? TRUE : FALSE;
}

function isEmail($email){
  return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
}

function isUserID($username)
{
	if (preg_match('/^[a-z\d_]{5,20}$/i', $username)) {
		return true;
	} else {
		return false;
	}
 }	
 
function isURL($url) 
{
	if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $url)) {
		return true;
	} else {
		return false;
	}
} 

function checkPwd($x,$y) 
{
if(empty($x) || empty($y) ) { return false; }
if (strlen($x) < 4 || strlen($y) < 4) { return false; }

if (strcmp($x,$y) != 0) {
 return false;
 } 
return true;
}

function GenPwd($length = 7)
{
  $password = "";
  $possible = "0123456789bcdfghjkmnpqrstvwxyz"; //no vowels
  
  $i = 0; 
    
  while ($i < $length) { 

    
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
       
    
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }

  }

  return $password;

}

function GenKey($length = 7)
{
  $password = "";
  $possible = "0123456789abcdefghijkmnopqrstuvwxyz"; 
  
  $i = 0; 
    
  while ($i < $length) { 

    
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
       
    
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }

  }

  return $password;

}
function rand_my_string( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}
	return $str;
}

function logout()
{
global $database;
session_start();
if(isset($_SESSION['id']) || isset($_COOKIE['id'])) {
mysql_query("update `mu_members` 
			set `ckey`= '', `ctime`= '' 
			where `id`='$_SESSION[id]' OR  `id` = '$_COOKIE[id]'") or die(mysql_error());
}			
/************ Delete the sessions****************/
unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['user_level']);
unset($_SESSION['writer']);
unset($_SESSION['HTTP_USER_AGENT']);
session_unset();
session_destroy(); 

/* Delete the cookies*******************/
setcookie("id", '', time()-60*60*24*COOKIE_TIME_OUT, "/");
setcookie("username", '', time()-60*60*24*COOKIE_TIME_OUT, "/");
setcookie("user_key", '', time()-60*60*24*COOKIE_TIME_OUT, "/");

$lg= 'You are now logged out';
header("Location: index.php?sign=$lg");
}
// Password and salt generation
function PwdHash($pwd, $salt = null)
{
    if ($salt === null)     {
        $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
    }
    else     {
        $salt = substr($salt, 0, SALT_LENGTH);
    }
    return $salt . sha1($pwd . $salt);
}
function checkAdmin() { //admin

if($_SESSION['user_level'] == ADMIN_LEVEL) {
return 1;
} else { return 0 ;
}
}

function checkWriter() { //writer

if($_SESSION['user_level'] == WRITER_LEVEL) {
return 1;
} else { return 0 ;
}
}

function checkClient() { //client
if($_SESSION['user_level'] == CLIENT_LEVEL) {
return 1;
} else { return 0 ;
}
}

function ShortenText($text) {
        $chars = 30;
        $text = $text." ";
        $text = substr($text,0,$chars);
        $text = substr($text,0,strrpos($text,' ')).'.....';
        
        return $text;

    }
//
function dateDiff($time1, $time2, $precision = 6) {

    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
   if ($time1 > $time2) {
     $ttime = $time1;
    $time1 = $time2;
     $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Set default diff to 0
      $diffs[$interval] = 0;
      // Create temp time from time1 and interval
      $ttime = strtotime("+1 " . $interval, $time1);
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
	$time1 = $ttime;
	$diffs[$interval]++;
	// Create new temp time from time1 and interval
	$ttime = strtotime("+1 " . $interval, $time1);
      }
    }
 
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
	break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
	// Add s if value is not 1
	if ($value != 1) {
	  $interval .= "s";
	}
	// Add value and interval to times array
	$times[] = $value . " " . $interval;
	$count++;
      }
    }
    // Return string with times
    return implode(", ", $times);
  }
//

	
function stripit ( $url ) {
    $url = trim($url);
    $url = preg_replace("/^(http:\/\/)*(www.)*/is", "", $url);
    $url = preg_replace("/\/.*$/is" , "" ,$url);
    return $url;
    }	
?>