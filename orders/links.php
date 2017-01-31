<?php
/* if (isset($_SESSION['id'])) {?>
<?php 
// Orders
$rs_total_available= mysql_query("select count(*) as total_available from orders where status='Av' ") or die(mysql_error());	
$rs_total_to_confirm= mysql_query("select count(*) as total_to_confirm from orders where Status='Cr' and assigned_to ='$_SESSION[id]'") or die(mysql_error());		  
$rs_total_assigned= mysql_query("select count(*) as total_assigned from orders where Status='Cf' and assigned_to ='$_SESSION[id]'") or die(mysql_error());
$rs_total_revision= mysql_query("select count(*) as total_revision from orders where Status='Rv' and assigned_to ='$_SESSION[id]'") or die(mysql_error());					
$rs_total_dispute= mysql_query("select count(*) as total_dispute from orders where Status='Ds' and assigned_to ='$_SESSION[id]'") or die(mysql_error());	
$rs_total_finished= mysql_query("select count(*) as total_finished from orders where Status='Fd' and assigned_to ='$_SESSION[id]'") or die(mysql_error());	
$rs_total_approved= mysql_query("select count(*) as total_approved from orders where Status='Apv' and assigned_to ='$_SESSION[id]'") or die(mysql_error());
$rs_total_rejected= mysql_query("select count(*) as total_rejected from orders where Status='Rj' and assigned_to ='$_SESSION[id]'") or die(mysql_error());
$rs_total_paid= mysql_query("select count(*) as total_paid from orders where Status='Paid' and assigned_to ='$_SESSION[id]'") or die(mysql_error());					     			     
//bids   	
$rs_total_applications =mysql_query("select count( distinct bid_order_no) as total_applications from bids where checked=1 and by_id = '$_SESSION[id]'") or die(mysql_error());	

date_default_timezone_set('Africa/Nairobi');

$rs_total_online2 = mysql_query ("UPDATE mu_members SET last_logged_time = NOW() WHERE id = '$_SESSION[id]'") or die(mysql_error());	
//
list($available) = mysql_fetch_row($rs_total_available);
list($applications) = mysql_fetch_row($rs_total_applications); //applications
list($assigned) = mysql_fetch_row($rs_total_assigned);
list($to_confirm) = mysql_fetch_row($rs_total_to_confirm);
list($revision) = mysql_fetch_row($rs_total_revision);
list($dispute) = mysql_fetch_row($rs_total_dispute);
list($finished) = mysql_fetch_row($rs_total_finished);
list($approved) = mysql_fetch_row($rs_total_approved);
list($rejected) = mysql_fetch_row($rs_total_rejected);
list($paid) = mysql_fetch_row($rs_total_paid);


?>
<div id="myaccount_links">
<div id="getfacts">
<!--<p><a href="../message/"><strong>Simple, direct message &raquo;&raquo;</strong></a></p>-->
<p> <strong>Articles</strong></p>
 <a href="./"><span class="icon_available"> Available &nbsp; ( <?php if ($available ==0) 
  {echo '0';}else {echo $available ; }?>)</span> </a><div class="seps_l"></div>
 <a href="applied-for.php"> <span class="icon_bids"> Bids/Applications  &nbsp; (<?php if ($applications ==0) 
  {echo '0';}else {echo $applications; }?>)</span></a><div class="seps_l"></div>
  <a href="bids.php"> <span class="icon_assigned">Assigned/Confirm  &nbsp; (<?php if ($to_confirm ==0) 
  {echo '0';}else {echo $to_confirm; }?>) </span></a><div class="seps_l"></div>
 <a href="current.php"><span class="icon_current">  Current  &nbsp; (<?php if ($assigned ==0) 
  {echo '0';}else {echo $assigned; }?>)</span></a><div class="seps_l"></div>
  <a href="disputes.php"><span class="icon_dispute">Dispute &nbsp; (<?php if ($dispute ==0) 
  {echo '0';}else {echo $dispute; }?>)</span></a><div class="seps_l"></div>
 <a href="revision.php"><span class="icon_revision">  Revision &nbsp; (<?php if ($revision ==0) 
  {echo '0';}else {echo $revision ; }?>)</span></a><div class="seps_l"></div>
  <a href="finished.php"><span class="icon_done"> Completed &nbsp; (<?php if ($finished ==0) 
  {echo '0';}else {echo $finished ; }?>)</span></a><div class="seps_l"></div>
  <a href="approved.php"><span class="icon_approved">  Approved &nbsp; (<?php if ($approved ==0) 
  {echo '0';}else {echo $approved ; }?>)</span></a><div class="seps_l"></div><div class="seps_l"></div>
  <a href="rejected.php"> <span class="icon_reject"> Rejected &nbsp; (<?php if ($rejected ==0) 
  {echo '0';}else {echo $rejected ; }?>)</span></a><div class="seps_l"></div>
  <a href="paid.php"><span class="icon_paid">  Paid  &nbsp; (<?php if ($paid ==0) 
  {echo '0';}else {echo $paid ; }?>)</span></a><div class="seps_l"></div>
  <div class="seps_l"></div>
 <a href="financial.php"> <span class="icon_financial"> Financial Overview </span></a>
<div class="seps_l"></div>
<a href="mysettings.php"><span class="icon_account">My Profile </span></a> <div class="seps_l"></div>
<div class="seps_l"></div>
<a href="../logout.php"><span class="icon_exit">Logout </span></a>
<?php }?>
<div class="seps_l"></div>   
</div>
</div>
*/