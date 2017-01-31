<?php 
include '../client_db_connect.php';
page_protect();
$err = array();
$msg = array();
if(!checkAdmin()) {
header("Location: ../index.php");
exit();
}
$page_limit = 10; 
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);

// filter GET values
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

foreach($_POST as $key => $value) {
	$post[$key] = filter($value);
}

//remove
if($_POST['doRemove'] == 'Remove') {
if(empty($_POST['u'])) {
$msg[] = "Nothing has been selected ";
}
if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
		mysql_query("update orders set `removed_order` =1,`paid` ='0',`order_status` ='0',`applied` ='0',`status` ='Rmv',`assigned_to` ='0',`confirm` ='0',`request_re_assign` ='0' where order_no='$id'");
	}
 }
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];
 
  $msg[] = "Order(s) removed successfully ";
}

// delete
if($_POST['doDelete'] == 'Delete') {
if(empty($_POST['u'])) {
$msg[] = "Nothing has been selected ";
}
if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
		mysql_query("delete from orders where order_no='$id'");
	}
 }
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];
 
  $msg[] = "Order(s) deleted successfully ";
}

// Un-approve
if($_POST['UnApprove'] == 'Un Approve') {
if(empty($_POST['u'])) {
$msg[] = "Nothing has been selected ";
}
if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
		mysql_query("update orders set `status`='', order_status='0' where order_no='$id'");	 
	}
 }
  $msg[] = "Order(s) up-approved successfully ";
}

//mark as available 
if($_POST['doApprove'] == 'Make Available') {
if(empty($_POST['u'])) {
$msg[] = "Nothing has been selected ";
}
if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
		mysql_query("update orders set status='Av', order_status='1', confirm='0', assigned_to='0', applied='0',`ext_rqst` ='0' where order_no='$id'");
		mysql_query("delete from bids where bid_order_no='$id'");
	}
 }
 $msg[] = "Order(s) marked as available successfully ";
}

//mark as done 
if($_POST['markAsCompleted'] == 'Mark As Done'){
if(empty($_POST['u'])) {
$msg[] = "Nothing has been selected ";
}
if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$comp_id = filter($uid);
mysql_query("Update `orders` set `status`='Fd' where `order_no`= '$comp_id'") or die(mysql_error());
list($notify_assigned_approved) = mysql_fetch_row(mysql_query("select assigned_to from `orders` where `order_no`= '$apv_id'"));	
    } 
  }
$msg[] = "Order(s) marked as completed successfully ";
}
//return to editing
if($_POST['doReturnToEditing'] == 'Return To Editing'){
if(empty($_POST['u'])) {
$msg[] = "Nothing has been selected ";
}
if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$comp_id = filter($uid);
mysql_query("Update `orders` set `status`='Edt' where `order_no`= '$comp_id'") or die(mysql_error());
list($notify_assigned_approved) = mysql_fetch_row(mysql_query("select assigned_to from `orders` where `order_no`= '$apv_id'"));	
    } 
  }
