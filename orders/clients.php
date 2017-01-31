<?php 
include '../client_db_connect.php';
page_protect();
$err = array();
$msg = array();
if(!checkAdmin()) {
header("Location: index.php");
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

if($post['doBan'] == 'Ban') {

if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
		mysql_query("update mu_members set banned='1' where id='$id' and `username` <> 'admin'");
	}
 }
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];;
 
 header("Location: $ret");
 exit();
}

if($_POST['doUnban'] == 'Unban') {

if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
		mysql_query("update mu_members set banned='0' where id='$id'");
	}
 }
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];;
 
 header("Location: $ret");
 exit();
}

if($_POST['doDelete'] == 'Delete') {

if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
		mysql_query("delete from mu_members where id='$id' and `username` <> 'admin'");
	}
 }
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];;
 
 header("Location: $ret");
 exit();
}

if($_POST['doApprove'] == 'Approve') {

if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
mysql_query("update mu_members set approved='1', banned='0' where id='$uid'");
$rs_email = mysql_query("select email, username from mu_members where  id='$uid'") or die(mysql_error());
$to_w_rows = mysql_fetch_array($rs_email);
$to_email =$to_w_rows['email'];
$to_w_username =$to_w_rows['username'];		
		

$message = 
"
Dear $to_w_username,\n

Welcome to the ". SITE_HOST_NAME." This is the Kenyan academic writing hub.\n

Click on the link to log into your account \n
http://".SITE_HOST_NAME."/login/ \n

Sincerely, \n
".SITE_HOST_NAME.", clients Department \n
Email: clients@".SITE_HOST_NAME." \n

".SITE_HOST_NAME."
______________________________________________________

";

@mail($to_email, "Your Client Application Has Been Approved", $message,
    "From: \"Member Registration\" <clients@$host>\r\n" .
     "X-Mailer: PHP/" . phpversion()); 
	 
	}
 }
 
 $ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];	 
 header("Location: $ret");
 exit();
}				   

if($_POST['DeActivate'] == 'De Activate'){
if(!empty($_POST['u'])) {
	foreach ($_POST['u'] as $uid) {
		$id = filter($uid);
mysql_query("update mu_members set banned='1', approved='0' where id='$uid' and `username` <> 'admin'");
$rs_email = mysql_query("select email, username from mu_members where  id='$uid'") or die(mysql_error());
$to_w_rows = mysql_fetch_array($rs_email);
$to_email =$to_w_rows['email'];
$to_w_username =$to_w_rows['username'];	

$message = 
"Dear $to_w_username, \n
We regret to inform you that we are removing you from ".SITE_NAME." .\n


Best Regards, \n
".SITE_HOST_NAME.", Clients Department \n
Email: clients@".SITE_HOST_NAME." \n
______________________________________________________

";

	@mail($to_email, "Your Account with ".SITE_HOST_NAME." has been Terminated", $message,
    "From: \"Account termination\" <clients@$host>\r\n" .
     "X-Mailer: PHP/" . phpversion());
}
}
 //echo "De-activated";
$msg = "Client(s) Account de-activated successfully";
//$ret = $_SERVER['PHP_SELF'] . '?'.$_POST['query_str'];	 
header("Location: client.php?msg=$msg");
 //exit();
}	
/* Editing users*/

$rs_all_clients = mysql_query("select count(*) as total_all from mu_members where role ='client'") or die(mysql_error());
$rs_active_clients = mysql_query("select count(*) as total_active from mu_members where approved='1' and role ='client'") or die(mysql_error());
$rs_total_pending_clients = mysql_query("select count(*) as tot from mu_members where approved='0' and role ='client'");	

