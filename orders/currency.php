<table width="100%" border="0" align="left" class="s_borders">
  <tr  valign="top">
    <td colspan="4"><div  style=" float:left;"><h3 class="titlehdr">Set Currency</h3> </div></td>
	</tr> 
  <tr>
    <td colspan="4" style="padding-bottom:15px;">Select Site wide currency </td>
  </tr>
  <tr>
    <td></td>
    <td valign="top" style="padding:10px 10px;">Select</td>
<?php while ($row_currency_settings = mysql_fetch_array($rs_currency_settings)) {?>
    <td>
	<form name="sys_curr_settings"  id="sys_curr_settings" action="" method="post">
<select name="sys_curr" id="sys_curr" class="required">
<option> <?php echo $row_currency_settings['sys_curr']; ?></option>
<option value="KES">KES</option>
</select>
<p align="center"><input name="doSaveCurrency" type="submit"  class="input_submit" id="doSaveCurrency" value="Save Currency"></p>
    </form>
<?php } ?>	</td>
    <td valign="top" style="padding-left:20px;"><strong>Selected is the default</strong></td>
  </tr>
</table>
