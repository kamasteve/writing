<?php 
include '../client_db_connect.php';
page_protect();
if(!checkClient()) {
header("Location: /");
exit();
}
?>
<html>
<head>
<title>Revision Orders</title>
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
    <td width="89%" valign="top" style="padding: 10px;">
<table width="100%" border="0">
  <tr valign="top">
    <td><div  style=" float:left;" class="titlehdr"><strong>My Revision Orders</strong> </div></td>
    <td><div style="float:right;"><?php include 'gmttime.php'; ?></div></td>
	</tr>
</table>
      <?php 
	  $sql_revision = "select * from orders where status='Rv' and client_id='$_SESSION[id]'";
	  $rs_total_revision = mysql_query($sql_revision) or die(mysql_error());
	  $total_revision = mysql_num_rows($rs_total_revision);
	  $rs_results_revision = mysql_query($sql_revision) or die(mysql_error());
	  ?>
	<form name "searchform" action="current.php" method="post" onSubmit="">
         <table  cellpadding="0" cellspacing="0" border="0" class="display" id="thetable">
		<thead>
          <tr> 
			<th><div align="center"><strong>Order No</strong></div></th>
            <th><div align="center"><strong>Title</strong></div></th>
            <th><div align="center">Assigned to </div></th>
            <th><div align="center"><strong>Subject Area</strong></div></th>
            <th><div align="center"><strong>Academic Level</strong></div></th>
            <th><div align="center"><strong>track id </strong></div></th>
            <th><div align="center"><strong>Pages</strong></div></th>
            <th> <div align="center"><strong>Cost</strong></div></th>
          </tr>
		 </thead> 
		 <tbody>
		  <?php while ($rrows = mysql_fetch_array($rs_results_revision)) {?>
          <tr > 
<td nowrap class="order_borders" ><div align="center"> <a href="order-page.php?id=<?php echo $rrows['order_no'];?>&cid=<?php echo $rrows['client_id']; ?>&sts=<?php echo $rrows['status']; ?>"><?php echo $rrows['order_no']; ?> </a></div></td>
            <td class="order_borders"><div align="center"><a href="order-page.php?id=<?php echo $rrows['order_no'];?>&cid=<?php echo $rrows['client_id']; ?>&sts=<?php echo $rrows['status']; ?>"><?php echo $rrows['topic']; ?></a></div></td>
            <td nowrap class="order_borders"><div align="center">
			<?php 
$rs_assigned_sql = "select firstname, lastname, username,id from mu_members where id='$rrows[assigned_to]'";
$q_assigned_to = mysql_query($rs_assigned_sql) or die(mysql_error());
$row_assigned_to= mysql_fetch_array($q_assigned_to);
$assigned_to = ucfirst($row_assigned_to['firstname']). '&nbsp;'. ucfirst($row_assigned_to['lastname']);		
$uname = $row_assigned_to['username'];
echo '<font size="1">Writer ID : '.$row_assigned_to['id'] . '</font>' ;			?></div></td>
            <td nowrap class="order_borders"> <div align="center"><?php echo $rrows['subject_area'];?></div></td>
            <td nowrap class="order_borders"><div align="center"><?php echo $rrows['academic_level']; ?></div></td>
            <td nowrap class="order_borders"><div align="center">
<?php
$time1 = $urgency = $rrows['urgency'];
$time2 = time();
$difference = $time1 - $time2;
$diffSeconds = $difference;
$days = intval($difference / 86400);
$difference = $difference % 86400;
$hours = intval($difference / 3600);
$difference = $difference % 3600;
$minutes = intval($difference / 60);
$difference = $difference % 60;
$seconds = intval($difference);
$remaining = $days.":d, ".$hours.":h, ".$minutes.":m ";	

echo $remaining; ?></div>			 </td>
            <td class="order_borders"> <div align="center"><span id="approve_order<?php echo $rrows['id']; ?>"> 
              <?php echo $rrows['numpages']; ?>
            </span> </div></td>
            <td class="order_borders"><div align="center"><span id="clear<?php echo $rrows['id']; ?>"> 
              <?php echo $rrows['client_cost'] ; ?> &nbsp; ( <?php  echo $rrows['curr'] ?>)
            </span> </div></td>
          </tr>
          <?php  }   ?>
		  </tbody>
        </table>
		</form>
      
	</td>
  </tr>
</table>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>
