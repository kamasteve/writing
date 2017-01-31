<?php 
include '../client_db_connect.php';
page_protect();
$err = array();
$msg = array();
if(!checkAdmin()) {
header("Location: index.php");
exit();
}
//mark as complete 
if($_POST['markAsCompleted'] == 'Mark As Completed'){
if(empty($_POST['u'])) {
$msg[] = "Nothing has been selected ";
}

if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$comp_id = filter($uid);
mysql_query("Update `orders` set `status`='Fd' where `order_no`= '$comp_id'") or die(mysql_error());
list($notify_assigned_approved) = mysql_fetch_row(mysql_query("select assigned_to from `orders` where `order_no`= '$apv_id'"));	
$rs_email = mysql_query("select email, firstname, username from mu_members where  id='$notify_assigned_approved'") or die(mysql_error());
$to_w_rows = mysql_fetch_array($rs_email);
$to_email =$to_w_rows['email'];
$to_w_fname =ucfirst($to_w_rows['firstname']);	

$host  = $_SERVER['HTTP_HOST'];
$message = 
"
Dear ".to_w_fname.",\n
An order has been marked as complete. \n
It is now under your completd list.\n

Regards,\n
The Support Department \n
".SITE_HOST_NAME." \n
Email: ".$site_email."
______________________________________________________

";/*
	@mail($to_email, "Order marked as completed", $message,
    "From: \"Order Approval - ".SITE_NAME."\" <$site_email>\r\n" .
     "X-Mailer: PHP/" . phpversion());
	 */
    } 
  
  }
$msg[] = "Order(s) marked as completed successfully ";

}
?>
<html>
<head>
<title>Orders being Edited</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../order_styles/styles.css" rel="stylesheet" type="text/css">
<link href="../css/tables.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="javascript" src="../j_s/jquery-1.9.1.js"></script>
<script type="text/javascript" language="javascript" src="../j_s/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#thetable').dataTable( {
		"sPaginationType": "full_numbers"
		} );
	$(function () {
    $('.checkall').on('click', function () {
        $(this).closest('form').find(':checkbox').prop('checked', this.checked);
    });
    });	
 } );
</script>
</head>
<body>
<?php include '../header.php' ; ?>
<div id="main-content">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td valign="top">
<?php include 'access-links.php' ;  ?>
	</td>
    <td width="89%" valign="top" style="padding: 10px;">
<table width="100%" border="0">
  <tr valign="top">    
    <td width="40%"><div style="float:left;" class="titlehdr"><strong>Submitted for Editing</strong> </div></td>
    <td><div style="float:right;"><?php include 'gmttime.php'; ?></div></td>
 </tr>
</table>
      <?php 
	  $sql_editing = "select * from orders WHERE status ='Edt' ORDER BY order_no DESC";
	  $rs_total_editing = mysql_query($sql_editing) or die(mysql_error());
	  $total_editing = mysql_num_rows($rs_total_editing);
	  $rs_results_editing = mysql_query($sql_editing) or die(mysql_error());
        ?>
