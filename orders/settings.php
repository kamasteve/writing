<?php 
include '../client_db_connect.php';
page_protect();
if(!checkAdmin()) {
header("Location: /");
exit();
}
$err = array();
$msg = array();
// Add new client site 
if($_POST['doAddSite'] == 'Add Site') { 
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}
$get_new_id_s = mysql_query("SELECT MAX(id + 1) AS theid FROM system");
$last_ids_s = mysql_fetch_assoc($get_new_id_s);
$the_id_s= $last_ids_s['theid'];
	
$site_url = $data['web'];
$site_name = $data['site_name'];

$rs_duplicate = mysql_query("select count(*) as total from system where url ='$site_url'") or die(mysql_error());
list($total) = mysql_fetch_row($rs_duplicate);

if ($total > 0)
{
$err[] = "ERROR - site already exists.";
}
if(empty($err)) {
$sql_insert = "INSERT into `system` 
			(`id`,`url`, `site_name`) VALUES ('$the_id_s','$site_url', '$site_name')";
			mysql_query($sql_insert,$connect) or die("Insertion Failed:" . mysql_error());

			
$msg[] = "Site Saved Successfully. Click <b>site settings</b> to edit.";
    } // empty errors
 }
 // Delete site 
 if($_POST['doDelete'] == 'Delete') {
		mysql_query("delete from system where id='$_POST[del_site]'");
		$msg[] = "Site Deleted Successfully ";
  } 
  
 //Edit site
 if($_POST['doUpdateSite'] == 'Update Site')  
{
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}
mysql_query("UPDATE system SET
			`site_name` = '$data[site_name]',
			`url` = '$data[url]',
			`site_msg` = '$data[site_msg]',
			`base_price` = '$data[base_price]',
			`price_override` = '$data[price_override]',
			`paypal_email` = '$data[paypal_email]',
			`site_email` = '$data[site_email]',
			`admin_email` = '$data[admin_email]',
			`domain_name` = '$domain_name',
			`site_type` = 'client'
			 WHERE url='$siteUrl'
			") or die(mysql_error());
$msg[] = "Site Details Updated Sucessfully";
 }
 //$rs_results_sites = mysql_query("select * from system where url = '$siteUrl'"); 
//Add discount 
 if($_POST['doAddDiscount'] == 'Add Discount') { 
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}
$get_new_id_d = mysql_query("SELECT MAX(id + 1) AS theid_d FROM orders_discounts");
$last_ids_d = mysql_fetch_assoc($get_new_id_d);
$the_id_d= $last_ids_d['theid_d'];
	
$site_url = $data['web'];

$rs_duplicate = mysql_query("select count(*) as total from orders_discounts where url ='$site_url'") or die(mysql_error());
list($total) = mysql_fetch_row($rs_duplicate);

if ($total > 0)
{
$err[] = "ERROR - discount already exists.";
}
if(empty($err)) {
include 'discount_vars.php';
$sql_insert = "INSERT into `orders_discounts` 
			(`id`,`url`,`site_d_name`, `codex`,`discount_offer`, `percentage`, `expiry`, `status` , `comment`) VALUES ('$the_id_s','$site_url', '$data[site_d_name]','$data[codex]', '$data[discount_offer]','$data[percentage]', '$expiry','$status', '$data[comments]' )";
			mysql_query($sql_insert,$connect) or die("Insertion Failed:" . mysql_error());
			
$msg[] = "Discount Set Up Successfully.";
    } // empty errors
 }
 // Delete discount 
 if($_POST['doDelete_d'] == 'Delete') {
		mysql_query("delete from orders_discounts where id='$_POST[del_discount]'");
		$msg[] = "Discount Deleted Successfully ";
  }
  
  //Edit Discount
 if($_POST['doUpdateSiteDiscount'] == 'Update Site Discount')  
{
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}
include 'discount_vars.php';

mysql_query("UPDATE orders_discounts SET
			`site_d_name` = '$data[site_d_name]',
			`url` = '$data[url]',
			`codex` = '$data[codex]',
			`discount_offer`='$data[discount_offer]',
			`percentage` = '$data[percentage]',
			`status` = '$status_e',
			`expiry` = '$expiry',
			`comment` = '$data[comments]'
			 WHERE url='$siteUrl'
			") or die(mysql_error());
$msg[] = "Site Discount Updated Sucessfully";
 } 
?>	
<html>
<head>
<title><?php echo SITE_HOST_NAME; ?> - Site Settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../order_styles/styles.css" rel="stylesheet" type="text/css">
<link href="../css/settings.css" rel="stylesheet" type="text/css">
<script  type="text/javascript" src="../j_s/jquery-1.7.2.min.js"></script>
<script  type="text/javascript" src="../j_s/jquery.validate.js"></script>
<script>
  $(document).ready(function(){
    $("#sys_msg").validate();
	$("#frm_site").validate();
	$("#frm_update").validate();
	$("#frm_site_discount").validate();
	$("#frm_update_Discount").validate();
	$('#status_o').change(function(){
        if($(this).prop('checked') === true){
           $('#status').val($(this).attr('value'));
        }else{
             $('#status').val('');
        }
    });
	$('#status_d').change(function(){
        if($(this).prop('checked') === true){
           $('#status_e').val($(this).attr('value'));
        }else{
             $('#status_e').val('');
        }
    });
	
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
<script language="javascript" type="text/javascript">
function randomCode() {
	var chars = "123456789ABCDEFGHIJKLMNPQRSTUVWXTZabcdefghiklmnpqrstuvwxyz";
	var string_length = 12;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	document.frm_site_discount.codex.value = randomstring;
	document.frm_update_Discount.codex.value = randomstring;
}
</script>	
</head>
<body>
<?php include '../header.php' ; ?>
<div id="main-content">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td valign="top">
<?php include 'access-links.php' ;  ?>	</td>
    <td width="89%" valign="top" style="padding: 10px;">
	 <div> 
        <?php	
	if(!empty($err))  {
	   echo "<div align=\"center\" class=\"ord_error\">";
	  foreach ($err as $e) {
	    echo "* Error - $e <br>";
	    }
	  echo "</div>";	
	   }
	if(!empty($msg))  {
	    echo "<div align=\"center\" class=\"msg\">" . $msg[0] . "</div>";
	   }
	  ?>
      </div>
<div class="tabs">
        <ul class="tabNavigation">
			<li><a href="#sites-settings">Site Settings</a></li>
            <li><a href="#discounts">Discounts Settings</a></li>
        </ul>

<div id="sites-settings"><?php include 'site.php'; ?>  </div>
<div id="discounts">	 <?php include 'discount.php'; ?></div>		  
</div>	</td>
  </tr>
</table>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>
