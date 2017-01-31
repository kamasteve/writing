<table width="60%"  border="0" align="center">
  <tr>
    <td  style="padding-bottom:20px;">
	  <div  style=" float:left;width:200px;"><h3 class="titlehdr"> Site Settings</h3> 
	  </div></td></tr>
    <tr><td style="padding-bottom:10px;">
	<?php 
	  $sql_sites = "select * from system where url = '$siteUrl'";
	  $rs_results_sites = mysql_query($sql_sites) or die(mysql_error());
	  $total_sites = mysql_num_rows($rs_results_sites);
	  $rows_sites = mysql_fetch_array($rs_results_sites);
if ($total_sites == 0){  ?>
  <div style="float:right; width:200px; size:12px;"> Not added yet. <a href="javascript:void(0);" onclick='$("#add_new").show("slow");'> <u>add it &raquo;&raquo; </u></a> now</div>

<?php } else{ ?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="5" class="site_st">
  <tr>
    <td width="30%"><strong>Name</strong></td>
    <td width="70%" class="site_td"><?php echo $rows_sites['site_name']; ?></td>
	</tr>
	<tr>
    <td><strong>Url</strong></td><td class="site_td"><?php echo $rows_sites['url']; ?></td>
	</tr>
	<tr>
    <td><strong>Base Price (<?php  echo $curr_symbol ?>)</strong></td><td class="site_td"><?php echo $rows_sites['base_price']; ?></td>
	</tr>
	<tr>
	<td><strong>Price Overide (%) <br />(What the writer will see)</strong></td><td class="site_td"><?php echo $rows_sites['price_override']; ?></td>
	</tr>
	<tr>
    <td><strong>Paypal Email</strong></td> <td class="site_td"><?php echo $rows_sites['paypal_email']; ?></td>
	</tr>
	<tr>
	<td><strong>Site Email</strong></td><td class="site_td"><?php echo $rows_sites['site_email']; ?></td>
	</tr>
	<tr>
    <td><strong>Admin Email</strong></td><td class="site_td"><?php echo $rows_sites['admin_email']; ?></td>
  </tr>
	<form name="frm_del" id="frm_del" method="post" action="">  
 <tr>
 <td>  <strong>Site Message: </strong></td>
 <td class="site_td"><?php echo $rows_sites['site_msg']; ?></td>
 <tr><td colspan="2" align="right"> 
  <br />
  <input type="button" name="edit_s" id="edit_s" value="Edit" onclick='$("#edit").show("slow");'>
	 &nbsp; 
	<input type="hidden" name="del_site" id="del_site" value="<?php echo $rows_sites['id'];?>" >
	<input name="doDelete" type="submit"  id="doDelete" value="Delete">  </td>
  </tr>	
  </form>
</table>
 <?php } ?>
   </td>
  </tr>
</table>
<div style="display:none;font: normal 11px arial; width:auto; padding:10px; margin: 10px 10px; background: #e6f3f9" id="add_new">
<form name="frm_site"  id="frm_site" action="" method="post">
	<table width="90%" border="0" align="center">
	<tr>
    <td><strong>Site Name :</strong></td>
    <td><input name="site_name" id="site_name" class="required" style="width: 200px;" value="<?php echo $row_msg_settings['site_name']; ?>"  /></td>
  </tr>
  <tr>
    <td><strong>Sire Url:</strong></td>
    <td> <input  name="web" type="hidden" id="web" style="width: 300px;"  value="<?php echo $siteUrl; ?>" />
	<p> <?php echo $siteUrl; ?> &nbsp; (this site) </p>
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p align="center"><input name="doAddSite" type="submit"  class="input_submit" id="doAddSite" value="Add Site"></p></td>
  </tr>
</table>
  </form>
<a  onclick='$("#add_new").hide("slow");' href="javascript:void(0);"><span style="float:right; padding:10px 0;">close</span></a>
</div>

<div style="display:none;font: normal 11px arial;width:auto; padding:10px; margin: 10px 10px; background: #e6f3f9" id="edit">
<?php include 'edit_site.php'; ?>
<a  onclick='$("#edit").hide("slow");' href="javascript:void(0);"><span style="float:right; padding:10px 0;">close</span></a>
</div>