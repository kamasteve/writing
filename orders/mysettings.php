<?php 
include '../client_db_connect.php';
page_protect();

$err = array();
$msg = array();

$usname=$_SESSION['username'];

if($_POST['doUpdate'] == 'Update')  
{

$rs_pwd = mysql_query("select accpass from mu_members where id='$_SESSION[id]'");
list($old) = mysql_fetch_row($rs_pwd);
$old_salt = substr($old,0,9);

//check for old password in md5 format
	if($old === PwdHash($_POST['pwd_old'],$old_salt))
	{
	$newsha1 = PwdHash($_POST['pwd_new']);
	mysql_query("update mu_members set accpass='$newsha1' where id='$_SESSION[id]'");
	$msg[] = "Your new password is updated Sucessfully";
	//header("Location: mysettings.php?msg=Your new password is updated");
	} else
	{
	 $err[] = "Your old password is invalid";
	 //header("Location: mysettings.php?msg=Your old password is invalid");
	}

}

if($_POST['doSave'] == 'Save')  
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}

mysql_query("UPDATE mu_members SET
			`firstname` = '$data[firstname]',
			`phone1` = '$data[phone1]',
			`phone2` = '$data[phone2]',
			`lastname` = '$data[lastname]',
			`country` = '$data[country]',
			`bio` = '$data[bio]'
			 WHERE id='$_SESSION[id]' AND username='$_SESSION[username]'
			") or die(mysql_error());

$msg[] = "Profile saved Sucessfully";
 }
$rs_settings = mysql_query("select * from mu_members where id='$_SESSION[id]' AND username='$_SESSION[username]'"); 

if($_POST['doSaveP'] == 'Save Details')  //paymens details
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}

mysql_query("UPDATE mu_members SET
			`bank_ac` = '$data[bank_ac]',
			`bank_name` = '$data[bank_name]',
			`bank_address` = '$data[bank_address]',
			`bank_ac_no` = '$data[bank_account_no]',
			`bank_branch` = '$data[bank_branch]',
			`beneficiary` = '$data[beneficiary]',
			`mpesa_fname` = '$data[mpesa_fname]',
			`mpesa_lname` = '$data[mpesa_lname]',
			`mpesa_no` = '$data[mpesa_no]'
			 WHERE id='$_SESSION[id]' AND username='$_SESSION[username]'
			") or die(mysql_error());

$msg[] = "Payments Details saved Sucessfully ";
 }
$rs_p_settings = mysql_query("select * from mu_members where id='$_SESSION[id]' AND username='$_SESSION[username]'"); 

//orders
$rs_orders_fd = mysql_query("select count(*) as total_fd from orders where status = 'Fd' AND client_id='$_SESSION[id]'") or die(mysql_error());
$rs_orders_ds = mysql_query("select count(*) as total_ds from orders where status = 'Ds' AND client_id='$_SESSION[id]'") or die(mysql_error());
$cur_orders_current = mysql_query("select count(*) as total_curr_assigned from orders where status = 'Cf' AND confirm = '1' AND client_id='$_SESSION[id]'") or die(mysql_error());
$cur_orders_current_u = mysql_query("select count(*) as total_curr_assigned_u from orders where status = 'Cf' AND confirm = '0' AND client_id='$_SESSION[id]'") or die(mysql_error());
$cur_orders_revison = mysql_query("select count(*) as total_curr_revision from orders where status = 'Rv' AND client_id='$_SESSION[id]'") or die(mysql_error());

list($total_fd) = mysql_fetch_row($rs_orders_fd);
list($total_ds) = mysql_fetch_row($rs_orders_ds);
list($total_curr_assigned) = mysql_fetch_row($cur_orders_current);
list($total_curr_assigned_u) = mysql_fetch_row($cur_orders_current_u);
list($total_curr_rev) = mysql_fetch_row($cur_orders_revison);
?>
<html>
<head>
<title>My Account Settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../order_styles/styles.css" rel="stylesheet" type="text/css">
<link href="../css/tabs.css" rel="stylesheet" type="text/css">
<script  type="text/javascript" src="../j_s/jquery-1.7.2.min.js"></script>
<script  type="text/javascript" src="../j_s/jquery.validate.js"></script>
  <script>
  $(document).ready(function(){
    $("#myform").validate();
	 $("#pform").validate();
	  $("#paymentsform").validate();
  });
  </script>
  <script type="text/javascript" charset="utf-8">
		jQuery(function () {
			var tabContainers = jQuery('div.tabs > div');
			tabContainers.hide().filter(':first').show();
			jQuery('div.tabs ul.tabNavigation a').click(function () {
				tabContainers.hide();
				tabContainers.filter(this.hash).show();
				jQuery('div.tabs ul.tabNavigation a').removeClass('selected');
				jQuery(this).addClass('selected');
				return false;
			}).filter(':first').click();
		});
	</script>
