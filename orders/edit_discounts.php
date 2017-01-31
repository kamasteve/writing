<?php 
	  $sql_site_d = "select * from orders_discounts where url = '$siteUrl'";
	  $rs_results_site_d = mysql_query($sql_site_d) or die(mysql_error());
  ?>
<?php while ($rows_site_d = mysql_fetch_array($rs_results_site_d)) {?>   	
<form name="frm_update_Discount" id="frm_update_Discount" method="post" action="">  
<table width="90%" border="0" align="center" cellpadding="3" class="s_borders">
  <tr>
    <td>Site Name</td>
    <td><input name="site_d_name" id="site_d_name" class="required" minlength="5" style="width: 200px;" value="<?php echo $rows_site_d['site_d_name']; ?>"  /></td>
  </tr>
  <tr>
    <td>Site Url</td>
    <td> <input  name="url" type="hidden" id="url" style="width: 300px;"  value="<?php echo $rows_site_d['url']; ?>" /> 
	<p> <?php echo $rows_site_d['url']; ?> &nbsp;  </p>
	</td>
  </tr>
   <tr>
    <td>Coupon Code</td>
    <td><input name="codex" id="codex" readonly="readonly" maxlength="15"class="required" style="width: 200px;" value="<?php echo $rows_site_d['codex']; ?>" />
	&nbsp;&nbsp;
	<input type="button" value="Generate Code" onClick="randomCode();">&nbsp;
	</td>
  </tr>
  <tr>
    <td>Discount on (<?php  echo $curr_symbol ?>) :</td>
    <td><input name="discount_offer" id="discount_offer" class="required floatVal" maxlength="5" style="width: 50;" value="<?php echo $rows_site_d['discount_offer']; ?>"  /></td>
  </tr>
  <tr>
    <td>Percentage</td>
    <td><input name="percentage" id="percentage" class="required floatVal" maxlength="5" style="width: 50;" value="<?php echo $rows_site_d['percentage']; ?>"  /></td>
  </tr>
  <tr>
    <td>Expiry</td>
    <td>
<select class="required" name="expiry" id="expiry">
 <option selected="" value="" ></option>
 <option value="16">6 hours</option>
 <option value="6">12 hours</option>
 <option value="7">24 hours</option>
 <option value="8">48 hours</option>
 <option value="9">3 days</option>
 <option value="10">4 days</option>
 <option value="11">5 days</option>
 <option value="12">7 days</option>
 <option value="13">10 days</option>
 <option value="14">20 days</option>
 <option value="15">30 days</option>

</select>
	</td>
  </tr>
  <tr>
    <td>Status</td>
    <td><input  id="status_d" name="status_d" value="1"  type="checkbox">	<b>Active?</b>
	<input name="status_e" id="status_e" type="hidden" value="" /></td>
  </tr>
    <td>Comments</td>
      <td>
	<textarea name="comments" cols="20" rows="5" id="comments"  style="width: 400px;"><?php echo $rows_site_d['comment']; ?></textarea>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	 <input type="hidden" name="update_site_d" id="update_site_d" value="<?php echo $rows_site_d['id'];?>" >
	<input name="doUpdateSiteDiscount" type="submit" id="doUpdateSiteDiscount" value="Update Site Discount">
	</td>
  </tr>
  </table>
  </form>
    <?php } ?>