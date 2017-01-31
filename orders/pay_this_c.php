<?php 
include '../client_db_connect.php';
page_protect();
if(!checkClient()) {
header("Location: ../index.php");
exit();
}
$msg = array();
$from = 'USD';
$to = 'KES';
$url = 'http://finance.yahoo.com/d/quotes.csv?f=l1d1t1&s='.$from.$to.'=X';
$handle = fopen($url, 'r');
if ($handle) {
    $result = fgetcsv($handle);
    fclose($handle);
}
$converted_curr = $result[0];
if (isset($_GET['d'])){
$d =$_GET['d'];
}
if (isset($_GET['o'])){
$o =base64_decode($_GET['o']);
}
if ($d==$o){
$ordertopay = $d;
}
$this_order= $_POST['this_order'];

if($_POST['doManage'] == 'Manage Orders') 
{ 
header("Location: c_manage_orders.php?doSearch=View"); 
}
if($_POST['doAddNew'] == 'Add New') 
{ 
header("Location: new.php");
}
 ?>
<html>
<head>
<title>Order Created - Payment</title>
<link href="../styles.css" rel="stylesheet" type="text/css">
<link href="../css/popbox.css" rel="stylesheet" type="text/css">
<link href="../order_styles/styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript"  src="../j_s/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
jQuery(function () {
    $(".get_payments").hide();
    $(".show_hide_payments").show();
	
	$('.show_hide_payments').click(function(){
    $(".get_payments").slideToggle();
    });
});
</script>
</head>
<body>
<?php include '../header.php'; ?>
<div id="main-content">
<table width="100%"  align="center" cellspacing="0">
   <tr> 
    <td valign="top" width="20%" >
	<?php  include 'access-links.php';?>
   </td>
 <td width="80%" valign="top" style="padding:10px;">
   <div><h3>Hi, <?php echo ucfirst(strtolower($_SESSION['username'])); ?></h3> 
   <h2>Here is the order pending payment</strong></h2>
   <?php
	  $sql_me = "select * from mu_members where id ='$_SESSION[id]' ";
	  $rs_results_me = mysql_query($sql_me) or die(mysql_error()); 
	  $ma_details = mysql_fetch_array($rs_results_me);	  
   
	  $sql = "select * from orders where  order_no ='$ordertopay' ";
	  $rs_results = mysql_query($sql) or die(mysql_error());  	  
	  $rrow = mysql_fetch_array($rs_results);
	  
	  /*if($rrow['curr']=="USD"){
	  }
	  else if($rrow['curr']=="GBP"){
	  }
	  else if($rrow['curr']=="CAD"){
	  }
	  else if($rrow['curr']=="AUD"){
	  }
	  else if($rrow['curr']=="EUR"){
	  }*/
   ?>
	  </div>
        <table width="100%" align="center" cellpadding="3" class="ordered">
	  <?php //while ($rrow = mysql_fetch_array($rs_results)) {?> 
<form name="manageorders" method="post" action="">	  
  <tr>
  <td><div align="left"><span class="unnamed8"><strong>Order #</strong>&nbsp;</span></div></td>
    <td>
	<div  style="width:120px; float:left;"><h2> <?php  echo $ordertopay ; ?></h2></div>
	<div style="width:auto; float:">
	 <input type="submit" name= "doManage"  id="doManage" class="submit_bt" value="Manage Orders" >
	 <input type="submit" name= "doAddNew"  id="doAddNew" class="submit_bt" value="Add New" >
    </div>
	</td>
  </tr>
  <tr>
    <td><span class="unnamed8"><strong>Title</strong></span></td>
    <td><div align="left"><?php echo $rrow['topic']; ?></div></td>
  </tr>
    <tr>
    <td><strong>Due date </strong></td>
    <td>
      <div align="left">
