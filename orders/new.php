<?php 
include '../client_db_connect.php';
page_protect();
if(!checkClient()) {
header("Location: index.php");
exit();
}
$err = array();
$msg = array();
if($_POST['doPreview'] == 'Preview') 
{ 
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}
include 'outputs_vars.php';

$o_topic = $_POST['topic'];
$o_details = $_POST['details'];

if(get_magic_quotes_gpc())
{
$o_topic = stripslashes($o_topic);
$o_details = stripslashes($o_details);
}
$title = mysql_real_escape_string($o_topic);
$instructions = mysql_real_escape_string($o_details);

if(empty($err)) {
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
		    VALUES ('$data[numpages]','$title','$word_spacing','$urgency','$citation_style','$vip_support','$top_writers','$data[academic_level_txt]','$data[numberOfSources]','$subject_area','$instructions','$documentType',NOW(),'$user_id', '$order_no','$order_cost','$data[totals]','$the_currency', '$data[track_order_id]', '$domain_name')
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
header("Location: ../orders/checkout-p.php?_id=$l&d=$order_no&x=$x&o=$theorder");  
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
    })
});
</script>
</head>
<body>
<?php include ROOT_DIR_C.  'header.php'; ?>
<div id="main-content">   
<div id="leftcolumn">
<?php include 'access-links.php' ;  ?>
</div>
<div id="the_order_form">
<div class="o_steps"></div>
 <?php
	  if(!empty($err))  {
	   echo "<div class=\"msg\">";
	  foreach ($err as $e) {
	    echo "$e <br>";
	    }
	  echo "</div>";	
	   }
	  ?>
<div style="width:100%; margin-top:5px;"></div>      	
<form action="" method="post"  name="placeOrderForm" id="placeOrderForm" >
<?php include ROOT_DIR_C.  'orders/order-pane.php'; ?>
<?php include ROOT_DIR_C.  'orders/order-foot.php'; ?>
</form>
</div>
<div class="clearfix"></div>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>