<?php 
include '../client_db_connect.php';
  include('func.php');
page_protect();
$err = array();
//$paydate = date('Y-m-d H:i:s');
if(!checkAdmin()) {
header("Location: ../index.php");
exit();
}
$page_limit = 5; 
if (isset($_GET['wid']))  {
  $w_id=$_GET['wid'];
}
if (isset($_GET['id']))  {
  $w_id_w=$_GET['id'];
}
if (isset($_GET['amt']))  {
  $order_amt=$_GET['amt'];
}
if (isset($_GET['pay']))  {
  $pay_amt=$_GET['pay'];
}

if (isset($_GET['amtpaid']))  {
  $amtpaid=$_GET['amtpaid'];
}
if (isset($_GET['order']))  {
  $ordernopaid=$_GET['order'];
}
if (isset($_GET['themsg']))  {
  $successmsg=$_GET['themsg'];
}
//select writers query
    $select_writer = "select * from mu_members";
	 $rs_select_writer = mysql_query($select_writer) or die(mysql_error());
	 $rows_writer_select = mysql_fetch_array($rs_select_writer);
//
//select done orders by this writer query
    // $select_done_orders = "select order_no from mu_members where Status = 'Fd' AND order_no='$_REQUEST[txtid_no]'";
	// $rs_select_done_orders = mysql_query($select_done_orders) or die(mysql_error());
	// $rows_done_orders = mysql_fetch_array($rs_select_done_orders);
//
     $the_writer = "select id,firstname, lastname from mu_members WHERE id ='$w_id'"; // writers names
	 $rs_the_writer = mysql_query($the_writer) or die(mysql_error());
	 $rows_writer_id = mysql_fetch_array($rs_the_writer);
//
	  $sql_payments = "select * from payments WHERE writer_id ='$w_id' order by pay_date Desc";
	  $rs_sql_payments = mysql_query($sql_payments) or die(mysql_error());
	  $total_payments = mysql_num_rows($rs_sql_payments);
	  
	  if (!isset($_GET['page']) )
		{ $start=0; } else
		{ $start = ($_GET['page'] - 1) * $page_limit; }
	  
	  $rs_results_payments = mysql_query($sql_payments . " limit $start,$page_limit") or die(mysql_error());
	  $total_pages_payments = ceil($total_payments/$page_limit);
  
if ($_POST['doPayNow']=='Pay Now')
{
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}
//$sql = array(); 
if(empty($err)){	
foreach($_POST ['writersid'] as $row=>$theID)
{
  $writers_id=mysql_real_escape_string($theID);
  $the_order_no=mysql_real_escape_string($_POST['orderno'][$row]);
  $pay_amnt=mysql_real_escape_string($_POST['pay_amnt'][$row]);
  
$sql_insert ='INSERT INTO `payments` (`writer_id`,`order_no`,`pay_amnt`, `pay_date`) VALUES ('.$writers_id.','.$the_order_no.','.$pay_amnt.', now())';	
mysql_query($sql_insert,$connect) or die("Insertion Failed:" . mysql_error());
//update
mysql_query("Update`orders` set `status`='Paid', `paid`='$pay_amnt' where order_no = '$the_order_no' and assigned_to='$writers_id'") or die(mysql_error());

header("Location: payments-for-writer.php?wid=$writers_id");
//exit();
}
} 
}
?>
<html>
<head>
<title>Payments</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../order_styles/styles.css" rel="stylesheet" type="text/css">
<link href="../styles.css" rel="stylesheet" type="text/css" media="screen" />
<script language="JavaScript" src="../j_s/jquery-1.3.2.min.js"></script>
<script language="JavaScript" src="../j_s/jquery.validate.js"></script>
  <script>
  $(document).ready(function(){
    $("#Payments").validate();
  });
  </script>
  <script type="text/javascript">
$(document).ready(function() {
	$('#wait_1').hide();
	$('#drop_1').change(function(){
	  $('#wait_1').show();
	  $('#result_1').hide();
      $.get("func.php", {
		func: "drop_1",
		drop_var: $('#drop_1').val()
      }, function(response){
        $('#result_1').fadeOut();
        setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
      });
    	return false;
	});
});
function finishAjax(id, response) {
  $('#wait_1').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
}
</script>
</head>
<body>
<?php include '../header.php' ; ?>
<div id="main-content">
<table width="100%" border="0" cellspacing="5" cellpadding="3">
  <tr>
   <td valign="top">
<?php include 'access-links.php' ;  ?>
	</td>
    <td width="89%" valign="top" style="padding: 10px;">
<table width="100%" border="0">
  <tr valign="top">
    <td width="75%"><div  style=" float:left;"><h3 class="titlehdr">Select writer for payment:</h3> </div></td>
    <td width="25%"><div style="float:right;"><?php include 'gmttime.php'; ?></div></td>
   </tr>