$msg[] = "Order(s) returned to editing successfully ";
}
//disapprove
if($_POST['Disapprove'] == 'Disapprove') {
if(empty($_POST['u'])) {
$msg[] = "Nothing has been selected ";
}
if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
		mysql_query("update orders set status='0', approve ='0', order_status='0' where order_no='$id'");	 
	}
 }
  $msg[] = "Order(s)  dis-approved successfully ";

}
////mannage orders
$rs_all_orders = mysql_query("select count(*) as total_all from orders ORDER BY order_no DESC") or die(mysql_error());
$rs_available_orders = mysql_query("select count(*) as total_active from orders where status ='Av' ORDER BY order_no DESC") or die(mysql_error());
$rs_total_pending = mysql_query("select count(*) as total_pending from orders where order_status='0' and status = '' ORDER BY order_no DESC");	
$rs_total_removed = mysql_query("select count(*) as total_removed from orders where status = 'Rmv' ORDER BY order_no DESC");	
list($rs_all_orders) = mysql_fetch_row($rs_all_orders);
list($rs_available_orders) = mysql_fetch_row($rs_available_orders);
list($rs_total_pending) = mysql_fetch_row($rs_total_pending);
list($rs_total_removed) = mysql_fetch_row($rs_total_removed);
?>
<html>
<head>
<title>Manage Orders</title>
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
<?php include 'access-links.php' ;  ?>  
	</td>
    <td  valign="top" style="padding:5px;">
	 <div style="width:600px; margin:0 auto;"><?php	
	  if(!empty($msg))  {
	    echo "<div align=\"center\" class=\"ord_msg\">" . $msg[0] . "</div>";
	   }
	  ?>
	  </div>
	<table width="95%" border="0" align="center">
        <tr valign="top">
		  <td><strong><div class="titlehdr">Manage Orders  </div></strong></td>
          <td> Total :<span class="thetotals"> <strong><?php echo $rs_all_orders;?></strong></span></td>
          <td>Available :<span class="thetotals">  <?php echo $rs_available_orders; ?></span></td>
          <td>Pending :<span class="thetotals"> <strong><?php echo $rs_total_pending; ?></strong></span></td>
		  <td>Removed :<span class="thetotals"> <?php echo $rs_total_removed; ?></span></td>
        </tr>
      </table>
	  <table width="98%" border="0" align="center"  style="background-color: #E4F8FA;border: 1px solid #CAE4FF;" >
        <tr valign="top">
          <td><form name="form1" method="get" action="manage_orders.php">
            <p align="center">
			    <input type="radio" name="qoption" value="all">
                <strong>All orders: </strong>
                <input type="radio" name="qoption" value="available">
                <strong> Available:</strong> 
				<input type="radio" name="qoption" value="pending">
                <strong> Pending: </strong> 
			    <input type="radio" name="qoption" value="removed">
                <strong> Removed: </strong> 
                &nbsp;&nbsp;<input name="doSearch" type="submit" class="input_submit" id="doSearch2" value="View">
              </p>
			  </form></td>
        </tr>
      </table>
	  <p>
      <?php if ($get['doSearch'] == 'View') {
	  $cond = "ORDER BY order_no DESC";
	  $status='All orders';
	  if($get['qoption'] == 'removed') {
	  $cond = "where status ='Rmv' and removed_order = '1' ORDER BY `date` DESC";
	  $status='Removed orders';
	  }
	  if($get['qoption'] == 'pending') {
	  $cond = "where order_status='0' and status = '' ORDER BY `date` DESC";
	  $status='Pending orders';
	  }
	  if($get['qoption'] == 'available') {
	  $cond = "where status ='Av' ORDER BY `date` DESC";
	  $status='Available orders';
	  }
	  if($get['qoption'] == 'all') {
	  $cond = "ORDER BY `date` DESC";
	  $status='All orders';
	  }
	   
	  if($get['q'] == '') { 
      $sql = "select * from orders $cond"; 	  
	  } 
	  else { 
	  $sql = "select * from orders where  `order_no`='$_REQUEST[q]' and removed_order ='0'";
	  }
	  
	  $rs_total_ordrs = mysql_query($sql) or die(mysql_error());
	  $total_ordrs = mysql_num_rows($rs_total_ordrs);
	  $rs_results_ordrs = mysql_query($sql) or die(mysql_error());
	  ?>
<p> <strong>Status:</strong> &nbsp;<span class="style2"><?php echo  $status;?></span></p>
<form method="post"  action="manage_orders.php?doSearch=View" name="searchform">
        <table  cellpadding="0" cellspacing="0" border="0" class="display" id="thetable">
		<thead>
		<tr> 
            <th><div align="left"><strong>ID</strong></div></th>
			<th><div align="left"><strong>Order No</strong></div></th>
            <th><div align="left">Client</div></th>
            <th><div align="left"><strong>Created</strong></div></th>
            <th><div align="left"><strong>Track</strong></div></th>
            <th><div align="left"></div></th>
            <th><div align="left"><strong>Due</strong></div></th>
            <th><div align="left"><strong>Status</strong></div></th>
			<th> <div align="left">Pages</div></th>
			<th> <div align="left"><strong>Cost(<?php  echo $curr_symbol ?>)</strong></div></th>
            <th><div align="left"><strong>Client Price</strong>(<?php  echo $curr_symbol ?>)</div></th>
            <th><div align="center"><strong>Assigned?</strong></div></th>
            <td>&nbsp;</td>
		</tr>
		  </thead>
		  <tbody>
         <?php while ($rows_orders = mysql_fetch_array($rs_results_ordrs)) {?>
		 <?php
	  $asgnd_id = $rows_orders['assigned_to'];
	  $usnames = "select  firstname, lastname from mu_members WHERE id ='$asgnd_id'";
	  $rs_usnames= mysql_query($usnames) or die(mysql_error());
	  $rows_usnames = mysql_fetch_array($rs_usnames);
			?>
          <tr> 
            <td class="manage_borders"><input name="u[]" type="checkbox" value="<?php echo $rows_orders['order_no']; ?>" id="u[]"></td>
<td class="manage_borders" ><div align="center"> <a href="order-page.php?id=<?php echo $rows_orders['order_no'];?>&cid=<?php echo $rows_orders['client_id']; ?>&sts=<?php echo $rows_orders['status']; ?>&writer_ids=<?php echo $asgnd_id ;?>"><?php echo $rows_orders['order_no']; ?> </a></div></td>
            <td class="manage_borders"><div align="center">
			<?php 
			$clientID=$rows_orders['client_id']; 
			$clientIS = mysql_query("select * from mu_members where id='$clientID'") or die(mysql_error());
			$row_clientNames = mysql_fetch_array($clientIS);
			echo ucfirst(strtolower($row_clientNames['username'])); 
			   ?>		</div>	</td>
            <td class="manage_borders"><div align="center"><?php echo $rows_orders['date']; ?></div></td>
            <td class="manage_borders">
			 <div align="center">
			 <?php 
			echo $rows_orders['track_order_id']; 
			   ?>
			</div></td>
            <td class="manage_borders">
			<?php
			 if($rows_orders['from_site']== $domain_name ){ ?>
			<span class="icon_fav_admin"></span>
			<?php } else{ ?>
			<span class="icon_fav_client"></span>
			<?php } ?>
			</td>
            <td class="manage_borders"><div align="center"><?php 
			$time1 = $urgency = $rows_orders['urgency'];
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
			echo $remaining;
			
			 ?></div>			 </td>
            
            <td class="manage_borders"> <div align="center">
			<?php 
			//$rows_orders['client_id']
			$the_status=$rows_orders['status'];
			if($the_status=='')
			 {
			 $o_status='Pending';
			 }
			if($the_status=='Av')
			 {
			 $o_status='Available';
			 }
			 if($the_status=='Paid')
			 {
			 $o_status='Paid';
			 }
			 if($the_status=='Cf')
			 {
			 $o_status='Confirmed';
			 }
			 if($the_status=='Rv')
			 {
			 $o_status='Revision';
			 }
			 if($the_status=='Fd')
			 {
			 $o_status='Completed';
			 }
			 if($the_status=='Edt')
			 {
			 $o_status='Editing';
			 }
			 if($the_status=='Apv')
			 {
			 $o_status='Approved';
			 }
			 if($the_status=='Rj')
			 {
			 $o_status='Rejected';
			 }
			  if($the_status=='Ds')
			 {
			 $o_status='Dispute';
			 }
			 if($the_status=='Rmv')
			 {
			 $o_status='Removed';
			 }
			 if($the_status=='UnAp')
			 {
			 $o_status='Un-Approved';
			 }
			 if($the_status=='Cr')
			 {
			 $o_status='Assigned but Unconfirmed';
			 }
			 echo $o_status;
			?>
			</div></td>
  <td class="manage_borders"><div align="center"><?php echo $rows_orders['numpages']; ?>  </div></td>			
  <td class="manage_borders"><div align="center"><?php echo number_format($rows_orders['rowtotals'],2); ?>  </div></td>
          
          <td class="manage_borders"><div align="center"><?php echo number_format($rows_orders['client_cost'],2); ?></div></td>
          <td class="manage_borders">
		  <div align="center">
		  <?php
if ($rows_orders['assigned_to'] <> 0){			   
$rs_assigned_sql = "select firstname, lastname, username, id from mu_members where id='$rows_orders[assigned_to]'";
$q_assigned_to = mysql_query($rs_assigned_sql) or die(mysql_error());
$row_assigned_to= mysql_fetch_array($q_assigned_to);
$assigned_to = ucfirst($row_assigned_to['firstname']). '<br>'. ucfirst($row_assigned_to['lastname']);		
$uname = $row_assigned_to['username'];
echo $assigned_to . '<br> (<font size="1" style="font-weight:800">'. $uname. '</font>)' ; 
}else{
echo '<font size="1" > Not Yet </font>'; }			?>
		  </div></td>
          <td class="manage_borders"><div>		  </div></td>
          </tr>
<?php } ?>
</tbody>
        </table>
		<?php 
	  $orders_costs = "select  sum( rowtotals ) AS order_costs  from orders  WHERE status <>''";
	  $rs_total_cost_orders= mysql_query($orders_costs) or die(mysql_error());
	  $orders_rows_costs = mysql_fetch_array($rs_total_cost_orders);
	  $the_sum_orders = $orders_rows_costs ['order_costs'];
	  $total_price_orders+= $the_sum_orders ;
	   //clients costs
	  $client_costs = "select  sum( client_cost ) AS client_costs  from orders  WHERE status <>''";
	  $rs_total_cost_client= mysql_query($client_costs) or die(mysql_error());
	  $clients_rows_costs = mysql_fetch_array($rs_total_cost_client);
	  $the_sum_clients = $clients_rows_costs ['client_costs'];
	  $total_price_clients+= $the_sum_clients ;
	  
	  
	  ?>
	  <br><br>
	  <div style="float:right;  margin-top:18px;">Totals : <u>Orders Costs...</u><span class="price_f"> <?php echo $curr_symbol .'&nbsp;' . number_format($total_price_orders,2) ; ?> &nbsp;&nbsp;&nbsp; </span>	<u>Clients Costs...</u>	  <span class="price_f"><?php echo  $curr_symbol .'&nbsp;' . number_format($total_price_clients,2) ; ?>  </span>    </div>
		<div style="float:left; clear:both;  margin:10px 0;"><input type="checkbox" class="checkall"> <strong>Check all</strong></div>
		<br><br><br><br>
      <p align="right">	
          <input name="doApprove" type="submit" class="input_submit" id="doApprove" value="Make Available">
		  <input name="markAsCompleted" type="submit" class="input_submit" id="markAsCompleted" value="Mark As Done">
		  <input name="doReturnToEditing" type="submit" class="input_submit" id="doReturnToEditing" value="Return To Editing">
		  <input name="UnApprove" type="submit" class="input_submit" id="UnApprove" value="Un Approve">
          <input name="doRemove" type="submit" class="input_submit" id="doRemove" value="Remove">
		  <input name="doDelete" type="submit" class="input_submit" id="doDelete" value="Delete">
          <input name="query_str" type="hidden" class="input_submit" id="query_str" value="<?php echo $_SERVER['QUERY_STRING']; ?>">
		</p> 
      </form>	
	<?php } ?>	
	</td>
  </tr>
</table>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>