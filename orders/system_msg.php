<table width="100%" border="0" align="left" class="s_borders">
  <tr  valign="top">
    <td colspan="4"><div  style=" float:left;"><h3 class="titlehdr">Message Settings</h3> </div></td>
	</tr> 
  <tr>
    <td colspan="4" style="padding-bottom:15px;">
	Create a system notification message to appear at <a href="./"><u>MyWorkDesk</u></a> message area for all users of the system </td>
  </tr>
  <tr>
    <td></td>
    <td valign="top" style="padding:20px 10px;">Message: </td>
<?php while ($row_msg_settings = mysql_fetch_array($rs_msg_settings)) {?>
    <td>
	<form name="sys_msg"  id="sys_msg" action="" method="post">
      <textarea name="msg" cols="20" rows="5" id="msg"  style="width: 400px;"><?php echo $row_msg_settings['msg']; ?></textarea>
<p align="center"><input name="doSaveMsg" type="submit"  class="input_submit" id="doSaveMsg" value="Save Message"></p>
    </form>
<?php } ?>	</td>
    <td valign="top" style="padding:20px 10px;"><strong>Leave empty for none</strong></td>
  </tr>
</table>
