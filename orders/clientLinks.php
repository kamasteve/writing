<?php if (isset($_SESSION['id'])) {?>
<?php 

//orders
$rs_total_pending_orders = mysql_query("select count(*) as total_pending_orders from orders where order_status='0' and status = '' and client_id='$_SESSION[id]' order by date desc");	
$rs_total_available= mysql_query("select count(*) as total_available_by_me from orders where status='Av' and client_id='$_SESSION[id]'") or die(mysql_error());		  
$rs_total_assigned_confirmed= mysql_query("select count(*) as total_assigned from orders where status='Cf' and client_id='$_SESSION[id]'") or die(mysql_error());
$rs_total_assigned_nonconfirmed= mysql_query("select count(*) as total_assigned from orders where status='Cr' and client_id='$_SESSION[id]'") or die(mysql_error());				
$rs_total_revision= mysql_query("select count(*) as total_revision from orders where status='Rv' and client_id='$_SESSION[id]'") or die(mysql_error());	
$rs_total_dispute= mysql_query("select count(*) as total_disputed from orders where status='Ds' and client_id='$_SESSION[id]'") or die(mysql_error());
$rs_total_editing= mysql_query("select count(*) as total_editing from orders where Status='Edt' and client_id ='$_SESSION[id]'") or die(mysql_error());		
$rs_total_finished= mysql_query("select count(*) as total_finished from orders where status='Fd' and client_id='$_SESSION[id]'") or die(mysql_error());
$rs_total_approved= mysql_query("select count(*) as total_approved from orders where Status='Apv' and client_id='$_SESSION[id]'") or die(mysql_error());
$rs_total_rejected= mysql_query("select count(*) as total_rejected from orders where Status='Rj' and client_id='$_SESSION[id]'") or die(mysql_error());	
$rs_total_paid= mysql_query("select count(*) as total_paid from orders where status='Paid' and client_id='$_SESSION[id]'") or die(mysql_error());	

date_default_timezone_set('Africa/Nairobi');
$rs_total_online2 = mysql_query ("UPDATE mu_members SET last_logged_time = NOW() WHERE id = '$_SESSION[id]'") or die(mysql_error());	

//orders
list($rs_total_pending_orders) = mysql_fetch_row($rs_total_pending_orders);
list($available) = mysql_fetch_row($rs_total_available);
list($assigned_confirmed) = mysql_fetch_row($rs_total_assigned_confirmed);
list($assigned_nonconfirmed) = mysql_fetch_row($rs_total_assigned_nonconfirmed);
list($revision) = mysql_fetch_row($rs_total_revision);
list($dispute) = mysql_fetch_row($rs_total_dispute);
list($editing) = mysql_fetch_row($rs_total_editing);
list($finished) = mysql_fetch_row($rs_total_finished);
list($approved) = mysql_fetch_row($rs_total_approved);
list($rejected) = mysql_fetch_row($rs_total_rejected);
list($allpaid) = mysql_fetch_row($rs_total_paid);

?>
<div id="myaccount_links">
<div id="getfacts">
<div style="color:#039; text-align:center; font-weight:bold;"> <?php echo 'Welcome, '. ucfirst($_SESSION['username']) ; ?> </div>
<p><strong>Orders</strong> </p>
<a href="c_manage_orders.php?qoption=all&doSearch=View"><span class="icon_orders">Manage &raquo;&raquo;</span></a> <div class="seps_l"></div>
<a href="c_manage_orders.php?q=&qoption=pending&doSearch=View">
<span class="icon_pending"> Pending &nbsp; ( <?php if ($rs_total_pending_orders ==0) 
  {echo '0';}else {echo $rs_total_pending_orders ; }?>)</span></a><div class="seps_l"></div>
<a href="new.php"><span class="icon_more_orders"> <strong>Place Order</strong></span></a><div class="seps_l"></div>
<div style="height:5px;"></div>
<hr />  
<a href="./"><span class="icon_available"> Available work &nbsp; ( <?php if ($available ==0) 
  {echo '0';}else {echo $available ; }?>)</span></a><div class="seps_l"></div>
  <!--
<a href="awaiting.php"> <span class="icon_bids">   Bids &nbsp; (<?php //if ($awaiting_assign ==0) 
  //{echo '0';}else {echo $awaiting_assign; }?>)</span></a>-->
<a href="assigned_confirmed.php"><span class="icon_assigned">In Progress &nbsp; (<?php if ($assigned_confirmed ==0) 
  {echo '0';}else {echo $assigned_confirmed; }?>)</span></a><div class="seps_l"></div>
<a href="assigned_unconfirmed.php"><span class="icon_assigned_unconfirmed"> Assigned &nbsp; (<?php if ($assigned_nonconfirmed ==0) 
  {echo '0';}else {echo $assigned_nonconfirmed; }?>)</span></a>
 <a href="c_revision-orders.php"><span class="icon_revision">Revision &nbsp; (<?php if ($revision ==0) 
  {echo '0';}else {echo $revision ; }?>)</span></a><div class="seps_l"></div>
  <a href="c_editing.php"><span class="icon_editing"> Editing &nbsp; (<?php if ($editing ==0) 
  {echo '0';}else {echo $editing ; }?>)</span></a><div class="seps_l"></div>
 <a href="c_finished.php"><span class="icon_done">Completed  &nbsp; (<?php if ($finished ==0) 
  {echo '0';}else {echo $finished ; }?>)</span></a><div class="seps_l"></div> 
 <a href="c_all_approved.php"><span class="icon_approved">Approved &nbsp; (<?php if ($approved ==0) 
  {echo '0';}else {echo $approved; }?>)</span></a><div class="seps_l"></div>
  <!--<a href="c_all_rejects.php"><span class="icon_reject">Rejected &nbsp; (<?php if ($rejected ==0) 
  {echo '0';}else {echo $rejected; }?>)</span></a><div class="seps_l"></div> --> 
<a href="c_all_disputes.php"><span class="icon_dispute">Dispute &nbsp; (<?php if ($dispute ==0) 
  {echo '0';}else {echo $dispute; }?>)</span></a><div class="seps_l"></div>
<hr />
<strong>Profile</strong><div class="seps_l"></div>
<a href="mysettings.php"><span class="icon_account">My Profile </span> </a><div class="seps_l"></div>
<a href="../logout.php"><span class="icon_exit">Logout </span></a><div class="seps_l"></div>

<?php  }?>
</div>
</div>