<div style="width:600px; margin:0 auto;"><?php	
	  if(!empty($msg))  {
	    echo "<div align=\"center\" class=\"ord_msg\">" . $msg[0] . "</div>";
	   }
	  ?>
	  </div><br> 		
  <form name="completeForm" action="all_editing.php" method="post">
       <table  cellpadding="0" cellspacing="0" border="0" class="display" id="thetable">
		<thead>
          <tr>
            <th width="10%">ID</th> 
			<th width="10%"> <div align="center"><strong>Order No</strong></div></th>
            <th width="10%"><div align="center"><strong>Client </strong></div></th>
            <th width="23%"> <div align="center"><strong>Title</strong></div></th>
            <th width="13%"><div align="center">Assigned to </div></th>
            <th width="12%" ><div align="center"><strong>Subject Area</strong></div></th>
            <th width="14%" ><div align="center"><strong>Academic Level</strong></div></th>
            <th width="9%"><div align="center"><strong>track id </strong></div></th>
            <th width="10%" ><div align="center"><strong>Pages</strong></div></th>
            <th width="9%" > <div align="center"><strong>Cost (<?php  echo $curr_symbol ?>)</strong></div></th>
          </tr>
		 </thead> 
		 <tbody>
 <!--<?php    if ($total_editing  ==0) {?>		  
		 <tr>
		    <td colspan="9"> <div align="center"> <?php  echo 'There are no completed orders';  ?> </div> </td>
		 </tr>
<?php } ?>	-->	
          <?php while ($rrows = mysql_fetch_array($rs_results_editing)) {?>
		  <?php
	  $asgnd_id = $rrows['assigned_to'];
	  $usnames = "select  firstname, lastname from mu_members WHERE id ='$asgnd_id'";
	  $rs_usnames= mysql_query($usnames) or die(mysql_error());
	  $rows_usnames = mysql_fetch_array($rs_usnames);
			?>
          <tr>
<td class="order_borders"><input name="u[]" type="checkbox" value="<?php echo $rrows['order_no']; ?>" id="u[]"></td>
<td class="order_borders" ><div align="center"> <a href="order-page.php?id=<?php echo $rrows['order_no'];?>&cid=<?php echo $rrows['client_id']; ?>&sts=<?php echo $rrows['status']; ?>&writer_ids=<?php echo $asgnd_id ;?>"><?php echo $rrows['order_no']; ?> </a></div></td>
            <td class="order_borders" >
			<div align="center">
			<?php 
			$clientID=$rrows['client_id']; 
			$clientIS = mysql_query("select * from mu_members where id='$clientID'") or die(mysql_error());
			$row_clientNames = mysql_fetch_array($clientIS);
			echo ucfirst(strtolower($row_clientNames['username'])); 
			   ?>		</div
			></td>
            <td class="order_borders"><div align="center"><a href="order-page.php?id=<?php echo $rrows['order_no'];?>&cid=<?php echo $rrows['client_id']; ?>&sts=<?php echo $rrows['status']; ?>&writer_ids=<?php echo $asgnd_id ;?>"><?php echo $rrows['topic']; ?></a></div></td>
            <td class="order_borders"><div align="center">
			<?php echo ucfirst($rows_usnames['firstname'] ). '<br>' . ucfirst ($rows_usnames['lastname']);?><br>
			<a href="submitted-for-editing-for-individual-writer.php?fn_id=<?php echo $asgnd_id ;?>&sts=<?php echo $rrows['status']; ?>"> (&raquo;)</a>
			</div></td>
            <td class="order_borders"> <div align="center"><?php echo $rrows['subject_area'];?></div></td>
            <td class="order_borders"><div align="center"><?php echo $rrows['academic_level']; ?></div></td>
            <td class="order_borders"><div align="center">
<?php 
$time1 = $urgency = $rrows['urgency'];
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
$remaining = $days.":d, ".$hours.":h, ".$minutes.":m ";	

//echo $remaining;
echo $rrows['track_order_id'];
 ?>
</div></td>
            <td class="order_borders"> <div align="center">
              <?php echo $rrows['numpages']; ?>
            </div></td>
            <td class="order_borders"><div align="center">
              <?php echo number_format($rrows['rowtotals']) ; ?></div></td>
          </tr>
	          <?php  } ?>
	  </tbody>
        </table> 
		<div style="float:left; clear:both;  margin:10px 0;"><input type="checkbox" class="checkall"> <strong>Check all</strong></div>
		    <?php 
	  $orders_done_costs = "select  sum( rowtotals ) AS totalcosts  from orders  WHERE status ='Edt' ORDER BY order_no DESC";
	  $rs_total_cost_fd= mysql_query($orders_done_costs) or die(mysql_error());
	  $rows_costs = mysql_fetch_array($rs_total_cost_fd);
	  $the_sum = $rows_costs ['totalcosts'];
	  $total_price_ += $the_sum ;?>
		    <div style="float:right; margin-top:18px;">Total: <span class="price_f">
			 <?php echo  $curr_symbol.'&nbsp;'. number_format($total_price_ ) ; ?></span></div>
			 <p align="center"><br><br>
          <input name="markAsCompleted" type="submit" class="input_submit" id="markAsCompleted" value="Mark As Completed">
          <input name="query_str" type="hidden" id="query_str" value="<?php echo $_SERVER['QUERY_STRING']; ?>">
	    </p>
		<div>
	 </form>
			</td>
	    </td>
  </tr>
</table>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>