list($all_clients) = mysql_fetch_row($rs_all_clients);
list($all_active_clients) = mysql_fetch_row($rs_active_clients);
list($total_pending_clients) = mysql_fetch_row($rs_total_pending_clients);
?>
<html>
<head>
<title>Clients Administration Main Page</title>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
<?php include 'access-links.php' ;  ?>
	</td>
    <td valign="top" style="padding: 5px;">
	    <div><h3 class="titlehdr">Clients Administration Page</h3> </div>
      <table width="100%" border="0" cellpadding="5" cellspacing="0">
        <tr>
          <td>Total writers: <?php echo $all_clients;?></td>
          <td>Active writers: <?php echo $all_active_clients; ?></td>
          <td>Pending writers: <?php echo $total_pending_clients; ?></td>
        </tr>
      </table>
      <p><?php	
      if (isset($_GET['msg'])) {
	  echo "<div class=\"msg\">$_GET[msg]</div>";
	  }
	  	  
	  ?></p>
	  <div style="width:600px; margin:0 auto;"><?php	
	  if(!empty($msg))  {
	    echo "<div align=\"center\" class=\"ord_msg\">" . $msg[0] . "</div>";
	   }
	  ?>
	  </div><br>
      <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" style="background-color: #E4F8FA;padding: 2px 5px;border: 1px solid #CAE4FF;" >
        <tr>
          <td><form name="form1" method="get" action="">
              <p align="center">Search 
                <input type="radio" name="qoption" value="pending">
                Pending Clients 
                <input type="radio" name="qoption" value="recent">
                Recently registered 
                <input type="radio" name="qoption" value="banned">
                Declined Clients <br>
              <p align="center"> 
                <input name="doSearch" type="submit" class="input_submit" id="doSearch2" value="Search" >
              </p>
              </form></td>
        </tr>
      </table>
      <p>
        <?php if ($get['doSearch'] == 'Search') {
	  $cond = "where role='client'";
	  if($get['qoption'] == 'pending') {
	  $cond = "where `approved`='0' and role ='client' order by date desc";
	  }
	  if($get['qoption'] == 'recent') {
	  $cond = "where `approved`='1' and role ='client' order by date desc";
	  }
	  if($get['qoption'] == 'banned') {
	  $cond = "where `banned`='1' and role ='client' order by date desc";
	  }
	  
	  if($get['q'] == '') { 
	  $sql = "select * from mu_members $cond";  
	  } 
	  else { 
	  $sql = "select * from mu_members where `email` = '$_REQUEST[q]' or `username`='$_REQUEST[q]' ";
	  }

	  $rs_total_lients = mysql_query($sql) or die(mysql_error());
	  $total_clients = mysql_num_rows($rs_total_lients);
	  $rs_results_clients = mysql_query($sql) or die(mysql_error());
	  $total_pages_clients = ceil($rs_results_clients/$page_limit);
	  ?>
      <form name "searchform" action="" method="post">
        <table  cellpadding="0" cellspacing="0" border="0" class="display" id="thetable">
		<thead>
          <tr> 
            <th><strong>ID</strong></th>
            <th> <div align="center"><strong>Reg Date</strong></div></th>
            <th><div align="center"><strong>User Id </strong></div></th>
            <th><div align="center"><strong>User Name</strong></div></th>
            <th><div align="center"><strong>Email</strong></div></th>
            <th><div align="center"><strong>Status</strong></div></th>
            <th> <div align="center"><strong>Ban</strong></div></th>
			<th></th>
          </tr>
		 </thead>
          <?php while ($rrows = mysql_fetch_array($rs_results_clients)) {?>
          <tr> 
            <td class="order_borders"><input name="u[]" type="checkbox" value="<?php echo $rrows['id']; ?>" id="u[]"></td>
            <td class="order_borders"><div align="center"><?php echo $rrows['date']; ?></div></td>
            <td class="order_borders"><div align="center"><?php echo $rrows['id']; ?></div></td>
            <td class="order_borders"> <div align="center"><?php echo $rrows['username'];?></div></td>
            <td class="order_borders"><div align="center"><?php echo $rrows['email']; ?></div>
              <div align="center"></div></td>
            <td class="order_borders"> <div align="center"><span id="approve_writer<?php echo $rrows['id']; ?>"> 
              <?php if(!$rrows['approved']) { echo "Pending"; } else {echo "Active"; } if($rrows['banned'] ==1) { echo "Banned"; } ?>
            </span> </div></td>
            <td class="order_borders"><div align="center"><span id="ban<?php echo $rrows['id']; ?>"> 
              <?php if(!$rrows['banned']) { echo "no"; } else {echo "yes"; }?>
            </span> </div></td>
			  <td class="order_borders"><a href="clients-page.php?id=<?php echo $rrows['id'];?>">View</a></td>
            </tr>         
 
          <?php } ?>
	  </tbody>	
        </table>
	    <p align="center"><br><br>
          <input name="doApprove" type="submit" class="input_submit" id="doApprove" value="Approve">
          <input name="DeActivate" type="submit" class="input_submit" id="DeActivate" value="De Activate">
          <input name="doDelete" type="submit" class="input_submit" id="doDelete" value="Delete">
          <input name="query_str" type="hidden" id="query_str" value="<?php echo $_SERVER['QUERY_STRING']; ?>">
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
