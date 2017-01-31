<?php 
	  $sql_site_t = "select * from system where url = '$siteUrl'";
	  $rs_results_site_t = mysql_query($sql_site_t) or die(mysql_error());
  ?>
<?php while ($rows_site_t = mysql_fetch_array($rs_results_site_t)) {?>   	
<form name="frm_update" id="frm_update" method="post" action="">  
<table width="90%" border="0" align="center" cellpadding="3" >
  <tr>
    <td>Site Name</td>
    <td><input name="site_name" id="site_name" class="required" minlength="5" style="width: 200px;" value="<?php echo $rows_site_t['site_name']; ?>"  /></td>
  </tr>
  <tr>
    <td>Site Url</td>
    <td> <input  name="url" type="hidden" id="url" style="width: 300px;"  value="<?php echo $rows_site_t['url']; ?>" /> 
	<p> <?php echo $rows_site_t['url']; ?> &nbsp;  </p>
	</td>
  </tr>
   <tr>
    <td>Site Email</td>
    <td><input name="site_email" id="site_email" class="required email" style="width: 300px;" value="<?php echo $rows_site_t['site_email']; ?>"  /></td>
  </tr>
  <tr>
    <td>Admin Email</td>
    <td><input name="admin_email" id="admin_email" class="required email" style="width: 300px;" value="<?php echo $rows_site_t['admin_email']; ?>"  /></td>
  </tr>
  <tr>
    <td>Paypal Email</td>
    <td><input name="paypal_email" id="paypal_email" class="required email" style="width: 300px;" value="<?php echo $rows_site_t['paypal_email']; ?>"  /></td>
  </tr>
  <tr>
    <td>Base Price</td>
    <td><input name="base_price" id="base_price" class="required floatVal" maxlength="5" style="width: 50px;"  value="<?php echo $rows_site_t['base_price']; ?>"  /></td>
  </tr>
  <tr>
    <td>Price Overide (%)</td>
    <td><input name="price_override" id="price_override" class="required floatVal" maxlength="2" style="width: 50px;"  value="<?php echo $rows_site_t['price_override']; ?>"  />      
       (What the writer will see)</td>
  </tr>
  <td>System Message</td>
    <td>
	<textarea name="site_msg" cols="20" rows="5" id="site_msg"  style="width: 400px;"><?php echo $rows_site_t['site_msg']; ?></textarea>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	 <input type="hidden" name="update_site" id="update_site" value="<?php echo $rows_site_t['id'];?>" >
	<input name="doUpdateSite" type="submit" id="doUpdateSite" value="Update Site">
	</td>
  </tr>
  </table>
  </form>
    <?php } ?>