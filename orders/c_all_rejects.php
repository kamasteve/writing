<?php 
include '../client_db_connect.php';
page_protect();
if(!checkClient()) {
header("Location: index.php");
exit();
}
?>
<html>
<head>
<title>Rejected Orders</title>
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
    <td><div  style=" float:left;" class="titlehdr"><strong>My  Rejected Orders</strong>  </div></td>
    <td><div style="float:right;"><?php include 'gmttime.php'; ?></div></td>
  </tr>
</table>
      <?php 
	  $sql_assigned = "select * from orders where status='Rj' and client_id='$_SESSION[id]'";
	  $rs_total_assigned = mysql_query($sql_assigned) or die(mysql_error());
	  $total_assigned = mysql_num_rows($rs_total_assigned);
	  $rs_results_assigned = mysql_query($sql_assigned) or die(mysql_error());
	  ?>
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
            <th> <div align="center"><strong>Cost (<?php  echo $curr_symbol ?>)</strong></div></th>
          </tr>
		 </thead> 
		 <tbody>
		  <?php while ($rrows = mysql_fetch_array($rs_results_assigned)) {?>
          <tr > 
<td  class="order_borders" ><div align="center"> <a href="order-page.php?id=<?php echo $rrows['order_no'];?>&cid=<?php echo $rrows['client_id']; ?>&sts=<?php echo $rrows['status']; ?>"><?php echo $rrows['order_no']; ?> </a></div></td>
            <td class="order_borders"><div align="center"><a href="order-page.php?id=<?php echo $rrows['order_no'];?>&cid=<?php echo $rrows['client_id']; ?>&sts=<?php echo $rrows['status']; ?>"><?php echo $rrows['topic']; ?></a></div></td>
            <td class="order_borders"><div align="center">
			<?php 
$rs_assigned_sql = "select firstname, lastname, username, id from mu_members where id='$rrows[assigned_to]'";
$q_assigned_to = mysql_query($rs_assigned_sql) or die(mysql_error());
$row_assigned_to= mysql_fetch_array($q_assigned_to);
$assigned_to = ucfirst($row_assigned_to['firstname']). '&nbsp;'. ucfirst($row_assigned_to['lastname']);		
$uname = $row_assigned_to['username'];
echo '<font size="1">Writer ID : '.$row_assigned_to['id'] . '</font>' ;			?></div></td>
            <td class="order_borders"><div align="center"><?php echo $rrows['track_order_id']; ?></div></td>
            <td class="order_borders"> <div align="center"><?php echo $rrows['subject_area'];?></div></td>
            <td  class="order_borders"><div align="center"><?php echo $rrows['academic_level']; ?></div></td>
            <td  class="order_borders"><div align="center">
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
			
echo $remaining; ?>
	</div></td>
            <td class="order_borders"> <div align="center">
              <?php echo $rrows['numpages']; ?>
             </div></td>
            <td  class="order_borders"><div align="center"><?php echo number_format($rrows['client_cost']); ?>
             </div></td>
          </tr>
          <?php }?>
		  </tbody>
        </table>
	</td>
  </tr>
</table>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>
