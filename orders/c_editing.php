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
<title>Orders being Edited</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
    <td><div style="float:left;" class="titlehdr"><strong>Submitted for Editing</strong> </div></td>
    <td><div style="float:right;"><?php include 'gmttime.php'; ?></div></td>
 </tr>
</table>
      <?php 
	  $sql_finished = "select * from orders WHERE status ='Edt' and client_id='$_SESSION[id]' ORDER BY order_no DESC";
	  $rs_total_finished = mysql_query($sql_finished) or die(mysql_error());
	  $total_finished = mysql_num_rows($rs_total_finished);
	  $rs_results_finished = mysql_query($sql_finished) or die(mysql_error());
  ?>
       <table  cellpadding="0" cellspacing="0" border="0" class="display" id="thetable">
		<thead>
          <tr>
 			<th> <div align="center"><strong>Order No</strong></div></th>
            <th> <div align="center"><strong>Title</strong></div></th>
            <th><div align="center"><strong>Subject Area</strong></div></th>
            <th><div align="center"><strong>Academic Level</strong></div></th>
            <th><div align="center"><strong>Deadline</strong></div></th>
            <th><div align="center"><strong>Pages</strong></div></th>
            <th> <div align="center"><strong>Cost</strong></div></th>
          </tr>
		 </thead> 
		 <tbody>
          <?php while ($rrows = mysql_fetch_array($rs_results_finished)) {?>
          <tr > 
    		<td  class="order_borders" ><div align="center"> <a href="order-page.php?id=<?php echo $rrows['order_no'];?>&cid=<?php echo $rrows['client_id']; ?>&sts=<?php echo $rrows['status']; ?>"><?php echo $rrows['order_no']; ?> </a></div></td>
            <td class="order_borders"><div align="center"><a href="order-page.php?id=<?php echo $rrows['order_no'];?>&cid=<?php echo $rrows['client_id']; ?>&sts=<?php echo $rrows['status']; ?>"><?php echo $rrows['topic']; ?></a></div></td>
            <td  class="order_borders"> <div align="center"><?php echo $rrows['subject_area'];?></div></td>
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
            <td class="order_borders"> <div align="center"> <?php echo $rrows['numpages']; ?> </div></td>
            <td  class="order_borders"><div align="center"><?php echo number_format($rrows['client_cost']) ; ?>  &nbsp; ( <?php  echo $rrows['curr'] ?>)        </div></td>
          </tr>    <?php   }   ?>
		</tbody>
		</table>  
		<br><br><br>
		    <?php 
	  $orders_done_costs = "select  sum( client_cost ) AS totalcosts  from orders  WHERE status ='Edt' and client_id ='$_SESSION[id]'";
	  $rs_total_cost_fd= mysql_query($orders_done_costs) or die(mysql_error());
	  $rows_costs = mysql_fetch_array($rs_total_cost_fd);
	  $the_sum = $rows_costs ['totalcosts'];
	  $total_price_ += $the_sum ;?>
		    <div style="float:right; margin-right:1px; margin-top:18px;">Total: <span class="price_f"> <?php echo  $curr_symbol.' ' . number_format($total_price_ ) ; ?></span></div></td>
	    </td>
  </tr>
</table>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>
