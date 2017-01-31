<?php
include('../client_db_connect.php');
page_protect();
$page_limit = 10; 
date_default_timezone_set('Africa/Nairobi');
?>
<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
<head>
<title>Messages</title>
<link href="../order_styles/styles.css" rel="stylesheet" type="text/css">
<link href="../css/collapse.css" rel="stylesheet" type="text/css">
<link href="../jquery-ui/jquery-ui.css" rel="stylesheet"/>
<script src="../j_s/jquery-1.9.1.js"></script>
<script src="../j_s/jquery-ui.js"></script>
<script>
$(function() {
$( "#accordion" ).accordion();
});
</script>
</head>
<body>
<?php include '../header.php' ; ?>
<div id="main-content">
 <table width="100%" border="0">
  <tr valign="top">
   <td valign="top" width="20%">
   <?php include 'access-links.php' ;  ?>
	</td>
<td>
<div style="margin:20px;">
<?php
if(isset($_SESSION['id']))
{
$req1 = mysql_query('select m1.id, m1.title, m1.timestamp,m1.order_no,m1.message, count(m2.id) as reps, mu_members.id as user_id, mu_members.role, mu_members.email,mu_members.firstname,mu_members.lastname, mu_members.username from pm as m1, pm as m2,mu_members where ((m1.user1="'.$_SESSION['id'].'" and m1.user1read="no" and mu_members.id=m1.user2) or (m1.user2="'.$_SESSION['id'].'" and m1.user2read="no" and mu_members.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
//$rs_total_msgs = mysql_query($req1) or die(mysql_error());
 $req2 = mysql_query('select m1.id, m1.title, m1.timestamp, m1.order_no,m1.message, count(m2.id) as reps, mu_members.id as user_id,mu_members.role,  mu_members.email,mu_members.firstname,mu_members.lastname,mu_members.username from pm as m1, pm as m2,mu_members where ((m1.user1="'.$_SESSION['id'].'" and m1.user1read="yes" and mu_members.id=m1.user2) or (m1.user2="'.$_SESSION['id'].'" and m1.user2read="yes" and mu_members.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
    }  ?>
	
<h3 class="titlehdr">Messages:</h3>
<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#006;">Unread  (<?php echo intval($total_messages = mysql_num_rows($req1)); ?>):</p>
 <?php    if ($total_messages==0) {?>		  
		 <div>
		    <div align="center"> <?php  echo 'You have no unread messages'; ?> </div> 
		 </div>
<?php } ?>
<div id="accordion">	
<?php
while($dn1 = mysql_fetch_array($req1)){ ?>
<h3><?php echo htmlentities (ShortenText($dn1['message'], ENT_QUOTES, 'UTF-8')); ?>&raquo;&raquo;</h3>
<div>
<p><?php echo '<i><strong>Message:</strong> </i> '.htmlentities($dn1['message'], ENT_QUOTES, 'UTF-8'); ?> </p>
<p><?php echo '<i><strong>From:</strong> </i> ' .$sender1= ucfirst(strtolower($dn1['firstname'])).' ('. $dn1['role'].')' ; ?> <a href="order-page.php?id=<?php echo  $dn1['order_no']; ?>#messages" class="link_to_order">Link to Order &raquo;&raquo;</a></p>
<p><?php echo '<i><strong>@:</strong> </i> '.date('Y/m/d H:i:s' ,$dn1['timestamp']); ?></p>
</div>
<?php } ?>
</div>
</div>
</td>
  </tr>
</table>
</div>
<?php include '../footer.php' ; ?>
	</body>
</html>