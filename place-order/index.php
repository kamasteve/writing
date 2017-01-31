<?php 
include '../client_db_connect.php';
include '../session.php';
include '../top_log_in.php';
if(checkAdmin()) {
header("Location: ../orders/");
exit();
}
if(checkClient()) {
header("Location: ../orders/new.php");
exit();
}
$err = array();
$msg = array();
if($_POST['doPreview'] == 'Preview') 
{ 
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}
include '../orders/outputs_vars.php';

$o_topic = $_POST['topic'];
$o_details = $_POST['details'];

if(get_magic_quotes_gpc())
{
$o_topic = stripslashes($o_topic);
$o_details = stripslashes($o_details);
}
$title = mysql_real_escape_string($o_topic);
$instructions = mysql_real_escape_string($o_details);

$sha1pass = PwdHash($_POST['pwd']);
$usr_email = $data['email'];
$user_name = $data['username'];
if(empty($err)) {
//register
$get_new_id = mysql_query("SELECT MAX(id + 1) AS theid FROM  mu_members");
    $last_ids = mysql_fetch_assoc($get_new_id);
    $the_id= $last_ids['theid'];
//
$sql_insert = "INSERT into `mu_members` 			(`id`,`firstname`,`lastname`,`email`,`accpass`,`username`,`country`,`phone1`,`phone2`,`date`,`approved`,`user_level`,`role`, `domain_name`)
		    VALUES ('$the_id','$data[firstname]','$data[lastname]','$usr_email','$sha1pass','$user_name','$data[country]','$data[phone1]','$data[phone2]',now(),'1','2','client','$domain_name')
			";		
mysql_query($sql_insert,$connect) or die("Insertion Failed:" . mysql_error());
$id = mysql_insert_id($connect);  
$md5_id = md5($id);
mysql_query("update mu_members set md5_id='$md5_id' where id='$the_id'"); // added
session_start(); 
session_regenerate_id (true); //prevent against session fixation attacks.

	   // this sets variables in the session 
		$_SESSION['id']= $the_id; 
		$_SESSION['username'] = $user_name;
		$_SESSION['email'] = $usr_email;
		$_SESSION['user_level'] = 2;
		$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
		
		//update the timestamp and key for cookie
		$stamp = time();
		$ckey = GenKey();
		mysql_query("update mu_members set `ctime`='$stamp', `ckey` = '$ckey' where id='$the_id'") or die(mysql_error());

// create order	
   $get_details = mysql_query("SELECT *  FROM  mu_members where id='$_SESSION[id]'  = '$_SESSION[username]'");
    $therow = mysql_fetch_assoc($get_details);
	$fname= $therow['firstname'];
    $s_email= $therow['email'];
    $lname= $therow['lastname']; 
    $user_id= $_SESSION['id'];
    
	$get_new_order_no = mysql_query("SELECT MAX(order_no + 1) AS max_order_no FROM orders");
    $last_order_no = mysql_fetch_assoc($get_new_order_no);
    $order_no= $last_order_no['max_order_no'];
	
	//$order_cost= $data['totals'] - ($data['totals']*($price_override/100));
	
	$order_cost= $data['numpages']*$admin_site_base_price;

$sql_insert = "INSERT into `orders` 	(`numpages`,`topic`,`o_interval`,`urgency`,`style`,`vip_support`,`top_writers`,`academic_level`,`numberOfSources`,`subject_area`,`order_details`,`doctype`,`date`,`client_id`,`order_no`,`rowtotals`,`client_cost`,`curr`,`track_order_id`, `from_site`)
		    VALUES ('$data[numpages]','$title','$word_spacing','$urgency','$citation_style','$vip_support','$top_writers','$acdmcLevel','$data[numberOfSources]','$subject_area','$instructions','$documentType',NOW(),'$user_id', '$order_no','$order_cost','$data[totals]','$the_currency', '$data[track_order_id]', '$domain_name')
			";
mysql_query($sql_insert,$connect) or die("Insertion Failed:" . mysql_error());

//notify admin
$message_to_admin = 
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">
A new order has been place at '.SITE_HOST_NAME.'<br>
Here are the Order details:<br>
<b>Order Number:</b> #'.$order_no.'<br>
<b>Order Topic:</b> '.$title.'<br>
<b>No of Pages:</b> '.$data[numpages].'<br>
<b>Amount:</b> $'.$data[totals].'<br>
<b>Type of Document:</b> '.$documentType.'<br>
<b>Deadline:</b> '.date("jS M Y @ H:i:s A",$urgency).'<br>
<b>Order Details:</b> '.$instructions.'<br>

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

$l =rand_my_string(60);
$x =rand_my_string(30);
$theorder = base64_encode($order_no);
$themsg ='Welcome and thank you for registering at '.SITE_HOST_NAME;
$message= base64_encode($themsg);
header("Location: ../orders/checkout-p.php?_id=$l&d=$order_no&x=$x&o=$theorder&m=$message");  
exit();
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Order Now - <?php echo SITE_HOST_NAME ;?></title>
<link href="<?php echo BASE_URL_C ?>order_styles/styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo BASE_URL_C ?>j_s/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_C ?>j_s/order.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_C ?>j_s/order_pricing.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_C ?>j_s/urgency.js"></script>
<script type="text/javascript" >
$(document).ready(function(e) {
    $("#academic_level").change(function(){
        var textval = $(":selected",this).text();
        $('input[name=academic_level_txt]').val(textval);
    });
});
</script>
</head>
<body>
<?php include ROOT_DIR_C.  'header.php'; ?>
<section class ="contentarea wrapp">
<div class="row-fluid">   

<div class="span3">
                <div class="left-sidebar">
 <div id="text-20" class="widget widget_text"><h3 class="widgettitle"><b></b></h3>			<div class="textwidget"><ul class="right"><img src="http://premierpapers.com/images/widget1.png" alt="image"/>

<ul class="check">
<li>Clearly type the topic of your essay, paper, or assignment.</li>
<li>Select the subject of the assignment e.g. “Business Studies.</li>
<li>Choose the type of the document you are requesting for.</li>
<li>Select the paper spacing, please tick “Single Space” only if your professor advised so.</li>
<li>Select the urgency of your paper. Please make sure you give an allowance between your professor’s deadline and our deadline in order to have sufficient time to review your complete paper.</li>
<li>Choose your Academic Level, this determines the skills level of the writer who will handle your work.</li>
<li>Tick Graph work if your work involves graphs.</li>
<li>Tick VIP if your deadline is less than 6 hours.</li>
<li>Select the number of references required for your work.</li>
<li>Select the style for your work e.g. MLA, APA, etc.</li>
<li>Select the preferred currency, or leave the currency to default (USD).</li>
<li>Select the preferred Language, mainly UK or US English.</li>
<li>Enter a tracking ID ( a random number, usually optional).</li>
<li>Type the order description. Please give us as much information as possible, don’t leave out any detail. Additional information can be attached at the Manage Orders page.</li>
<li>Fill in the personal details, you must provide valid constants to facilitate communication.</li>
</ul></div>
				</div>                </div>
            </div>	
<div class="span8">
<?php
	  if(!empty($err))  {
	   echo "<div class=\"msg\">";
	  foreach ($err as $e) {
	    echo "$e <br>";
	    }
	  echo "</div>";	
	   }
	  ?>
 <div class="place_order">Place Order</div>     	
<form action="" method="post"  name="placeOrderForm" id="placeOrderForm" >
<div class="orderform">
<div class="the_order_pane">
<?php include ROOT_DIR_C.  'orders/order-pane.php'; ?>
<?php include ROOT_DIR_C.  'orders/order-signup.php'; ?>
<?php include ROOT_DIR_C.  'orders/order-foot.php'; ?>
</div>
</div>
</form>
</div>  
</div>
</section>
<?php include ROOT_DIR_C. 'footer.php'; ?> 
</body>
</html>