</table>
<table width="98%" border="0" align="center" cellpadding="5" cellspacing="5">
<tr>
   <td width="70%">
  <form action="payments.php" method="post" name="Payments" id="Payments">
  <table width="100%" border="0" align="center">
  <tr>
    <td colspan="6"> <strong>Select writer for payment: </strong>
      <select name="drop_1[]" id="drop_1" class="required"><div> 
        <option value="" selected=""></option>
        <?php getTierOne(); ?>
      </select> 
      </br>
      </br>
        <span id="wait_1" style="display: none;">
            <img src="../images/ajax-loader.gif" alt="Please Wait" width="100" height="10"/>    </span>
        <span id="result_1" style="display: none;"></span>
		</td>
    </tr>
<tr> <td colspan="6" style="padding-top:20px;"></td></tr>	
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="8%">&nbsp; </td>
    <td width="8%">&nbsp;</td>
    <td width="18%"><div align="center"><strong>Total to pay: </strong></div></td>
    <td> <span style="color: #fef4e9;
	border: solid 1px #da7c0c;font: 18px Arial, Helvetica, sans-serif;
	padding: .5em 2em .55em;
	background: #f78d1d; text-align:center; font-weight:bold;text-shadow: 0 1px 1px rgba(0,0,0,.3);
	-webkit-border-radius: .5em; 
	-moz-border-radius: .5em;
	border-radius: .5em;
	background: -webkit-gradient(linear, left top, left bottom, from(#faa51a), to(#f47a20));
	background: -moz-linear-gradient(top,  #faa51a,  #f47a20);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#faa51a', endColorstr='#f47a20');"
 id="sum">0.00</span> (Hit 'Tab' key)</td>
    <td width="23%"><div align="right">
      <input name="doPayNow" id="doPayNow" value="Pay Now" class="input_submit" type="submit">
    </div></td>
  </tr>
</table> 
  </form> 
	</td>
    </tr> 
</table>
<script>
			$(document).ready(function(){
			$("input").click(function(event) {
			calculateSum();
			});
					$(this).keyup(function(){
						calculateSum();
					});
			});
			function calculateSum() {
				var sum = 0;
				$(":text").each(function() {
					if(!isNaN(this.value) && this.value.length!=0) {
						sum += parseFloat(this.value);
					}
				});
			$("input:checked").each(function() {
			sum += parseFloat(this.value);
			});	
				$("#sum").html(sum.toFixed(2));
			}
		</script>
<p>
<?php 
	  if(!empty($successmsg)) {
	  echo $successmsg .' to <font color="#369"><strong>'. ucfirst($rows_writer_id['firstname'] ). '&nbsp;' . ucfirst ($rows_writer_id['lastname']).'</strong>' ;
	  }
	  ?>
	  </p>
<br>
		<h2>Payments for <font color="#FF0000"><strong> <?php echo ucfirst($rows_writer_id['firstname'] ). '&nbsp;' . ucfirst ($rows_writer_id['lastname']);?></strong> </font></h2> Writers ID : <strong><?php echo $rows_writer_id['id'];?></strong> <span style="float:right;"> <a href="all_payments.php"> <strong>Go to </strong></a>all writers payments</span>
             <table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">
          <tr bgcolor="#E6F3F9"> 
			<td nowrap> <div align="center"><strong>Ref No</strong></div></td>
            <td> <div align="center"><strong>Writers Id </strong></div></td>
            <td><div align="center"><strong>Amount paid </strong></div></td>
            <td width="13%"><div align="center"><strong>Payment date </strong></div></td>
            <td width="14%"><div align="center"><strong>Order No.</strong></div></td>
          </tr>
          <tr> 
            <td width="12%" nowrap><div align="center"></div></td>
            <td width="18%"><div align="center"></div></td>
            <td width="18%"><div align="center"></div></td>
            <td nowrap><div align="center"></div></td>
            <td>&nbsp;</td>
          </tr>
 <?php    if ($total_payments  ==0) {?>		  
		 <tr> <td colspan="9" nowrap>
 		 <div align="center">
		  <?php  echo 'There are no payments yet';  ?>
		  </div>
		  </td>
		  </tr>
<?php } ?>		  
          <?php while ($rrows = mysql_fetch_array($rs_results_payments)) {?>
          <tr > 
<td nowrap class="order_borders" ><div align="center"> <span style="text-transform:uppercase"> <?php echo $rrows['reference_no']; ?></span> </div></td>
            <td class="order_borders"><div align="center"><?php echo $rrows['writer_id']; ?></div></td>
            <td class="order_borders"><div align="center">		<?php echo $rrows['pay_amnt']; ?>	</div></td>
            <td nowrap class="order_borders"> <div align="center"><?php echo $rrows['pay_date'];?></div></td>
            <td nowrap class="order_borders"><div align="center"><?php echo $rrows['order_no'];?></div></td>
          </tr>
          <?php    }  ?>
        </table>
<?  //echo $total_pages;?>
      <p align="right"> 
        <?php 
	  // outputting the pages
		if ($total_payments > $page_limit)
		{
		echo "<div><strong>Pages:</strong> ";
		$i = 0;
		while ($i < $page_limit)
		{
		$page_no = $i+1;
		$qstr = ereg_replace("&page=[0-1]+","",$_SERVER['QUERY_STRING']);
		echo "<a href=\"payments.php?$qstr&page=$page_no\">$page_no</a> ";
		$i++;
		}
		echo "</div>";
		}  ?>
	  </p>		
    </td>
  </tr>
</table>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>
