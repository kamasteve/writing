<table border="0" align="center">
  <tr>
    <td colspan="4" style="padding-bottom:20px;">
	  <div  style=" float:left;"><h3 class="titlehdr"> Discounts Settings</h3> 
	  </div>

	<?php 
	  $sql_site_d = "select * from orders_discounts where url = '$siteUrl'";
	  $rs_results_site_d = mysql_query($sql_site_d) or die(mysql_error());
	  $total_site_d = mysql_num_rows($rs_results_site_d);
	  
if ($total_site_d == 0){  ?>
  <span style="float:right; size:12px; cursor:pointer;"> No discount set up yet. <a  onclick='$("#add_new_d").show("slow");'> add new &raquo;&raquo;</a> now</span>
<?php } else{ ?>
  
<table width="100%" border="0" align="center" cellpadding="3">
  <tr style="background:#CCFFFF;">
    <td><strong>Site Name</strong></td>
    <td><strong>Coupon Code</strong></td>
	<td><strong>Discount On (<?php  echo $curr_symbol ?>) </strong></td>
    <td><strong>Percentage</strong></td>
    <td><strong>Expiry</strong></td>
	<td><strong>Status</strong></td>
    <td><strong>Comment</strong></td>
  </tr>
  <?php while ($rows_site_d = mysql_fetch_array($rs_results_site_d)) {?>
	<form name="frm_del_discount" id="frm_del_discount" method="post" action="">  
  <tr class="site_row">
    <td class="site_td"><?php echo $rows_site_d['url']; ?></td>
    <td class="site_td"><div align="center"><?php echo $rows_site_d['codex']; ?></div></td>
	<td class="site_td"><div align="center"><?php echo $rows_site_d['discount_offer']; ?></div></td>
    <td class="site_td"><div align="center"><?php echo $rows_site_d['percentage']; ?></div></td>
	<td class="site_td"><div align="center"><?php echo date('d-m-Y', $rows_site_d['expiry']); ?></div></td>
	<td class="site_td"><div align="center"><?php if($rows_site_d['status']==1){ echo 'Active'; }else{ echo 'Not Active'; } ?></div></td>
    <td class="site_td"><?php echo $rows_site_d['comment']; ?></td>
  </tr>
 <tr>
 <td colspan="7" align="right"> 
  <br />
  <input type="button" name="edit" id="edit" value="Edit" onclick='$("#edit_d").show("slow");'>
	 &nbsp; 
	<input type="hidden" name="del_discount" id="del_discount" value="<?php echo $rows_site_d['id'];?>" >
	<input name="doDelete_d" type="submit"  id="doDelete_d" value="Delete">  </td>
  </tr>	
  </form>
 <?php } ?>
</table>
 <?php } ?>
    </td>
  </tr>
</table>
<div style="display:none;font: normal 11px arial; padding:10px; margin: 20px 10px; background: #e6f3f9" id="add_new_d">
<form name="frm_site_discount"  id="frm_site_discount" action="" method="post">
	<table width="90%" border="0" align="center">
	<tr>
    <td><strong>Discount Name :</strong></td>
    <td><input name="site_d_name" id="site_d_name" class="required" maxlength="15" style="width: 200px;" value=""  /></td>
  </tr>
  <tr>
    <td><strong>Sire Url :</strong></td>
    <td> <input  name="web" type="hidden" id="web" style="width: 300px;"  value="<?php echo $siteUrl; ?>" /> 
	<p> <?php echo $siteUrl; ?> &nbsp; (this site) </p>
</td>
  </tr>
	<tr>
    <td><strong>Expiry :</strong></td>
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
    <td><strong>Discount on (USD) :</strong></td>
    <td><input name="discount_offer" id="discount_offer" class="required floatVal" maxlength="5" style="width: 50px;" value=""  /></td>
  </tr>
  <tr>
    <td><strong>Percentage :</strong></td>
    <td><input name="percentage" id="percentage" class="required floatVal" maxlength="5" style="width: 50px;" value=""  /></td>
  </tr>
  <tr>
    <td><strong>Coupon Code :</strong></td>
    <td><input name="codex" id="codex" class="required" maxlength="15" readonly="readonly" style="width: 100px;" value=""  />  &nbsp;&nbsp;
	<input type="button" value="Generate Code" onClick="randomCode();">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Status :</strong></td>
    <td><input  id="status_o" name="status_o" value="1"  type="checkbox">	<b>Active?</b>
	<input name="status" id="status" type="hidden"  value=""  /></td>
  </tr>
  <tr>
    <td><strong>Comments :</strong></td>
    <td><textarea name="comments" cols="20" rows="5" id="comments"  style="width: 400px;"></textarea>
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p align="center"><input name="doAddDiscount" type="submit"  class="input_submit" id="doAddDiscount" value="Add Discount"></p></td>
  </tr>
</table>
  </form>
<a  onclick='$("#add_new_d").hide("slow");' href="javascript:void(0);"><span style="float:right; padding:10px 0;">close</span></a></div>

<div style="display:none;font: normal 11px arial; padding:10px; margin: 20px 10px; background: #e6f3f9" id="edit_d">
<?php include 'edit_discounts.php'; ?>
<a  onclick='$("#edit_d").hide("slow");' href="javascript:void(0);"><span style="float:right; padding:10px 0;">close</span></a>
</div>