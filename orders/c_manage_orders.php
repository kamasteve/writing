<?php 
include '../client_db_connect.php';
page_protect();
$err = array();
$msg = array();

if(!checkClient()) {
header("Location: ../index.php");
exit();
}
$page_limit = 10; 

$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$login_path = @ereg_replace('admin','',dirname($_SERVER['PHP_SELF']));
$path   = rtrim($login_path, '/\\');

// filter GET values
foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

foreach($_POST as $key => $value) {
	$post[$key] = filter($value);
}

////manage orders
$rs_all_orders = mysql_query("select count(*) as total_all from orders where client_id='$_SESSION[id]' ORDER BY order_no DESC") or die(mysql_error());
$rs_available_orders = mysql_query("select count(*) as total_active from orders where status ='Av' and client_id='$_SESSION[id]' ORDER BY order_no DESC") or die(mysql_error());
$rs_total_pending = mysql_query("select count(*) as total_pending from orders where order_status='0' and status = '' and client_id='$_SESSION[id]' ORDER BY order_no DESC");	
$rs_total_approved = mysql_query("select count(*) as total_removed from orders where status ='Apv' or status ='Fd' and client_id='$_SESSION[id]' ORDER BY order_no DESC");	
list($rs_all_orders_b_c) = mysql_fetch_row($rs_all_orders);
list($rs_available_orders_b_c) = mysql_fetch_row($rs_available_orders);
list($rs_total_pending_b_c) = mysql_fetch_row($rs_total_pending);
list($rs_total_approved_b_c) = mysql_fetch_row($rs_total_approved);
?>
<html>
<head>
<title>Manage My Orders</title>
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
    <td  valign="top">
	 <p>
	  <?php	
	if(!empty($err))  {
	   echo "<div class=\"msg\">";
	  foreach ($err as $e) {
	    echo "* Error - $e <br>";
	    }
	  echo "</div>";	
	   }
	   if(!empty($msg))  {
	    echo "<div class=\"msg\">" . $msg[0] . "</div>";
	   }
	  ?>
	  </p>
	<table width="95%" border="0" align="center">
        <tr>
		   <td  valign="top"><div  class="titlehdr"><strong>Manage My Orders </strong> </div></td>
          <td>Total Orders: <strong><span class="thetotals"><?php echo $rs_all_orders_b_c;?></span></strong></td>
          <td>Available: <strong><span class="thetotals"><?php echo $rs_available_orders_b_c; ?></span></strong></td>
          <td>Pending: <strong><span class="thetotals"><?php echo $rs_total_pending_b_c; ?></span></strong></td>
		  <td>Completed or Approved: <strong><span class="thetotals"><?php echo $rs_total_approved_b_c; ?></span></strong></td>
        </tr>
      </table>
 <table width="98%" border="0" align="center"  style="background-color: #E4F8FA;border: 1px solid #CAE4FF;" >
        <tr valign="top">
          <td><form name="form1" method="get" action="c_manage_orders.php">
            <p align="center">
			    <input type="radio" name="qoption" value="all">
                <strong>All orders: </strong>
                <input type="radio" name="qoption" value="available">
                <strong> Available:</strong> 
				<input type="radio" name="qoption" value="pending">
                <strong> Pending: </strong> 
			    <input type="radio" name="qoption" value="approved">
                <strong> Completed or Approved: </strong> 
                &nbsp;&nbsp;<input name="doSearch" type="submit" class="input_submit" id="doSearch2" value="View">
              </p>
			  </form></td>
        </tr>
      </table>
	  <p>
      <?php if ($get['doSearch'] == 'View') {
	  $cond = "where client_id='$_SESSION[id]' ORDER BY order_no DESC";
	  $status='All orders';
	  if($get['qoption'] == 'approved') {
	  $cond = "where (status ='Apv' or status ='Fd') and client_id='$_SESSION[id]' ORDER BY `date` DESC";
	  $status='Completed or Approved orders';
	  }
	  if($get['qoption'] == 'pending') {
	  $cond = "where order_status='0' and status = '' and client_id='$_SESSION[id]' ORDER BY `date` DESC";
	  $status='Pending orders';
	  }
	  if($get['qoption'] == 'available') {
	  $cond = "where status ='Av' and client_id='$_SESSION[id]' ORDER BY `date` DESC";
	  $status='Available orders';
	  }
	  if($get['qoption'] == 'all') {
	  $cond = "where client_id='$_SESSION[id]' ORDER BY `date` DESC";
	  $status='All orders';
	  }
	  if($get['q'] == '') { 
      $sql_t_o_b_c = "select * from orders $cond"; 	
	  } 
	  else { 
	  $sql_t_o_b_c = "select * from orders where  `order_no`='$_REQUEST[q]'  and client_id='$_SESSION[id]'";
	  }
	  
	  $rs_total_orders_by_c = mysql_query($sql_t_o_b_c) or die(mysql_error());
	  $total_ordrs = mysql_num_rows($rs_total_orders_by_c);
	  $rs_results_orders_by_c = mysql_query($sql_t_o_b_c) or die(mysql_error());
	  ?>
<p> <strong>Status:</strong> &nbsp;<span class="style2"><?php echo  $status;?></span></p>	  
<form method="post"  action="c_manage_orders.php" name="searchform">
        <table  cellpadding="0" cellspacing="0" border="0" class="display" id="thetable">
		<thead>
		<tr> 
            <th><div align="left"><strong>ID</strong></div></th>
			<th> <div align="left"><strong>Order No</strong></div></th>
            <th> <div align="left"><strong>Created</strong></div></th>
            <th><div align="left"><strong>Track</strong></div></th>
            <th><div align="left"><strong>Deadline</strong></div></th>
            <th><div align="center"><strong>Status</strong></div></th>
			<th> <div align="left"><strong>Cost</strong><br></div></th>
            <th><div align="center">Assigned?</div></th>
            <th>&nbsp;</th>
		    <th>&nbsp;</th>
		</tr>
		  </thead>
		  <tbody>
         <?php while ($rows_orders = mysql_fetch_array($rs_results_orders_by_c)) {?>
		 <?php
	  $asgnd_id = $rows_orders['assigned_to'];
	  $usnames = "select  firstname, lastname from mu_members WHERE id ='$asgnd_id'";
	  $rs_usnames= mysql_query($usnames) or die(mysql_error());
	  $rows_usnames = mysql_fetch_array($rs_usnames);
			?>
          <tr> 
<td class="order_borders"><input name="u[]" type="checkbox" value="<?php echo $rows_orders['order_no']; ?>" id="u[]"></td>
<td class="order_borders" ><div align="center"> <a href="order-page.php?id=<?php echo $rows_orders['order_no'];?>&cid=<?php echo $rows_orders['client_id']; ?>&sts=<?php echo $rows_orders['status']; ?>&writer_ids=<?php echo $asgnd_id ;?>"><?php echo $rows_orders['order_no']; ?> </a></div></td>
            <td class="order_borders"><div align="center"><?php echo $rows_orders['date']; ?></div></td>
            <td class="order_borders"><div align="center"><?php echo $rows_orders['track_order_id'];  ?></div></td>
            <td class="order_borders"><div align="center"><?php 
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
            <td class="order_borders"> <div align="center">
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
  <td class="order_borders"><div align="center"><?php echo number_format($rows_orders['client_cost']); ?> &nbsp; ( <?php  echo $rows_orders['curr'] ?>)  </div></td>
          
          <td class="order_borders">
		  <div align="center">
		  <?php 
if ($rows_orders['assigned_to'] <> 0){		  
$rs_assigned_sql = "select firstname, lastname, username, id from mu_members where id='$rows_orders[assigned_to]'";
$q_assigned_to = mysql_query($rs_assigned_sql) or die(mysql_error());
$row_assigned_to= mysql_fetch_array($q_assigned_to);
//$assigned_to = ucfirst($row_assigned_to['firstname']). '<br>'. ucfirst($row_assigned_to['lastname']);		
$uname = $row_assigned_to['username'];
echo '<font size="1">Writer ID : '.$row_assigned_to['id'] . '</font>' ; }else{
echo '<font size="1" > Not Yet </font>'; }
 ?>
		   </div></td>
          <td class="order_borders"><div style="font-size:10px; text-align:left;">
		  <a href="order-page.php?id=<?php echo $rows_orders['order_no'];?>&cid=<?php echo $rows_orders['client_id']; ?>&sts=<?php echo $rows_orders['status']; ?>&writer_ids=<?php echo $asgnd_id ;?>">&raquo; details </a><br>
		  <!--<a href="edit-order-c.php?order=<?php echo $rows_orders['order_no'];?>" class="">&raquo; Edit &raquo;</a>-->
		  </div></td>
          <td class="order_borders">
		  <?php
		  if ($rows_orders['status'] ==''){
		      $l =rand_my_string(100);
              $x =rand_my_string(30);
			  $order_no=$rows_orders['order_no'];
              $theorder = base64_encode($rows_orders['order_no']);
		  ?>
<a href="pay_this_c.php?_id=<?php echo $l;?>&d=<?php echo $order_no;?>&x=<?php echo $x;?>&o=<?php echo $theorder;?>">Pay</a>
<?php   } ?> 
		  </td>
          </tr>
<?php } ?>
</tbody>
        </table>
		
      </form>	
	  	<?php } ?>		
	</td>
  </tr>
</table>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>