</head>
<body>
<?php include '../header.php'?>
<div id="main-content">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="main">
<td width="20%" valign="top">
<?php include 'access-links.php' ;  ?>
</td>
    <td width="80%" valign="top">
<h3 class="titlehdr">My Account - Settings</h3>
      <p> 
        <?php	
	if(!empty($err))  {
	   echo "<div align=\"center\" class=\"error\">";
	  foreach ($err as $e) {
	    echo "* Error - $e <br>";
	    }
	  echo "</div>";	
	   }
	   if(!empty($msg))  {
	    echo "<div align=\"center\" class=\"msg\">" . $msg[0] . "</div>";

	   }
	  ?>
      </p>
<div style="float:right;  width:200px; font-size:15px; font-style:italic;"> <a href="javascript:void(0);" onclick='$("#edit_p").show("slow");'>edit profile #</a></div>   
<br> 	
<table width="90%" align="center">
<tr valign="top">
<td width="60%" style="margin-left:20px;">
 <div style="color:#004569; width:300px; float:left; font-size:22px; padding:5px 0; margin-bottom:10px; width:200px; float:left;">Personal Info</div><br>   
	  <?php while ($row_settings = mysql_fetch_array($rs_settings)) {?>
        <table width="100%" border="0" align="center"  class="forms_acccount_p">
          <tr>
            <td><strong>Firstname:</strong></td>
            <td><?php echo $fname=$row_settings['firstname']; ?></td>
          </tr>
          <tr> 
            <td><strong>Lastname:</strong></td>
            <td><?php echo $lname=$row_settings['lastname']; ?></td>
          </tr>
          <tr> 
            <td><strong>Country:</strong></td>
            <td><?php echo $row_settings['country']; ?></td>
          </tr>
          <tr> 
            <td width="28%"><strong>Phone 1:</strong> </td>
            <td width="72%"><?php echo $row_settings['phone1']; ?></td>
          </tr>
          <tr> 
            <td>Phone 2 </td>
            <td><?php echo $row_settings['phone2']; ?></td>
          </tr>
          <tr> 
            <td><strong>User Name:</strong></td>
            <td><?php echo $row_settings['username']; ?></td>
          </tr>
          <tr> 
            <td><strong>Email:</strong></td>
            <td><?php echo $row_settings['email']; ?>
			<?php if(checkAdmin()) { ?>
			 (Updated on  <a href="settings.php"><u>Settings &raquo;&raquo; </u></a> - as Site Email )
			<?php } ?> 
			</td>
          </tr>
        </table>
	<?php } ?> 	
</td>
<td width="40%" style="padding:8px;" align="right">
<?php if(checkClient()) { ?>	
   <div style="color:#004569; width:300px; float:right; font-size:22px; padding:5px 0; margin-bottom:10px; width:200px; float:left;">Orders Stats</div><br> <table width="200" border="0"  class="forms_acccount">
          <tr valign="top">
          <td>Completed : </td>
		  <td><div class="stat_totals"> <?php echo $total_fd; ?></div></td>
		  </tr>
		 <tr>
		 <td>Disputes : </td>
		 <td><div class="stat_totals"> <?php echo $total_ds; ?></div></td>
        </tr>
		<tr>
          <td>Currently Assigned: </td>
		  <td><div class="stat_totals"> <?php echo $total_curr_assigned; ?></div></td>
		 </tr>
		 <tr>
          <td>UnConfirmed: </td>
		  <td><div class="stat_totals"> <?php echo $total_curr_assigned_u; ?></div></td>
		 </tr>
		 <tr>
		 <td>On Revision Now : </td>
		 <td><div class="stat_totals"> <?php echo $total_curr_rev; ?></div></td>
        </tr>
      </table> 
 <?php } ?>    
 </td>
 </tr>
  <tr><td colspan="2"><div style="height:1px; margin:5px 0; border-bottom:1px dotted #ccc;"></div></td></tr>
 <tr><td colspan="2">
 <div style="display:none;font: normal 11px arial; width:auto; padding:8px; margin:5px; background: #f8feee;-moz-border-radius: 5px;
  -webkit-border-radius: 5px;  border-radius: 5px; border:1px solid #c4de95;" id="edit_p">
<a  onclick='$("#edit_p").hide("slow");' href="javascript:void(0);"><span style="float:right; padding:10px 0;">close</span></a>  
<?php include 'edit_prf.php'; ?>
<a  onclick='$("#edit_p").hide("slow");' href="javascript:void(0);"><span style="float:right; padding:10px 0;">close</span></a>
</div>
 </td>
 </tr>
</table>
   </td>
  </tr>
</table>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>