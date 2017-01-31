<?php if (isset($_SESSION['id'])) {?>
<?php 
//clients
$active_clients = mysql_query("select count(*) as total_active from mu_members where approved='1' and user_level =2") or die(mysql_error());
//editors
$active_editors = mysql_query("select count(*) as total_active from mu_members where approved='1' and user_level =4") or die(mysql_error());
//writers
$active_writers = mysql_query("select count(*) as total_active from mu_members where approved='1' and user_level =3") or die(mysql_error());
// pending Writers
$pending_writers = mysql_query("select count(*) as total_pending from mu_members where approved='0' and user_level =3") or die(mysql_error());

//orders
$rs_total_pending_orders = mysql_query("select count(*) as total_pending_orders from orders where order_status='0' and status = '' order by date desc");	
$rs_total_available= mysql_query("select count(*) as total_assigned from orders where status='Av'") or die(mysql_error());		  
$rs_total_assigned_confirmed= mysql_query("select count(*) as total_assigned from orders where status='Cf'") or die(mysql_error());
$rs_total_assigned_nonconfirmed= mysql_query("select count(*) as total_assigned from orders where status='Cr'") or die(mysql_error());
$rs_total_awaiting_assign= mysql_query("select count(*) as total_awaiting_assign from orders where status='Av' and applied='1'") or die(mysql_error());						
$rs_total_revision= mysql_query("select count(*) as total_revision from orders where status='Rv'") or die(mysql_error());	
$rs_total_reassign= mysql_query("select count(*) as total_reassign from orders where status='Cr' and confirm='1' and request_re_assign='1'") or die(mysql_error());					
$rs_total_dispute= mysql_query("select count(*) as total_dispute from orders where status='Ds'") or die(mysql_error());
$rs_total_editing= mysql_query("select count(*) as total_editing from orders where status='Edt'") or die(mysql_error());		
$rs_total_finished= mysql_query("select count(*) as total_finished from orders where status='Fd'") or die(mysql_error());
$rs_total_approved= mysql_query("select count(*) as total_approved from orders where status='Apv'") or die(mysql_error());
$rs_total_rejected= mysql_query("select count(*) as total_rejected from orders where status='Rj'") or die(mysql_error());	
$rs_total_paid= mysql_query("select count(*) as total_paid from orders where status='Paid'") or die(mysql_error());	

date_default_timezone_set('Africa/Nairobi');
$rs_total_online2 = mysql_query ("UPDATE mu_members SET last_logged_time = NOW() WHERE id = '$_SESSION[id]'") or die(mysql_error());	
	$rs_total_online =mysql_query ("SELECT COUNT(*) FROM mu_members WHERE last_logged_time BETWEEN DATE_SUB(NOW(), INTERVAL 3 HOUR) AND NOW() and id <> '$_SESSION[id]'") or die(mysql_error());							     			     				   
    			     				   

//clients
list($activeclients)= mysql_fetch_row($active_clients);

//editors
list($activeeditors)= mysql_fetch_row($active_editors);

//writers
list($activewriters)= mysql_fetch_row($active_writers);
list($pendingwriters)= mysql_fetch_row($pending_writers);

//orders
list($rs_total_pending_orders) = mysql_fetch_row($rs_total_pending_orders);
list($available) = mysql_fetch_row($rs_total_available);
list($awaiting_assign) = mysql_fetch_row($rs_total_awaiting_assign);
list($assigned_confirmed) = mysql_fetch_row($rs_total_assigned_confirmed);
list($assigned_nonconfirmed) = mysql_fetch_row($rs_total_assigned_nonconfirmed);
list($revision) = mysql_fetch_row($rs_total_revision);
list($reassign) = mysql_fetch_row($rs_total_reassign);
list($dispute) = mysql_fetch_row($rs_total_dispute);
list($editing) = mysql_fetch_row($rs_total_editing);
list($finished) = mysql_fetch_row($rs_total_finished);
list($approved) = mysql_fetch_row($rs_total_approved);
list($rejected) = mysql_fetch_row($rs_total_rejected);
list($allpaid) = mysql_fetch_row($rs_total_paid);
list($online) = mysql_fetch_row($rs_total_online);
?>
<div id="myaccount_links">
<div id="getfacts">
<a href="settings.php"><span class="icon_settings"> &nbsp; Settings</span></a><div class="seps_l"></div>
<div style="height:5px;"></div>
<a href="manage_orders.php?doSearch=View"><span class="icon_orders">Manage Orders</span></a> <div class="seps_l"></div>
  <a href="all_editing.php"><span class="icon_editing"> Editing &nbsp; (<?php if ($editing ==0) 
  {echo '0';}else {echo $editing ; }?>)</span></a><div class="seps_l"></div>
<div style="margin-top:20px; padding:8px 10px;">
For more settings, kindly use Admin site for orders. writers, clients management.
</div>  
<hr />

<a href="../logout.php"><span class="icon_exit">Logout </span></a><div class="seps_l"></div>

<?php  }?>
</div>
</div>