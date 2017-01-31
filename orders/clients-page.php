<?php
include '../client_db_connect.php';
page_protect();
if(!checkAdmin()) {
header("Location: ../");
exit();
}
if (isset($_GET['id']))  {
  $w_id=$_GET['id'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../order_styles/styles.css" rel="stylesheet" type="text/css">
<title>Clients Page</title>
</head>
<body>
<?php include '../header.php' ; ?>
<div id="main-content">
<?php 
$sql_files = "select * from mu_members where id='$w_id'";
	  $rs_files = mysql_query($sql_files) or die(mysql_error());
	  $row= mysql_fetch_array($rs_files);
  	  $totals_rows = mysql_num_rows($rs_files);
	  
	 if($totals_rows >0){ ?>
<table width="100%" border="0">
  <tr valign="top">  
 <td valign="top">
<?php include 'access-links.php' ;  ?>	  
</td>
<td>
<table width="95%" class="ordered">
<tr><td colspan="4"><div align="left" style="color:#039; font-size:16px; padding:20px;">Client <b><?php echo $row['firstname']. '&nbsp;'.$row['lastname'];?>'s </b> details</div>	
</td></tr>
<tr>
    <td width="15%" nowrap="nowrap"><strong>Name:</strong></td>
    <td width="21%" nowrap="nowrap"><?php echo $row['firstname']. '&nbsp;'.$row['lastname'];?></td>
    <td colspan="2"><p><strong>Bio</strong>:</p>
      <div align="justify" style="width:95%; height:300px; overflow:scroll; border:1px dotted #333; padding:8px;">  <?php echo nl2br($row['bio']);?></div></td>
    </tr>
  <tr>
    <td nowrap="nowrap"><strong>Email:</strong></td>
    <td nowrap="nowrap"><?php echo $row['email'];?></td>
    <td width="33%">&nbsp;</td>
    <td width="31%">&nbsp;</td>
  </tr>
  <tr>
    <td nowrap="nowrap"><strong>Phone:</strong></td>
    <td nowrap="nowrap"><?php echo $row['cellphone_prefix'].substr($row['phone2'],1);?></td>
    <td width="33%">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td nowrap="nowrap"><strong>Location:</strong></td>
    <td nowrap="nowrap"><?php echo $row['city']. ',&nbsp;'.$row['country'];?>	</td>
    <td width="33%">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

 </td>
  </tr>  
</table>
<?php } ?>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>