<?php  
dateDiff($time1, $time2);	
$time1 = $rrow['urgency'];
$time2 = time();
$difference = $time1 - $time2;
$diffSeconds = $difference;
$days = intval($difference / 86400);
$difference = $difference % 86400;
$hours = intval($difference / 3600);
$difference = $difference % 3600;
$minutes = intval($difference / 60);
$difference = $difference % 60;
$seconds = intval($difference);
$remaining = $days.":days, ".$hours.":hours, ".$minutes.":min ";	
$timestamp =$time1;
$end_date = date("Y-m-d h:m:s A",$timestamp);
echo $end_date.' <strong> ....  due in : </strong>( &nbsp;';
echo $remaining . ')';  		  
 ?> 
      </div></td>
  </tr>
  <tr>
    <td><strong>Spacing</strong></td>
    <td><div align="left">
      <?php  echo $rrow['o_interval']; ?>
      <strong>Pages:</strong> 
    <?php  echo $rrow['numpages']; ?> &nbsp;&nbsp;
    #<strong> Sources:</strong> 
    <?php  echo $rrow['numberOfSources']; ?>&nbsp;&nbsp; 
    <strong>Citation:</strong> 
    <?php  echo $rrow['style']; ?>&nbsp;&nbsp;
	<strong>Academic level:</strong> 
    <?php  echo $rrow['academic_level']; ?>
    </div>
        </td>
  </tr>
   <tr><td><strong>Paper Type:</strong> </td>
  <td><?php  echo $rrow['doctype']; ?></td>
  </tr>
  <tr><td><strong>Subject Area:</strong> </td>
  <td><?php  echo $rrow['subject_area']; ?></td>
  </tr>
  <tr>
    <td><strong>Order Cost </strong></td>
    <td><div align="left">
	<?php 
	 echo  $usd_amnt_c = number_format($rrow['client_cost'], 2);
	 ?>&nbsp; ( <?php  echo $rrow['curr'] ?>)  </div></td>
  </tr>
  <tr>
    <td><strong>Tracking order ID </strong></td>
    <td><div align="left"><?php echo $rrow['track_order_id']; ?>  </div></td>
  </tr>
  <tr>
    <td valign="top"><strong>Order Details</strong></td>
    <td><div align="justify" style="width:600px; height:100px; overflow:scroll; border:1px dotted #333; padding:8px;">  <?php echo nl2br($rrow['order_details']);?></div></td> 
<input name="query_str" type="hidden" id="query_str" value="<?php echo $_SERVER['QUERY_STRING']; ?>">
  </tr>
</form>
  <tr>
  <tr>
  <td></td>
  <td valign="top">
<?php //} ?>
<div class=""> 
<div class=""> 
<div style="font-size:18px; color:#039;"> Continue to payment..  </div>
<br><br>
Hit the  image to checkout<br><br>
 <form id="paypal_form" class="paypal" action="paypal-payments.php" method="post">
    <input name="cmd" type="hidden" value="_xclick" />
    <input name="no_note" type="hidden" value="1" />
    <input name="lc" type="hidden" value="US" />
    <input name="currency_code" type="hidden" value="<?php  echo $rrow['curr'] ?>" />
    <input name="bn" type="hidden" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
    <input name="first_name" type="hidden" value="<?php echo $ma_details['firstname']; ?>" />
    <input name="last_name" type="hidden" value="<?php echo $ma_details['lastname']; ?>" />
    <input name="payer_email" type="hidden" value="<?php echo $ma_details['email']; ?>" />
    <input name="item_number" type="hidden" value="<?php echo $rrow['order_no']; ?>" />
	<input type="hidden" name="item_name" value="<?php echo 'Order titled: '. $rrow['topic']; ?>">
    <input type="hidden" name="item_amount" value="<?php echo $usd_amnt_c; ?>">
   <input type="image" name="submit" border="0"  src="../images/paypal-pay-now.png" alt="PayPal - The safer, easier way to pay online">
</form>
</div>
</div>
</td></tr>
</table>
    </td>
    </tr>
</table>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>
