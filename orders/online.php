<?php 
include '../client_db_connect.php';
page_protect();
$page_limit = 10; 

if(!checkAdmin()) {
header("Location: index.php");
exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../order_styles/styles.css" rel="stylesheet" type="text/css">
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
    <td width="75%"><div  style=" float:left;"><h3 class="titlehdr">Users Online (Last 3 hours)</h3> </div></td>
    <td width="25%"><div style="float:right;"><?php include 'gmttime.php'; ?></div></td>
 </tr>
</table>
       <?php 
	  $sql_online = "select * from mu_members WHERE ckey  <>'' AND ctime <>'' AND id <>  '$_SESSION[id]' AND last_logged_time BETWEEN  DATE_SUB(NOW(), INTERVAL 3 HOUR) AND NOW() ORDER BY ctime DESC";
	  $rs_total_online = mysql_query($sql_online) or die(mysql_error());
	  $total_online = mysql_num_rows($rs_total_online);
 	  if (!isset($_GET['page']) )
		{ $start=0; } else
		{ $start = ($_GET['page'] - 1) * $page_limit; }
	  
	  $rs_results_online = mysql_query($sql_online . " limit $start,$page_limit") or die(mysql_error());
	  $total_pages_online = ceil($total_online/$page_limit);
	  ?>
         <table width="50%" border="0" align="center" cellpadding="5" cellspacing="2">
          <tr bgcolor="#E6F3F9"> 
 			<td nowrap> <div align="center"><strong>Name</strong></div></td>
            <td> <div align="center"><strong>Last Login </strong></div></td>
            <td width="6%"><div align="center"><strong> </strong></div></td>
          
          </tr>
 <?php  if ($total_online  == 0)  { ?>
          <tr>
		   <td colspan="3" nowrap> <div align="center"><?php  echo 'No one is Online apart from U!!';   ?> </div>  </td>
		  </tr> 
 <?php } ?> 
		  <?php while ($rrows = mysql_fetch_array($rs_results_online)) {?>
          <tr > 
            <td nowrap class="order_borders"> <div align="center"><?php echo $rrows['firstname']. ' ' .$rrows['lastname'] ;?></div></td>
            <td nowrap class="order_borders"><div align="center">
			<?php 
			$date = date('d-m-Y h:i:s A', $rrows['ctime']);
			echo $date; ?></div></td>
            <td nowrap class="order_borders"><div align="center"> <a href="writers-page.php?id=<?php echo $rrows['id'];?>">writer info</a></div></td>
          </tr>
          
          <?php     }   ?>
        </table>
      <p align="right"> 
        <?php 
		if ($total_current> $page_limit)
		{
		echo "<div><strong>Pages:</strong> ";
		$i = 0;
		while ($i < $page_limit)
		{
		$page_no = $i+1;
		$qstr = ereg_replace("&page=[0-1]+","",$_SERVER['QUERY_STRING']);
		echo "<a href=\"online.php?$qstr&page=$page_no\">$page_no</a> ";
		$i++;
		}
		echo "</div>";
		}  ?>
	  </p>		
	</td>
  </tr>
</table>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>
